<?php
include('Connection.php');
if(isset($_POST['add'])){
    $groupid= $_POST["idOfOpendGroup"];
    $sql="SELECT group_name FROM usergroup WHERE id='$groupid'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    $chose=$_POST['complaint'];
    $use=$_COOKIE["username"];
    if(isset($row))
        $groupname=$row['group_name'];

    $sqll="INSERT INTO usercomplaint(group_name,group_id,Complaint,Username)
   VALUES('$groupname','$groupid','$chose','$use')";
    mysqli_query($conn,$sqll);

   header('location:thxForComplaint.php');







}