<?php include ("Connection.php")?>
<head>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="CSSs/Style.css">
    <link rel="stylesheet" href="CSSs/login.css">
    <link rel="stylesheet" href="CSSs/GFileComplaintCSS.css">
    <script>

        $(document).ready(function (){
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

        })
        function solved(e)
        {
            e = e || window.event;

            console.log(e.target.id)
            $.redirectPost("AdminIndex.php",{searchTerm:e.target.id})

        }

    </script>
</head>


<body>


<header>

    <ul>

        <li><a class="ab" href="Logout.php">تـسـجـيل الـخـروج</a></li>
        <li><a  class="ab"    href="promoteToAdmin.php">الـتـرقـيـه الـى ادمـن</a></li>
        <li><a  class="ab"    href="AdminIndex.php">الصفحة الرئيسية</a></li></ul>






    <h2>
        <a href="#" class="logo">
            صفحة الأدمن
        </a>
    </h2>

</header>
<?php
$sql="SELECT * FROM usercomplaint";
$result=mysqli_query($conn,$sql);
if($result->num_rows==0){
    echo '<div class="login-box " style=" transform: translate(700px); margin-top: 50px;
background-color: #161616;       width: 500px;  "><h2 style="color: white">لا يوجد شكاوى</h2></div>';

}

while ($row=$result->fetch_assoc()){


$groupName=$row["group_name"];
$userName=$row["Username"];
$complaint=$row["Complaint"];
$complaintID=$row["id"];
echo '
<div class="login-box " style=" transform: translate(700px); margin-top: 50px;
background-color: #161616;       width: 500px;  ">


    <form id="Cform" action="removeComplaints.php" method="POST" >
        <div class="GroupNameDiv">'.$userName.'</div>
        <div class="GroupNameDiv"id="groupName">'.$groupName.'</div>
        <div class="GroupNameDiv">'.$complaint.'</div>
           
        <div></div>

          <button type="submit" name="add" id="submit" class="agreebutton">

            تم الحل
        </button>

        <button type="button" id="'.$groupName.'" style="position: absolute; right:35px; " value="'.$groupName.'"  class="subButton" onclick="solved()" >

            اذهب للقروب
        </button>
  
        <input type="hidden" id="search" name="searchTerm"  value="'.$groupName.'">
        <input type="hidden" id="idd" name="complaintID" value="'.$complaintID.'">
    </form>


</div>';

}
?>


</div>
</body>