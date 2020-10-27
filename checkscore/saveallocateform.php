<?php session_start(); include '../function/connectDB.php'; include "../function/date.php"; $UserID=$_SESSION['UserID'];
$SocialID=$_POST['SocialID'];	$Passwd=$_POST['Passwd'];	$RequestID=$_POST['RequestID'];	$BuildingID=$_POST['BuildingID'];
$RoomID=$_POST['RoomID'];	$StaffID=$_POST['StaffID'];	$LivingCount=$_POST['LivingCount'];	
$st_dayred=$_POST['st_dayred'];	$st_monthred=$_POST['st_monthred'];	$st_yearred=$_POST['st_yearred'];	
$get_dayred=$_POST['get_dayred'];	$get_monthred=$_POST['get_monthred'];	$get_yearred=$_POST['get_yearred'];
$date=date("Y-m-d");	$RoomType=$_POST['RoomType'];	$eval_quarter=$_POST['eval_quarter'];
$eval_year=$_POST['eval_year'];

$sqlcheckmember="SELECT UserID FROM members WHERE SocialID='$SocialID' ";
$rsf=mysqli_fetch_assoc(mysqli_query($condb,$sqlcheckmember));
$memberID=$rsf['UserID'];

$sqlrequestform="UPDATE request_form SET RoomAllocated=1,AllocatedBy=$UserID,
AllocatedDate='$date',RoomID=$RoomID,BuildingID=$BuildingID,KeyAccept=1,
RoomID=$RoomID,BuildingID=$BuildingID,
KeyAcceptDate='$get_yearred-$get_monthred-$get_dayred',FormStatus=3 WHERE RequestID=$RequestID";
mysqli_query($condb,$sqlrequestform);
if($memberID<=0){
$sqlmembers="INSERT INTO members(
	SocialID, Passwd, BuildingID,
	UserPNameT, UserNameT, UserSNameT, PositionID, 
	PersonnelType, FacID, DeptID, LivingCount, Checkin_date) 
SELECT '$SocialID' UserLogin, md5('$Passwd') Passwd, BuildingID BuildingID,
    PName UserPNameT,Name UserNameT, Surname UserSNameT,
	PositionID PositionID, PersonnelType PersonnelType,
	FacID FacID, DeptID DeptID, $LivingCount LivingCount,
	$date Checkin_date
FROM Staff WHERE StaffID=$StaffID";

mysqli_query($condb,$sqlmembers);
$memberID=mysqli_insert_id($condb);
}
$sqlresident="INSERT INTO resident(
	RoomID,
	UserID,
	StartDate)
VALUES ($RoomID,$memberID,$date)";
mysqli_query($condb,$sqlresident);

$sqleval_form="UPDATE eval_form SET eval_status=2 WHERE RequestID=$RequestID";
mysqli_query($condb,$sqleval_form);

echo 1;
?>