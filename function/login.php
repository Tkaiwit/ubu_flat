<?php
session_start();
if (isset($_POST['Username']) && isset($_POST['Password'])) {
include('connectDB.php');
$Username = mysqli_real_escape_string($condb,$_POST['Username']);
$Password = md5($_POST['Password']);
$er = "Check Username and Password";
$mysql="SELECT UserID,UserNameT,UserSNameT,UserType,Passwd, LeaderType,SemiCommitee FROM members WHERE UserLogin='$Username' or SocialID='$Username' ";
$row = mysqli_fetch_array(mysqli_query($condb,$mysql));
	if($row['Passwd']==$Password and $row['UserID']>0){
		$_SESSION["UserID"] = $row["UserID"];
		$_SESSION["UserName"] = $row["UserNameT"]." ".$row["UserSNameT"];
		$_SESSION["UserType"] = $row["UserType"];
		$_SESSION['LeaderType'] = $row['LeaderType'];
		$_SESSION['SemiCommitee'] = $row['SemiCommitee'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$sqllogin ="INSERT INTO loginhistory(UserID, FromIP, Browser) ";
		$sqllogin .=" VALUES ('$_SESSION[UserID]','$ip','$_SERVER[HTTP_USER_AGENT]')";
	 	mysqli_query($condb,$sqllogin);
		echo 1;
	} else {
		echo 0;
	}
}
 ?>
