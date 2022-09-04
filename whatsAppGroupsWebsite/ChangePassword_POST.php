<?php
include 'Connection.php';
$newPassword = $_POST["newPassword"];
$userID = $_COOKIE["id"];
$sql = "update user set password = $newPassword where id = $userID";
mysqli_query($conn,sql);
header("location:Settings.php?PassChanged='yes'");