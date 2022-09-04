<?php
include('Connection.php');


$sql = "update user set username='".$_POST['username']."',email='".$_POST['email']."' where id='". $_COOKIE['id']."';";

echo mysqli_query($conn,$sql);

setcookie("username","",time()-3600,"/");


setcookie("username",$_POST['username'],time()+86400,"/");


header("location:Settings.php?UEChanged=yes'");
