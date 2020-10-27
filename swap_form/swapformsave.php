<?php session_start(); include '../function/connectDB.php';
$userID=$_SESSION['UserID'];
$buildingID=$_POST['buildingID'];
$RoomID=$_POST['roomname'];
$resident="SELECT ResidentID, UserID FROM `resident` WHERE UserID=$userID ORDER BY `ResidentID` DESC LIMIT 1";
$resul=mysqli_fetch_assoc(mysqli_query($condb,$resident));
$Resident2="SELECT ResidentID, BuildingID, RoomID , EndDate FROM `v_resident`WHERE RoomID=$RoomID AND EndDate IS NULL";
$getResident2=mysqli_fetch_assoc(mysqli_query($condb,$Resident2));
$ResidentID2=$getResident2['ResidentID'];

$room="SELECT RoomID,RoomStatus FROM room WHERE RoomID=$RoomID";
$getroom=mysqli_fetch_assoc(mysqli_query($condb,$room));
$roomStatus=$getroom['RoomStatus'];

$swap_room="INSERT INTO z_swaproom(ResidentID1, MoveToRoomID, UserID ";
if($roomStatus==3){
    $swap_room.=",ResidentID2";
    $swap_room.=") VALUES ($resul[ResidentID], $RoomID, $userID,$ResidentID2)";
}else{
    $swap_room.=") VALUES ($resul[ResidentID], $RoomID, $userID)";
}
echo(mysqli_query($condb,$swap_room))?1:0;
echo chr(5);
echo "<button type=\"button\" onclick=\"printDiv('lableReturnform')\" class=\"btn-add\"><i class=\"icons print nameicon\"></i>พิมพ์</button>";
?>