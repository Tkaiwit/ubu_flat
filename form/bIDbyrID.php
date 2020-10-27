<?php session_start(); include '../function/connectDB.php';
$userID=$_SESSION['UserID'];
$resident="SELECT ResidentID, UserID,RoomTypeName2 FROM `v_resident` WHERE UserID=$userID ";
$resul=mysqli_fetch_assoc(mysqli_query($condb,$resident));
$RoomTypeName2=$resul['RoomTypeName2'];
$rID=$_POST['rID'];
$rIDbef=$_POST['rIDbef'];
$room="SELECT * FROM v_room WHERE BuildingID=$_POST[bID] ORDER BY RoomStatus, RoomName";
$gerroom=mysqli_query($condb,$room);
echo "<select name=\"roomname\" id=\"roomname\" onchange=\"Swap_Room($_POST[bID],$rIDbef,this.options[this.selectedIndex].value)\">";
    echo "<option value=\"0\">เลือกห้อง</option>";
    while($row=mysqli_fetch_assoc($gerroom)){
        echo "<option value=\"$row[RoomID]\" ";
        if($rID==$row['RoomID']){echo " selected"; $Roomname=$row['RoomName'];}
        echo($rIDbef==$row['RoomID'])?"disabled":"";
        echo($row['RoomTypeName2']!=$RoomTypeName2)?"disabled":"";
        echo ">$row[RoomName] - $row[RoomStatusName] - $row[RoomTypeName2]</option>";
    }
echo "</select>";
echo chr(5);
echo"<label> $Roomname</label>";
echo chr(5);
$sqlbuil="SELECT BuildingID,BuildingName FROM building WHERE BuildingID=$_POST[bID]";
$resbuil=mysqli_fetch_assoc(mysqli_query($condb,$sqlbuil));
echo"<label>$resbuil[BuildingName]</label>";
echo chr(5);
$vresident="SELECT ResidentID,BuildingID,RoomID,UserPNameT,UserNameT,UserSNameT FROM v_resident WHERE BuildingID=$_POST[bID] AND RoomID=$rID";
$getvresident=mysqli_fetch_assoc(mysqli_query($condb,$vresident));
if($getvresident>0){
echo "<label>$getvresident[UserPNameT]$getvresident[UserNameT] $getvresident[UserSNameT]</label>";
}else{
echo "<label>ไม่มีผู้พักอาศัย</label>";
}
echo chr(5);
echo "<label>$_POST[bID]</label>";
?>