<?php
include('Connection.php');
if(isset($_POST['submit'])){
    $username= stripcslashes (strtolower($_POST['username']));
    $email=stripcslashes (strtolower($_POST['email']));
    $password=stripcslashes (($_POST['password']));
}

$username=htmlentities(mysqli_real_escape_string($conn,$_POST['username']));
$email=htmlentities(mysqli_real_escape_string($conn,$_POST['email']));
$password=htmlentities(mysqli_real_escape_string($conn,$_POST['password']));


if(empty($username)){

    $user_error='<p id="eroor">Please enter username </p> <br>';
    $err_s=1;

}elseif(strlen($username)<6){
    $user_error='<p id="eroor"> Username needs to have a minimum of 6 letters</p> <br>' ;
    $err_s=1;

} elseif(filter_var($username,FILTER_VALIDATE_INT)) {
    $user_eroor='<p id="eroor"> Please enter a valid username not a number</p> <br>';
    $err_s=1;
}

$check_user="SELECT * FROM user WHERE username='$username'";
$check_email="SELECT * FROM user WHERE email='$email'";
$res_user=mysqli_query($conn,$check_user) or die(mysqli_error($conn));
$res_email=mysqli_query($conn,$check_email) or die(mysqli_error($conn));

if(mysqli_num_rows($res_user) > 0){
    $user_error='Sorry... Username already Taken <br>';
    $err_s=1;
}else if (mysqli_num_rows($res_email) > 0){
    $user_error='Sorry... email already taken';
    $err_s=1;
}






if(empty($email)){
    $user_error='<p id="eroor"> Please write your email <br></p>';
    $err_s=1;
} elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
    $user_eroor='<p id="eroor"> Please enter a valid email </p> <br>';
    $err_s=1;
}
if(empty($password)){
    $pass_error='<p id="eroor"> Please write password at least 6 letters and number </p> <br>';
    $err_s=1;
    include('register.php');

}elseif(strlen($password)<6){
    $pass_error='<p id="eroor"> Password needs to have a minmum of 6 letters and number <p> <br>' ;
    $err_s=1;
    include('register.php');
}
else{
    if($err_s==0 && ($num_rows == 0)){
        $sql="INSERT INTO user(username,email,password)
        VALUES('$username','$email','$password')";

        mysqli_query($conn,$sql);
        header('location:LogIn.php');
    }else{
        include('register.php');
    }
}





?>