<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSSs/login.css">


    <meta charset="UTF-8">
    <title></title>
    <style>
        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>

        $(function () {
            var isUsernameExist;
            var isEmailExist;
            var isPassValid;

            $("#form").submit(function () {
                // make sure that all the fields are filled

                if ($("#conpass").val() != $("#pass").val()) {
                    return false;
                } else if ($("#user").val().length < 6 || $("#pass").val().length < 6) {
                    return false;
                } else if (isUsernameExist) {
                    return false;
                } else if (isEmailExist) {
                    return false;
                } else
                    return true;
            });

            // check if the username is exist or not
            $("#user").change(function () {
                if ($("#user").val() != "") {
                    if($("#user").val().length<6){
                        console.log("اسم المستخدم يجب ان يكون مكون على الاقل من 6 خانات")
                        $("#errorDiv").text("اسم المستخدم يجب ان يكون مكون على الاقل من 6 خانات")
                        $("#user").css("border-bottom", "1px solid red")

                    }else {
                    $.post("CheckSignUp.php", {'username': $("#user").val()}, function (responsetext, statustext) {

                        console.log(responsetext);

                        if (responsetext != "") {
                            isUsernameExist = true;
                            console.log("اسم المستخدم موجود بالفعل ")
                            $("#errorDiv").text("اسم المستخدم موجود بالفعل ")
                            $("#user").css("border-bottom", "1px solid red")
                        }
                        if (responsetext == "") {
                            isUsernameExist = false;
                            $("#errorDiv").text("")
                            $("#user").css("border-bottom", "1px solid #fff")
                        }


                    });}
                }else
                    $("#user").css("border-bottom", "1px solid #fff")

            });
            $("#email").change(function () {
                $.post("CheckSignUp.php", {'email': $("#email").val()}, function (responsetext, statustext) {
                    console.log(responsetext)

                    if (responsetext != "") {
                        isEmailExist = true;
                        $("#errorDiv").text("البريد الالكتروني موجود بالفعل ")

                        $("#email").css("border-bottom", "1px solid red")
                    }
                    if (responsetext == "") {
                        isEmailExist = false;
                        $("#errorDiv").text("")

                        $("#email").css("border-bottom", "1px solid #fff")
                    }


                });
            });

            // change the border to red if the passwords don't match or return them to #fff if they match
            $("#conpass").change(function () {
                var password = $("#pass").val();
                var confirmPassword = $("#conpass").val();
                if ((password != confirmPassword && confirmPassword != "")&& isPassValid) {

                    $("#errorDiv").text("كلمة السر غير متطابقة ")
                    $("#conpass").css("border-bottom", "1px solid red")
                    $("#pass").css("border-bottom", "1px solid red")

                } else if ((password == confirmPassword || confirmPassword == "") && isPassValid) {
                    $("#errorDiv").text("")
                    $("#conpass").css("border-bottom", "1px solid #fff")
                    $("#pass").css("border-bottom", "1px solid #fff")
                }
            });
            $("#pass").change(function () {
                console.log($("#pass").val())
                if($("#pass").val() !=""){
                    if ($("#pass").val().length < 6) {
                        console.log("الرقم السري يجب ان يكون مكون على الاقل من 6 خانات")
                        $("#errorDiv").text("الرقم السري يجب ان يكون مكون على الاقل من 6 خانات")
                        $("#pass").css("border-bottom", "1px solid red")
                        $("#conpass").css("border-bottom", "1px solid #fff")
                        isPassValid=false;
                    } else {
                        isPassValid=true;

                        if ($("#pass").val() == $("#conpass").val() || $("#conpass").val() == "") {
                            $("#errorDiv").text("")

                            $("#conpass").css("border-bottom", "1px solid #fff")
                            $("#pass").css("border-bottom", "1px solid #fff")
                        } else {
                            $("#errorDiv").text("كلمة السر غير متطابقة ")
                            $("#conpass").css("border-bottom", "1px solid red")
                            $("#pass").css("border-bottom", "1px solid red")
                        }
                    }
                }else
            $("#pass").css("border-bottom", "1px solid #fff")
            }
        )


         });





    </script>
</head>
<body>
<div class="login-box" style="width: 650px">
    <a type="button" class="panel__prev-btn" aria-label="Go back to home page" title="Go back to home page" href="login.php
    ">
        <svg fill="rgba(255,255,255,0.5)" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            // the top left arrow
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"/>
        </svg>
    </a>
    <h2>الـتـسـجـيل</h2>
    <form action="Register_post.php" method="POST" id="form">
        <?php
        if (isset($user_error)) {
            echo $user_error;
        }

        ?>

        <div class="user-box">
            <input type="text" name="username" id="user" required="" maxlength="15">
            <label> اسم المستخدم </label>
        </div>
        <?php
        if (isset($email_error)) {
            echo $email_error;
        }

        ?>
        <div class="user-box">
            <input type="email" name="email" required="" id="email" maxlength="30">
            <label>البريد الالكتروني</label>
        </div>
        <?php
        if (isset($pass_error)) {
            echo $pass_error;
        }

        ?>
        <div class="user-box">
            <input type="password" name="password" id="pass" required="" maxlength="20">
            <label>كلمة المرور</label>
        </div>

        <div class="user-box">
            <input type="password" name="CPassword" id="conpass" required="" maxlength="20">
            <label>تأكيد كلمة المرور</label>
        </div>
        <div style="alignment: center; text-align: center ; color: red" id="errorDiv"></div>
        <button type="submit" name="submit" class="agreebutton">
            تـسـجـيـل
        </button>

        <a style="position: absolute; right:35px;" href="index.php">
            الصفحه الرئيسيه </a>
    </form>
</div>

</body>
</html>