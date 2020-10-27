<?php
session_start();
if (isset($_POST['Username']) && isset($_POST['Password'])) {
include('connectDB.php');
$Username = $_POST['Username'];
$Password = $_POST['Password'];
$Pass = substr($Password,4,4)."-".substr($Password,2,2)."-".substr($Password,0,2);
 require './connectDB.php';
$mysql="SELECT * FROM `staff` WHERE SocialID='".$Username."' AND BirthDate='".$Pass."'";
$result = mysqli_query($condb,$mysql);

    $row = mysqli_fetch_array($result);
    if(!empty($row["StaffID"])){
	$_SESSION["UserID"] = $row["StaffID"];
    $_SESSION["Name"] = $row["Name"]." ".$row["Surname"];
    $_SESSION["Type"] = 0;
    echo "1";
    } else {
       echo "ERORR".$mysql;
    }
}
 ?>
