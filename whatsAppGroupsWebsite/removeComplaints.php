<?php
include('Connection.php');
//delete group from admin page
$id=$_POST["complaintID"];


$sql= "delete from usercomplaint where id=$id";
mysqli_query($conn,$sql);

header("location:AdminComplaints.php");
?>