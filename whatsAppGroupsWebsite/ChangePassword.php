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


            $("#form").submit(function () {
                // make sure that all the fields are filled

                if ($("#conpass").val() != $("#pass").val()) {
                    return false;
                } else if ( $("#pass").val().length < 6) {
                    return false;
                }  else
                    return true;
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
    <a type="button" class="panel__prev-btn" aria-label="Go back to home page" title="Go back to home page" href="Settings.php
    ">
        <svg fill="rgba(255,255,255,0.5)" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            // the top left arrow
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"/>
        </svg>
    </a>
    <h2>تغير كلمة المرور</h2>
    <form action="ChangePassword_POST.php" method="POST" id="form">

        <div class="user-box">
            <input type="password" name="newPassword" id="pass" required="" maxlength="20">
            <label>كلمة المرور الجديدة</label>
        </div>

        <div class="user-box">
            <input type="password" name="CNewPassword" id="conpass" required="" maxlength="20">
            <label>تأكيد كلمة المرور الجديدة</label>
        </div>
        <div style="alignment: center; text-align: center ; color: red" id="errorDiv"></div>
        <button type="submit" name="submit" class="agreebutton">
            حفظ
        </button>

        <a style="position: absolute; right:35px;" href="index.php">
            الصفحه الرئيسيه </a>
    </form>
</div>

</body>
</html>