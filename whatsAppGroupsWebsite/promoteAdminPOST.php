<?php
include('Connection.php');
//set ROLE TO 2 
if(isset($_POST['promote']))
    $id=$_POST["idOfOpendGroup"];
    if($_POST['promote'] === 'ToAdmin')
        $sql = "UPDATE  user SET Role=2 WHERE id=$id";
    else
        $sql = "UPDATE  user SET Role=1 WHERE id=$id";

mysqli_query($conn,$sql);

header("location:promoteToAdmin.php");
?>