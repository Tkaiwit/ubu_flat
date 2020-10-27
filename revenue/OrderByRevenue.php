<?php session_start(); include '../function/connectDB.php'; include '../function/date.php';
$monthly=$_POST['monthly'];
$yearly=$_POST['yearly'];
if($_SESSION['UserType']==6){
$monthlycharge="SELECT MC.ChargeID, RS.ResidentID, R.BuildingID, R.RoomID,IF(R.RoomStatus=1,'ว่าง พร้อมใช้งาน',IF(R.RoomStatus=2,'ว่าง ไม่พร้อมใช้งาน',IF(R.RoomStatus=3,'	
มีผู้พักอาศัย','ห้องรับรอง คณะ'))) NameRoomType,
RS.UserPNameT, RS.UserNameT, RS.UserSNameT, MC.e_price, MC.e_FT, MC.e_service, MC.e_VAT
, R.RoomName, MC.e_prevUnit, MC.e_curUnit, MC.e_curUnit-MC.e_prevUnit UnitAll, MC.MonthlyPeriod, MC.Yearly,MC.e_price+MC.e_FT+MC.e_service+MC.e_VAT total
FROM	room R 
    LEFT JOIN monthlycharge MC ON MC.RoomID=R.RoomID  
    LEFT JOIN v_resident RS ON RS.ResidentID=MC.ResidentID
    WHERE MC.MonthlyPeriod=$monthly AND MC.Yearly=$yearly ";
} else if($_SESSION['UserType']==7){
    $monthlycharge="SELECT MC.ChargeID, RS.ResidentID, R.BuildingID, R.RoomID,IF(R.RoomStatus=1,'ว่าง พร้อมใช้งาน',IF(R.RoomStatus=2,'ว่าง ไม่พร้อมใช้งาน',IF(R.RoomStatus=3,'	
    มีผู้พักอาศัย','ห้องรับรอง คณะ'))) NameRoomType,
    RS.UserPNameT, RS.UserNameT, RS.UserSNameT, MC.w_price e_price, MC.w_service e_service, MC.w_VAT e_VAT
    , R.RoomName, MC.w_prevUnit e_prevUnit, MC.w_curUnit e_curUnit, MC.w_curUnit-MC.w_prevUnit UnitAll, MC.MonthlyPeriod, MC.Yearly,MC.w_price+MC.w_VAT total
    FROM	room R 
        LEFT JOIN monthlycharge MC ON MC.RoomID=R.RoomID  
        LEFT JOIN v_resident RS ON RS.ResidentID=MC.ResidentID
        WHERE MC.MonthlyPeriod=$monthly AND MC.Yearly=$yearly ";
}
// $monthlycharge="SELECT * FROM v_monthlycharge WHERE MonthlyPeriod=$monthly AND Yearly='$yearly' AND e_curUnit IS NOT NULL Order BY BuildingID,RoomName";
$resmonC=mysqli_query($condb,$monthlycharge);
echo "<table class='table1 table-sm'>";
    echo "<thead>";
    echo "<tr>";
        echo "<th align='left'>#ที่</th>";
        echo "<th align='left'>อาคาร</th>";
        echo "<th align='left'>ห้อง</th>";
        echo "<th align='left'>ชื่อ-สกุล</th>";
        echo "<th align='left'>เดือน</th>";
        echo "<th align='left'>ปี</th>";
        echo "<th align=\"right\">เดือนก่อน</th>";
        echo "<th align=\"right\"'>เดือนนี้</th>";
        echo "<th align=\"right\">จำนวนหน่วย</th>";
        echo "<th align=\"right\">คิดเป็นเงิน</th>";
        if($_SESSION['UserType']==6){
        echo "<th align=\"right\">ค่า FT</th>";  
        echo "<th align=\"right\">ค่าบริการ</th>";
        }
        echo "<th align=\"right\">ค่า VAT</th>";
        echo "<th align=\"right\" style=\"padding-right: 23px;\">รวมทั้งสิ้น</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    $x=0;
    while($getmonC=mysqli_fetch_assoc($resmonC)){
        $x++;
        echo "<tr";
            echo ($getmonC['ResidentID']<1)?" style=\"background: #d0edd4;\"":"";
        echo ">";
            echo" <td>$x</td>";
            echo" <td>$getmonC[BuildingID]</td>";
            echo" <td>$getmonC[RoomName]</td>";
            echo" <td>";
            echo (($getmonC['ResidentID']>0)?$getmonC['UserPNameT'].$getmonC['UserNameT']." ".$getmonC['UserSNameT']:$getmonC['NameRoomType']);
            echo" </td>";
            echo "<td>$getmonC[MonthlyPeriod]</td>";
            echo "<td>$getmonC[Yearly]</td>";
            echo "<td style=\"text-align: right;\">".(($getmonC['ResidentID']>0)?$getmonC['e_prevUnit']:"0");echo "</td>";
            echo "<td style=\"text-align: right;\">".(($getmonC['ResidentID']>0)?$getmonC['e_curUnit']:"0");echo "</td>";
            echo "<td style=\"text-align: right;\">".(($getmonC['ResidentID']>0)?$getmonC['UnitAll']:"0");echo "</td>";
            echo "<td style=\"text-align: right;\">".(($getmonC['ResidentID']>0)?$getmonC['e_price']:"0.00");echo "</td>";
            if($_SESSION['UserType']==6){
            echo" <td style=\"text-align: right;\">".(($getmonC['e_curUnit']>0)?$getmonC['e_FT']:"0.00");echo"</td>";
            echo" <td style=\"text-align: right;\">".(( $getmonC['e_curUnit']>0)?$getmonC['e_service']:"0.00");echo"</td>";
            }
            echo" <td style=\"text-align: right;\">".(($getmonC['ResidentID']>0)?$getmonC['e_VAT']:"0.00");echo"</td>";
            echo" <td align=\"right\" style=\"padding-right: 23px;\">".(($getmonC['ResidentID']>0)?$getmonC['total']:"0.00");echo"</td>";
        echo "</tr>";
    } if($x<=0){
        echo "<tr>";
            echo "<td colspan=\"15\" align=\"center\" style=\"height: 200px;background: #dfefff;\">ยังไม่อัพข้อมูลไฟล์ .CSV</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
?>