<?php
include('Connection.php');
if(isset($_POST['add'])){
    $comment= $_POST["Comment"];
    $groupID= $_POST["groupID"];
    $sql="SELECT * FROM usergroup WHERE id='$groupID'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $chose=$_POST['complaint'];
    $use=$_COOKIE["username"];
    if(isset($row))
        $groupname=$row['group_name'];

    $sqll="INSERT INTO usercomplaint(group_name,group_id,Complaint,Username)
   VALUES('$groupname','$groupID','$comment','$chose')";
    mysqli_query($conn,$sqll);

   header('location:thxForComplaint.php');







}