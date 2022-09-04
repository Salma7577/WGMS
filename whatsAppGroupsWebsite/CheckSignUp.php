<?php
include 'Connection.php';
if(isset($_POST['username'])){
    $username = $_POST['username'];
    $sql = "SELECT * FROM user where username='$username'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        echo"اسم المستخدم محجوز";

}

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0)
        echo"الايميل مستخدم";

}


?>