<?php
include('Connection.php');
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){

    $username= stripcslashes (strtolower($_POST['username']));
    $password=stripcslashes (($_POST['password']));

    $username=filter_input(INPUT_POST,'username');
    $password=stripcslashes(strtolower($_POST['password']));
    $username=htmlentities(mysqli_real_escape_string($conn,$_POST['username']));
    $password=htmlentities(mysqli_real_escape_string($conn,$_POST['password']));

}
if(empty($username)){

    $user_error='<p id="eroor">Please enter username </p> <br>';
    $err_s=1;


}
if(empty($password)){
    $pass_error='<p id="eroor"> Please write password  </p> <br>';
    $err_s=1;
    include('LogIn.php');
}
if(! isset ($err_s)){
    //AND password='$password'

    $sql="SELECT * FROM user where username='$username' AND password='$password' AND Role=1";
    $sqll="SELECT * FROM user where username='$username' AND password='$password' AND Role=2";


    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);

    $rresult=mysqli_query($conn,$sqll);
    $roww=mysqli_fetch_assoc($rresult);



    if((mysqli_num_rows($rresult)==1 && ($err_s==0))){
        setcookie("username",$roww['username'],time()+86400,"/");
        setcookie("id",$roww['id'],time()+86400,"/");


        header('location:AdminIndex.php');
        exit();

    }

    else { if(mysqli_num_rows($result)==1 && ($err_s==0)){
        setcookie("username",$row['username'],time()+86400,"/");
        setcookie("id",$row['id'],time()+86400,"/");

        header('location:index.php');
        exit();
    }else{
        $incorrectLogin= 'You have entered incorrect username/password';

        include('login.php');


    }
    }
}

?>