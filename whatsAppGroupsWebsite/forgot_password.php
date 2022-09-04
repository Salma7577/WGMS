<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSSs/login.css" >


    <meta charset="UTF-8">
    <title></title>
    <style>
        .login-box {
            position: absolute;
            top: 50%;
            left: 50%;}
            </style>
   
</head>
<body >
<div class="login-box" style="width: 650px">
    <a type="button" class="panel__prev-btn" aria-label="Go back to home page" title="Go back to home page" href="LogIn.php
    ">
        <svg fill="rgba(255,255,255,0.5)" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> // the top left arrow
            <path d="M0 0h24v24H0z" fill="none"/>
            <path d="M21 11H6.83l3.58-3.59L9 6l-6 6 6 6 1.41-1.41L6.83 13H21z"/>
        </svg>
    </a>
    <h2> استعادة كلمة المرور</h2>
   
    <form action="Forgot_passwordPOST.php" method="POST" >

        <div class="user-box">
            <input type="email" name="email" required="" maxlength="30">
            <label>اكتب الايميل الخاص بك </label>
        </div>

     
        <?php
        if(isset($incorrectLogin)){
            echo '<div style="alignment: center; text-align: center ; color: red" id="errorDiv"> اسم المستخدم او الرقم السري غير صحيح</div>';
        }

        ?>
        <button type="submit" name="forgetemail1" class="agreebutton">
ارسال
        </button>

      
        <div style="font-size: 0.2cm; text-align:center; ">
        <h1>سيتم ارسال رسالة للأيميل الخاص بك لأستعادة كلمة المرور</h1>
    </div>
   

    </form>
</div>


</body>
</html>
