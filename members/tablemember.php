<?php session_start(); include '../function/connectDB.php';  include '../function/date.php';
$StartDate=$_POST['yearly']."-".$_POST['monthly']."-01";

$resident ="SELECT RS.ResidentID, R.BuildingID, R.RoomName, MC.RoomRate, R.BuildingName, RS.UserPNameT, RS.UserNameT, RS.UserSNameT, R.RoomID, R.RoomStatusName ,
RS.PositionName, R.RoomTypeName2, RS.UserID ,IF(R.RoomStatus=1,'ว่าง พร้อมใช้งาน',IF(R.RoomStatus=2,'ว่าง ไม่พร้อมใช้งาน',IF(R.RoomStatus=3,'	
มีผู้พักอาศัย','ห้องรับรอง คณะ'))) StatusRoom
FROM v_resident RS RIGHT JOIN v_room R ON R.RoomID=RS.RoomID LEFT JOIN monthlycharge MC ON MC.RoomID=R.RoomID AND MC.MonthlyPeriod=$_POST[monthly] AND MC.Yearly=$_POST[yearly]";
if($_POST['BuildingID']>0){
    $resident.=" WHERE R.BuildingID=$_POST[BuildingID]";
}
$resident.=" ORDER BY R.BuildingID,R.RoomName";
if($_POST['st']==1){
    mysqli_query($condb,"CALL genmonthlycharge($_POST[monthly],$_POST[yearly])");
}
$getresident=mysqli_query($condb,$resident);

echo "1".chr(5);
?>
<table class="table1 table-sm">
            <thead>
                <tr>
                    <th width="9%" align="center"># ที่</th>
                    <th align="left">อาคาร</th>
                    <th align="left">ชื่อห้อง</th>
                    <th align="left">ชื่อ-นามสกุล</th>
                    <?php  if($_SESSION['UserType']!=10 && $_SESSION['UserType']!=11 && $_SESSION['UserType']!=6){ ?>
                    <th align="left">ตำแหน่ง</th>
                    <th align="left">ประเภทห้อง</th>
                    <th align="left">ค่าบำรุงห้อง</th>
                    <th width="12%">จัดการ</th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody id="myTable">
                <?php $x=0; $RoomRate=0; while($row=mysqli_fetch_assoc($getresident)){$x++; 
                if($row['RoomRate']>0){$RoomRate=1;}
                    echo "<tr";
                    echo ($row['ResidentID']<1)?" style=\"background: #d0edd4;\"":"";
                    echo ">";
                        echo "<td align=\"center\">$x</td>";
                        echo "<td>$row[BuildingName]</td>";
                        echo "<td>$row[RoomName]</td>";
                        echo "<td>";
                        echo($row['ResidentID']>0)?$row['UserPNameT'].$row['UserNameT']."".$row['UserSNameT']:$row['StatusRoom']."</td>";
                        if($_SESSION['UserType']!=10 && $_SESSION['UserType']!=11 && $_SESSION['UserType']!=6){
                        echo "<td>$row[PositionName]</td>";
                        echo "<td>$row[RoomTypeName2]</td>";
                        echo "<td>$row[RoomRate]</td>";
                        echo "<td align=\"center\"><a onclick=\"EditUserOther($row[UserID],2)\"><i class=\"icons setting\"></i></a></td>";
                        }
                    echo "</tr>";
                } if($x<=0){ ?>
                <tr>
                    <td colspan="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
                </tr>
                <?php }?>
            </tbody>
        </table>
<?php 
echo chr(5);
if($RoomRate==0){
    if($_SESSION['UserType'] ==9){
        echo "<button onclick=\"tableMember(1)\" class=\"btn-add\">
        <i class=\"icons save nameicon\"></i>บันทึกค่าบำรุงห้อง</button>";
    }
    
} 

?>