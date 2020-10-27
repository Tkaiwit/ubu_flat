<?php session_start(); include '../function/connectDB.php';
$SwapID=$_POST['SwapID'];
$buildingID=$_POST['buildingID'];
$RoomID=$_POST['roomname'];

$Resident2="SELECT ResidentID, BuildingID, RoomID , EndDate FROM `v_resident`WHERE RoomID=$RoomID AND EndDate IS NULL";
$getResident2=mysqli_fetch_assoc(mysqli_query($condb,$Resident2));
$ResidentID2=$getResident2['ResidentID'];

$room="SELECT RoomID,RoomStatus FROM room WHERE RoomID=$RoomID";
$getroom=mysqli_fetch_assoc(mysqli_query($condb,$room));
$roomStatus=$getroom['RoomStatus'];

$updateSwap="UPDATE `z_swaproom` SET";
if($roomStatus==3){
    $updateSwap.=" ResidentID2=$ResidentID2,MoveToRoomID=$RoomID";
}else{
    $updateSwap.=" MoveToRoomID=$RoomID";
}
$updateSwap.=" WHERE `SwapID`=$SwapID";
echo(mysqli_query($condb,$updateSwap))?1:0;
echo chr(5);
echo "<button type=\"button\" onclick=\"printDiv('lableReturnform')\" class=\"btn-add\"><i class=\"icons print nameicon\"></i>พิมพ์</button>";
?>