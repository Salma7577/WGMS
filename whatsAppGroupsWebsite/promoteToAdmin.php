<!DOCTYPE html>
<?php
include('Connection.php');

?>
<html lang="en">

<head>

    <meta charset="utf-8">

    <link rel="stylesheet" href="CSSs/Style.css">
    <link rel="stylesheet" href="CSSs/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="CSSs/listStyles.css">
    <link rel="stylesheet" href="CSSs/bootstrap2.css">
    <link rel="stylesheet" href="CSSs/popupWindow.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mirza&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mirza&family=Tajawal:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <?php
    date_default_timezone_set('Asia/Riyadh');

    ?>
    <script>
        var idOfOpendGroup;

        $(document).ready(function () {
            $.extend(
                {
                    redirectPost: function(location, args)
                    {
                        var form = $('<form></form>');
                        form.attr("method", "post");
                        form.attr("action", location);

                        $.each( args, function( key, value ) {
                            var field = $('<input></input>');

                            field.attr("type", "hidden");
                            field.attr("name", key);
                            field.attr("value", value);

                            form.append(field);
                        });
                        $(form).appendTo('body').submit();
                    }
                });
            //rating
            var logID = 'log',
                log = $('<div id="' + logID + '"></div>');
            $('body').append(log);
            $('[type*="radio"]').change(function () {
                var me = $(this);
                log.html(me.attr('value'));
            });


            // Activate tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Filter table rows based on searched term
            $("#search").on("keyup", function () {
                var term = $(this).val().toLowerCase();
                $("table tbody tr").each(function () {
                    $row = $(this);
                    var name = $row.find("td:nth-child(2)").text().toLowerCase();
                    console.log(name);
                    if (name.search(term) < 0) {
                        $row.hide();
                    } else {
                        $row.show();
                    }
                });
            });

            $("#fileComplaint").on("click",function (){

                $.redirectPost('GfileComplaint.php', {idOfOpendGroup: idOfOpendGroup});
            })




        });


        function mouseHere(e) {
            e = e || window.event;
            var target = e.currentTarget
            target.style.backgroundColor = "black";

        }

        function mouseLeft(e) {
            e = e || window.event;
            var target = e.currentTarget
            var clas;
            clas = $(target).attr('class');
            if (clas == "odd")
                target.style.backgroundColor = "#33333333";
            else
                target.style.backgroundColor = null;

        }

        function openComments(e) {
            e = e || window.event;

            console.log(e.target.tagName)
            if (e.target.tagName === "A" ||e.target.tagName === "BUTTON")
                return;
            var target = e.currentTarget;

            $('.modal-wrapper').toggleClass('open');
            $('.page-wrapper').toggleClass('blur');

            $("#openedlistItem").val(target.id);
            console.log( $("#openedlistItem").attr("value"));
            if(target.id!="")
                idOfOpendGroup = target.id;


            if(target.tagName==="TR"){
                console.log("here")
                $(".content").load("getComments.php",{groupID:idOfOpendGroup})
            }



        }


        function stopEvent(e) {
            e = e || window.event;

            e.stopPropagation();
        }
    </script>
    <style>
        .login-box {
            position: relative;
            padding: 50px;
            left: 50%;
        }

        .search {
            width: 100%;
            position: relative;
            display: flex;
        }

        .searchTerm {
            width: 100%;
            border: 3px solid #151616;
            border-right: none;
            padding: 5px;
            height: 20px;
            border-radius: 5px 0 0 5px;
            outline: none;
            color: #9DBFAF;
            direction: rtl;

        }

        .searchTerm::placeholder {

            text-align: right;

        }

        .searchTerm:focus {
            color: #151616;
        }

        .searchButton {
            width: 40px;
            height: 36px;
            border: 1px solid #151616;
            background: #151616;
            text-align: center;
            color: #fff;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 20px;
        }

        /*Resize the wrap to see the search bar change!*/
        .wrap {
            width: 100%;


        }

        .center {
            margin-left: auto;
            margin-right: auto;

            width: 50%;
            padding: 10px;
        }
    </style>


    <title project 444>

    </title>

</head>
<body>
<div>
    <header>

        <ul>

              <li><a class="ab" href="Logout.php">تـسـجـيل الـخـروج</a></li>
              <li><a  class="ab"    href="AdminComplaints.php">قائمة الشكوى</a></li>
              <li><a  class="ab"    href="AdminIndex.php">الصـفـحة الـرئـيسـية</a></li></ul>









            <div class="center">
                <div class="wrap">
                    <form METHOD="post" action="promoteToAdmin.php">
                        <div class="search">

                            <input type="text" name="searchTerm" class="searchTerm " placeholder=" ابحث عن الاسم  ">
                            <button type="submit" name="search" class="searchButton">
                                <i class="fa fa-search"></i></button>
                        </div>
                    </form>


                </div>
            </div>

            <h2>
                <a href="#" class="logo">
تـرقـية الـحـسـابـات                </a>
            </h2>

    </header>

</div>


