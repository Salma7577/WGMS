<?php
include('Connection.php');
;/*  this represents wihch group the comment is for */
;/* the user who wrote the comment */
if(isset($_POST['comm'])){
    $Uid= $_COOKIE["username"];
    $rating=$_POST["rating"];
    $groupID = $_POST["openedlistItem"];
    $message= stripcslashes (strtolower($_POST['message']));
    $sql="INSERT INTO comments (username,message,groupID,rating) 
    VALUES ('$Uid','$message','$groupID','$rating')";
    $result=mysqli_query($conn,$sql);
    header('location:index.php');
}




?>

   
