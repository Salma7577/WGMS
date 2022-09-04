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
        <li><a  class="ab"    href="index.php">الصفحة الرئيسية</a></li></ul>






    <h2>
        <a href="#" class="logo">
            صفحة الأدمن
        </a>
    </h2>

</header>
<div class="login-box " style=" transform: translate(700px); margin-top: 50px;
background-color: #161616;       width: 500px;  "><h2 style="color: green">تم رفع الشكوى</h2></div>







</div>
</body>