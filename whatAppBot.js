const express = require('express');
var cors = require('cors');
// const hostname = '0.0.0.0'
const app = express();
app.use(express.json());
app.use(cors());


//connect to DB.
const mysql = require("mysql");
const DB = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',//password of DB
    database: ''//name of DB
});
DB.connect((err) => {
    if (err)
        throw err;
    else
        console.log('database is connected...')
});


const qrcode = require('qrcode-terminal');
const { Client, LocalAuth } = require('whatsapp-web.js');
const client = new Client({
    authStrategy: new LocalAuth()
});


client.on('qr', qr => {
    qrcode.generate(qr, { small: true });
});

// client.on('ready', () => {
//     console.log('Client is ready!');
// });


client.on('ready', () => {
    console.log('Client is ready!');
    const port = process.env.PORT || 3000;
    app.listen(port, () => { console.log(`listening on port ${port}...`) });
})
client.initialize();




//routes
app.post('/api/addWGroup', (req, res) => {

    //to do!!! add all the constrains on input data here again .
    if (!req.body.link || !req.body.groupCourseCode || !req.body.groupSection) {

        res.status(400).send('data missing');

        return;
    }

    let groupLink = req.body.link;
    let inviteCode = groupLink.replace('https://chat.whatsapp.com/', '');
    let groupCourseCode = req.body.groupCourseCode;
    let groupName;
    let groupSection = req.body.groupSection;
    let nParticipantes;
    let groupID;

    //join group
    client.acceptInvite(inviteCode).then((msg) => {
        groupID = msg;
        client.getChatById(groupID).then((group) => {
            // get group name and group number

            groupName = group.name;
            nParticipantes = group.participants.length + 1;


            //insert in DB
            let wgroup = {
                course_id: groupCourseCode,
                course_number: groupSection,
                courselink: inviteCode,
                group_name: groupName,
                nParticipants: nParticipantes,
                groupID: groupID
            };
            let sql = 'INSERT INTO usergroup SET ?';
            DB.query(sql, wgroup, (err) => {
                if (err)
                    // the group is already inerted;
                    res.status(500).send(`sorry something went wrong try again!.\n ${err}`);
                else
                    res.status(200).send(wgroup);
            })
        }).catch((err) => {
            res.status(500).send(`sorry something went wrong try again!.\n ${err}`);
        });
    }).catch((err) => {
        //if not joined return 404
        res.status(400).send(`group link is not valid!.\n ${err}`);

    });




});


app.delete('/api/deleteGroup', (req, res) => {
    //TO DO!!! validate if the request has came from an admin or not.
    //TO DO!!! validate if req.body.groupID is in the right format or not. fromat = ##...@server  e.g. 3128931231@g.us

    if (!req.body.groupID) {
        res.status(400).send('data missing');
        return;
    }

    let groupID = req.body.groupID;
    let sql = "delete from usergroup where groupID=?";
    try {

        client.getChatById(groupID).then((group) => {
            console.log(group)
            group.delete((result) => {
                console.log(result);
            });
            group.leave();

            DB.query(sql, groupID, (err) => {
                if (err)
                    res.status(500).send(`sorry something went wrong try again!.\n ${err}`);
                else
                    res.status(200).send(groupID + ' has been deleted successfully.');
            });
        })
    } catch (err) {
        console.error(err);

    }





});

client.on("group_update", (notification) => {
    console.log(notification);
    console.log("----")
    let groupID = notification.chatId;
    switch (notification.type) {
        case 'subject':
            sql = `UPDATE usergroup SET group_name =?  where groupID = ?`
            DB.query(sql, [notification.body, groupID], (error, results, fields) => {
                //TO DO!!! optionally
                console.log(groupID + "subject updated to " + notification.body)
            })
            break;
        case 'revoke_invite':
            //here is a very rare failure will happen when group emit the group_update event and then the bot get kicked out before it finshed dealing with the event.
            client.getChatById(notification.chatId).then((group) => {
                group.getInviteCode().then((invCode) => {
                    sql = `UPDATE usergroup SET courselink =?  where groupID = ?`
                    DB.query(sql, [invCode, groupID], (error, results, fields) => {
                        //TO DO!!! optionally
                        console.log(groupID + "link updated to " + invCode)
                    })

                });

            })
            break;
    }

});

client.on("group_leave", (notification) => {
    console.log(notification);
    let groupID = notification.chatId;
    if (notification.recipientIds === "966536215703@c.us") {
        //TO TEST !!!
        sql = 'delete from usergroup where groupID = ?';
        DB.query(sql, groupID, (error, results, fields) => {
            //TO DO!!! optionally
            if (!error)
                console.log(groupID + "is delete from DB because bot was kicked out or left.")
            else
                console.log(error);
        })
    } else {
        sql = 'UPDATE usergroup SET nParticipants = nParticipants - 1 where groupID = ?'
        DB.query(sql, groupID, (error, results, fields) => {
            //TO DO!!! optionally
            if (!error)
                console.log(groupID + "nParticipants updated")
            else
                console.log(error);
        })
    }
});

client.on("group_join", (notification) => {
    console.log(notification);
    let groupID = notification.chatId;
    if (notification.recipientIds === "966536215703@c.us") {
        //TO DO!!! optionally

    } else {
        sql = `UPDATE usergroup SET nParticipants = nParticipants + 1 where groupID = ?`
        DB.query(sql, groupID, (error, results, fields) => {
            //TO DO!!! optionally
            if (!error)
                console.log(groupID + "nParticipants updated")
            else
                console.log(error);
        })
    }

});