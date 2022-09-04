<?php include('Connection.php'); ?>
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

                 if ($("#user").val().length < 6 ) {
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
                        $("#errorDiv").css("color","red");
                        $("#errorDiv").text("اسم المستخدم يجب ان يكون مكون على الاقل من 6 خانات")
                        $("#user").css("border-bottom", "1px solid red")

                    }else {
                        $.post("CheckSignUp.php", {'username': $("#user").val()}, function (responsetext, statustext) {

                            console.log(responsetext);

                            if (responsetext != "") {
                                isUsernameExist = true;
                                console.log("اسم المستخدم موجود بالفعل ")
                                $("#errorDiv").css("color","red");
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



            $("#form").submit(()=>{

                $("#user").prop('disabled', false);
                $("#email").prop('disabled', false);


            })

        });

        function editUsername(){
            $("#user").prop('disabled', function(i, v) {
                if(v) {
                    $("#userPin").css("visibility","hidden")
                    $("#userCheck").css("visibility","visible")

                }
                else {
                    $("#userCheck").css("visibility","hidden")
                    $("#userPin").css("visibility","visible")
                }
                    return !v; });
        }
        function editEmail(){
            $("#email").prop('disabled', function(i, v) {

                if(v) {
                    $("#emailPin").css("visibility","hidden")
                    $("#emailCheck").css("visibility","visible")

                }
                else {
                    $("#emailCheck").css("visibility","hidden")
                    $("#emailPin").css("visibility","visible")
                }
                return !v; });

        }

        function editPassword(){
            $(location).prop('href', 'ChangePassword.php')
        }


    </script>
</head>
<body>
<div class="login-box" style="width: 650px">
    <a type="button" class="panel__prev-btn" aria-label="Go back to home page" title="Go back to home page" href="index.php
    ">
        <svg fill="rgba(255,255,255,0.5)" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
            // the top left arrow
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"/>
        </svg>
    </a>
    <h2>الأعدادات</h2>
    <form action="Setting_POST.php" method="POST" id="form">


        <?php
            $sql = "select email from user where id = ".$_COOKIE["id"];
            $q=mysqli_query($conn,$sql);
            $row = $q->fetch_assoc();
        ?>
        <div class="infoDisplay">
            <button type="button" onclick="editUsername()" style="position: absolute;height: 48px;width: 48px; bottom: 30px">
                <svg id="userPin" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" style=" fill:#000000;">
                    <path d="M 18.414062 2 C 18.158062 2 17.902031 2.0979687 17.707031 2.2929688 L 15.707031 4.2929688 L 14.292969 5.7070312 L 3 17 L 3 21 L 7 21 L 21.707031 6.2929688 C 22.098031 5.9019687 22.098031 5.2689063 21.707031 4.8789062 L 19.121094 2.2929688 C 18.926094 2.0979687 18.670063 2 18.414062 2 z M 18.414062 4.4140625 L 19.585938 5.5859375 L 18.292969 6.8789062 L 17.121094 5.7070312 L 18.414062 4.4140625 z M 15.707031 7.1210938 L 16.878906 8.2929688 L 6.171875 19 L 5 19 L 5 17.828125 L 15.707031 7.1210938 z"></path>
                </svg>
                <svg id="userCheck" style="position: absolute; left: 3px; top: 3px; visibility: hidden;" viewBox="0 0 1792 1792"  xmlns="http://www.w3.org/2000/svg"><path d="M1472 930v318q0 119-84.5 203.5t-203.5 84.5h-832q-119 0-203.5-84.5t-84.5-203.5v-832q0-119 84.5-203.5t203.5-84.5h832q63 0 117 25 15 7 18 23 3 17-9 29l-49 49q-10 10-23 10-3 0-9-2-23-6-45-6h-832q-66 0-113 47t-47 113v832q0 66 47 113t113 47h832q66 0 113-47t47-113v-254q0-13 9-22l64-64q10-10 23-10 6 0 12 3 20 8 20 29zm231-489l-814 814q-24 24-57 24t-57-24l-430-430q-24-24-24-57t24-57l110-110q24-24 57-24t57 24l263 263 647-647q24-24 57-24t57 24l110 110q24 24 24 57t-24 57z"/></svg>

            </button>

            <input type="text" disabled name="username" required="" id="user" maxlength="25" value="<?php echo $_COOKIE["username"]?>">
            <label>اسم المستخدم</label>
        </div>
        <div class="infoDisplay">
            <button type="button" onclick="editEmail()" style="position: absolute;height: 48px;width: 48px; bottom: 30px">
                <svg id="emailPin" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" style="  fill:#000000;">
                    <path d="M 18.414062 2 C 18.158062 2 17.902031 2.0979687 17.707031 2.2929688 L 15.707031 4.2929688 L 14.292969 5.7070312 L 3 17 L 3 21 L 7 21 L 21.707031 6.2929688 C 22.098031 5.9019687 22.098031 5.2689063 21.707031 4.8789062 L 19.121094 2.2929688 C 18.926094 2.0979687 18.670063 2 18.414062 2 z M 18.414062 4.4140625 L 19.585938 5.5859375 L 18.292969 6.8789062 L 17.121094 5.7070312 L 18.414062 4.4140625 z M 15.707031 7.1210938 L 16.878906 8.2929688 L 6.171875 19 L 5 19 L 5 17.828125 L 15.707031 7.1210938 z"></path>
                </svg>
                <svg id="emailCheck" style="position: absolute; left: 3px; top: 3px; visibility: hidden;" viewBox="0 0 1792 1792"  xmlns="http://www.w3.org/2000/svg"><path d="M1472 930v318q0 119-84.5 203.5t-203.5 84.5h-832q-119 0-203.5-84.5t-84.5-203.5v-832q0-119 84.5-203.5t203.5-84.5h832q63 0 117 25 15 7 18 23 3 17-9 29l-49 49q-10 10-23 10-3 0-9-2-23-6-45-6h-832q-66 0-113 47t-47 113v832q0 66 47 113t113 47h832q66 0 113-47t47-113v-254q0-13 9-22l64-64q10-10 23-10 6 0 12 3 20 8 20 29zm231-489l-814 814q-24 24-57 24t-57-24l-430-430q-24-24-24-57t24-57l110-110q24-24 57-24t57 24l263 263 647-647q24-24 57-24t57 24l110 110q24 24 24 57t-24 57z"/></svg>
            </button>
            <input type="email" disabled name="email" required="" id="email" maxlength="30" value="<?php echo $row["email"]?>">
            <label>البريد الالكتروني</label>
        </div>

        <div class="infoDisplay">
            <button type="button" onclick="editPassword()" style="position: absolute;height: 48px;width: 48px; bottom: 30px">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 24 24" style=" fill:#000000;">
                    <path d="M 18.414062 2 C 18.158062 2 17.902031 2.0979687 17.707031 2.2929688 L 15.707031 4.2929688 L 14.292969 5.7070312 L 3 17 L 3 21 L 7 21 L 21.707031 6.2929688 C 22.098031 5.9019687 22.098031 5.2689063 21.707031 4.8789062 L 19.121094 2.2929688 C 18.926094 2.0979687 18.670063 2 18.414062 2 z M 18.414062 4.4140625 L 19.585938 5.5859375 L 18.292969 6.8789062 L 17.121094 5.7070312 L 18.414062 4.4140625 z M 15.707031 7.1210938 L 16.878906 8.2929688 L 6.171875 19 L 5 19 L 5 17.828125 L 15.707031 7.1210938 z"></path>
                </svg>

            </button>
            <input type="password" disabled name="email" required="" id="email" maxlength="30" value="*************">
            <label>كلمة المرور</label>
        </div>

        <div style="alignment: center; text-align: center ; color: green; direction: rtl" id="errorDiv"><?php
            if(isset($_GET["PassChanged"]))
                echo 'تم تغير كلمة السر بنجاح.';
            elseif (isset($_GET["UEChanged"]))
                echo 'تم الحفظ بنجاح.';
            ?></div>
        <button type="submit" name="submit" class="agreebutton">
            حفظ
        </button>

        <a style="position: absolute; right:35px;" href="index.php">
            الصفحه الرئيسيه </a>
    </form>
</div>

</body>
</html>