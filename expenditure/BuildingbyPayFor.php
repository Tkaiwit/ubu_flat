<?php include '../function/connectDB.php'; include '../function/date.php';
$BuildingID = $_POST['BuildingID'];
$sqlmembers="SELECT UserID,LeaderType,SemiCommitee,BuildingID,UserPNameT,UserNameT,UserSNameT FROM v_members ";
if($BuildingID>0){
    $sqlmembers.=" WHERE BuildingID=$BuildingID AND LeaderType IN(1,2)";
}else{
    $sqlmembers.=" WHERE BuildingID=0";
}
$resmembers=mysqli_query($condb,$sqlmembers);
echo "<select name=\"PayFor\" id=\"PayFor\" >";
    echo "<option value=\"0\" selected disabled>เลือกคณะกรรมการ</option>";
    while($row=mysqli_fetch_assoc($resmembers)){
        echo "<option value=\"$row[UserID]\">$row[UserPNameT]$row[UserNameT]"." "."$row[UserSNameT]</option>";
    }
echo "</select>";
?>