<div class="login-box " style=" background-color: #161616;  top: 200px; height: auto; width: 70%">

    <table class="table table-striped" style="top:0px ; color: #ffffff">


        <thead>
        <tr>
            <th>#</th>
            <th style="width: 50%;"> اسـم الحـسـاب</th>
            <th style="width: 50%;">الأيـمـيـل</th>
            <th style="width: 50%;"> الدور</th>
            <th style="width: 50%;">انضم</th>

        </tr>

        </thead>
        <tbody>
        <?php



        if (isset($_POST['searchTerm'])) {
            $searchTerm = $_POST['searchTerm'];
            $username_name = stripcslashes(strtolower($_POST['searchTerm']));
            $get_userName = "SELECT id,username,email,Role FROM user WHERE username='$username_name'";
            $res_user_name = mysqli_query($conn,$get_userName);






        }else{
            $get_userName ="SELECT id,username,email,password,Role FROM user";
            $res_user_name = mysqli_query($conn,$get_userName);
}
        


        if (mysqli_num_rows($res_user_name) > 0) {
            $i = 1;

            while ($row =  $res_user_name->fetch_assoc()  ) {

                if ($i % 2 == 0)
                    $eo = "even";
                else
                    $eo = "odd";
                echo "
                <form action='promoteAdminPOST.php' method='post' >
                ";
                echo '<tr  class="' . $eo . ' trigger" onclick="openComments()" id="' . $row["id"] . '" onmouseenter="mouseHere()" onmouseleave="mouseLeft()" ><td>' . $i++ . '</td>';
                echo '<td id="' . $row["id"] . '">' . $row["username"] . '</td>';
                echo '<td>' . $row["email"] . '</td>';
                echo "<input type='hidden' name='idOfOpendGroup' value='".$row["id"]."'></input>";
            if($row["Role"]==2){
                echo '<td> admin </td>';
                echo '<td><button type="submit"  name="promote" value="ToUser" class="removeButton" style="pointer-events: all">تنزيل</button></td></tr>';
            }
            else{
                echo '<td> user </td>';
                echo '<td><button type="submit"  name="promote" class="removeButton" value="ToAdmin" style="pointer-events: all">تـرقـية</button></td></tr>';
            }


                echo "</form>";
            }
        }







        ?>


        </tbody>
    </table>
</div>


<div class='modal-wrapper' onclick='openComments()'>
    <div class='modal' onclick='stopEvent()'>
        <div class='head'>
            <a type='button' style='left:6px;top:4px' onclick='openComments()' style='ta: right'
               class='panel__prev-btn btn-close trigger'
               aria-label='Go back to home page' title='Go back to home page' href='javascript:;'>
                <svg fill='rgba(255,255,255,0.5)' height='24' viewBox='0 0 24 24' width='24'
                     xmlns='http://www.w3.org/2000/svg'> // the top left arrow
                    <path d='M0 0h24v24H0z' fill='none'/>
                    <path d='M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z'/>
                </svg>
            </a>
            <?php

            if(isset($_COOKIE["username"]))
                echo '<div class="dots" onclick="this.classList.toggle('."'active'".');">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="shadow cut"></div>
                <div class="containerd cut">
                    <div class="drop cut2"></div>
                </div>
                <div class="list">
                    <ul>
                        <li id="fileComplaint">
                            هناك مشكلة؟
                        </li>

                    </ul>
                </div>
                <div class="dot"></div>
            </div>
            <div class="cursor"
                 onclick="document.querySelector('."'.dots'".').classList.toggle('."'active'".');"></div>';
            ?>
        </div>


        <span class='HeaderContentSpreator'></span>
        <div class='content'>


        </div>

        <?PHP
        if(isset($_COOKIE["username"])) {
            echo "
<div class='center-box' >
            <div class='bottom' >
                <div class='form' >

                    <form action = 'Comment.php' method = 'POST' >
                        <h1 class='commentHead' > كيف كان القروب ؟ </h1 >
                        <div class='text-input' >
                            <input type = 'hidden' value = '' id = 'openedlistItem' name = 'openedlistItem' >
                            <input type = 'text' name = 'message' value = ''  placeholder = 'تعليق...' />
                            <span class='separator' > </span >
                        </div >
                        <input type = 'hidden' name = 'Uid' value = 'Anonymous' />

                        <div class='formButtons' >
                            <span class='star-cb-group' >
      <input type = 'radio' id = 'rating-5' name = 'rating' value = '5' /><label for='rating-5' > 5</label >
      <input type = 'radio' id = 'rating-4' name = 'rating' value = '4' checked = 'checked' /><label for='rating-4' > 4</label >
      <input type = 'radio' id = 'rating-3' name = 'rating' value = '3' /><label for='rating-3' > 3</label >
      <input type = 'radio' id = 'rating-2' name = 'rating' value = '2' /><label for='rating-2' > 2</label >
      <input type = 'radio' id = 'rating-1' name = 'rating' value = '1' /><label for='rating-1' > 1</label >
      <input type = 'radio' id = 'rating-0' name = 'rating' value = '0' class='star-cb-clear' /><label for='rating-0' > 0</label >
      </span >
                            <input type = 'submit' name = 'comm' id = 'submit' value = 'ارسال' />
                        </div >
                    </form >

                </div >
            </div >
        </div >
         ";
        }
        ?>
    </div>


</body>
</html>
