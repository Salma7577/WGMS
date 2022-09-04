<?php
include 'Connection.php';

$cID = $_POST["commentId"];

$sql = "delete from comments where Cid=".$cID;

mysqli_query($conn,$sql);

header("location:AdminIndex.php");
