<?php session_start();
include '../function/connectDB.php';
$RequestID=$_POST['RequestID'];
$Status=$_POST['Status'];
$comment= $_POST['comment'];
date_default_timezone_set("Asia/Bangkok");
$date=date("Y-m-d H:i:s");
$UserID=$_SESSION['UserID'];
$sql="UPDATE request_form SET ";
$sql.=" FormAcceptDate='$date',FormAcceptBy=$UserID,FormStatus=$Status,comment='$comment' WHERE RequestID=$RequestID";
if(mysqli_query($condb,$sql)){
    echo $Status;
}else{
    echo $sql;
}
?>