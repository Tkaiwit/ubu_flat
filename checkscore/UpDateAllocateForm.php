<?php session_start(); include '../function/connectDB.php'; include '../function/date.php';
$ResidentID=$_POST['ResidentID'];
$SocialID=$_POST['SocialID'];
$RequestID=$_POST['RequestID'];
$BuildingID=$_POST['BuildingID'];
$befRoomID=$_POST['befRoomID'];
$RoomID=$_POST['RoomID'];
$StaffID=$_POST['StaffID'];
$LivingCount=$_POST['LivingCount'];
$st_dayred=$_POST['st_dayred'];
$st_monthred=$_POST['st_monthred'];
$st_yearred=$_POST['st_yearred'];
$get_dayred=$_POST['get_dayred'];
$get_monthred=$_POST['get_monthred'];
$get_yearred=$_POST['get_yearred'];

$sqlstaff="UPDATE staff SET RoomID=$RoomID,BuildingID=$BuildingID WHERE StaffID=$StaffID";
mysqli_query($condb,$sqlstaff);
$sqlrequestform="UPDATE request_form SET RoomID=$RoomID,BuildingID=$BuildingID,KeyAcceptDate='$get_yearred-$get_monthred-$get_dayred' WHERE RequestID=$RequestID";
mysqli_query($condb,$sqlrequestform);
$sqlmembers="UPDATE members SET BuildingID=$BuildingID ,Checkin_date='$st_yearred-$st_monthred-$st_dayred' WHERE SocialID=$SocialID";
mysqli_query($condb,$sqlmembers);
$sqlresident="UPDATE resident SET RoomID=$RoomID ,StartDate='$st_yearred-$st_monthred-$st_dayred' WHERE ResidentID=$ResidentID";
mysqli_query($condb,$sqlresident);

if($RoomID != $befRoomID){
    $sqlroom="UPDATE room SET RoomStatus=1 WHERE RoomID=$befRoomID";
    mysqli_query($condb,$sqlroom);
    $sqlroomid="UPDATE room SET RoomStatus=3 WHERE RoomID=$RoomID"; 
    mysqli_query($condb,$sqlroomid);
}
?>