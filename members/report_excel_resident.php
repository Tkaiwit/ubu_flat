<?php require '../function/connectDB.php';
$name="Resident_".date("M").'_'.date("Y");
 $monthly=$_GET['monthly']; $yearly=$_GET['yearly'];
$StartDate=date("$yearly-$monthly-1");
// $monthly=6;$yearly=2020;
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$name.xls");
// $resident="SELECT * FROM v_resident WHERE StartDate<='$StartDate' and EndDate IS NULL ORDER BY BuildingID";

$resident="SELECT RS.ResidentID, R.BuildingID, R.RoomName, RS.UserPNameT, RS.UserNameT, RS.UserSNameT, R.RoomID, R.RoomStatusName FROM v_resident RS RIGHT JOIN v_room R ON R.RoomID=RS.RoomID ORDER BY R.BuildingID,R.RoomName";

//ดึงหน่วยค่าไฟย้อนหลัง $m=((date("m")==12)?"1":date("m",strtotime("-1 month",)));
// $resident="SELECT RS.ResidentID, R.BuildingID, R.RoomName, RS.UserPNameT, RS.UserNameT, RS.UserSNameT, R.RoomID, R.RoomStatusName,MC.MonthlyPeriod ,MC.Yearly ,MC.e_curUnit
// FROM v_resident RS 
// 	RIGHT JOIN v_room R ON R.RoomID=RS.RoomID
// 	RIGHT JOIN monthlycharge MC ON R.RoomID=MC.RoomID
//     WHERE MC.MonthlyPeriod=$m AND MC.Yearly=$yearly";

$getresident=mysqli_query($condb,$resident);
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <table>
    <tr>
            <th width="3%" align="center"># ที่</th>
            <th align="left">อาคาร</th>
            <th align="left">หมายเลข</th>
            <th align="left">ชื่อ-นามสกุล</th>
            <!-- <th align="center">ประเภทห้อง</th> -->
            <th align="center">เดือน</th>
            <th align="center">ปี</th>
            <th align='left'>หน่วยเดือนก่อน</th>
            <th align='left'>หน่วยเดือนนี้</th>
            <th align='left'>จำนวนหน่วย</th>
            <th align='left'>คิดเป็นเงิน</th>
            <th align="left">ค่า FT</th>  
            <th align='left'>ค่าบริการ</th>
            <th align='left'>ค่า VAT</th>
            <th align='left'>รวมทั้งสิ้น</th>
        <th align='left'>วันที่จดรายการ</th>
        </tr>
        <?php $x=0; while($row=mysqli_fetch_assoc($getresident)){$x++;
                    echo "<tr>";
                        echo "<td align=\"center\">$x</td>";
                        echo "<td>$row[BuildingID]</td>";
                        echo "<td>$row[RoomName]</td>";
                        echo "<td>";
                        if($row['ResidentID']>0){
                            echo $row['UserPNameT'].$row['UserNameT']." ".$row['UserSNameT'];
                        }else{
                            echo $row['RoomStatusName'];
                        }
                        echo "</td>";
                        // echo "<td align=\"center\">$row[RoomTypeName2]</td>";
                        echo "<td align=\"center\">".date('m')."</td>";
                        echo "<td>".date('Y')."</td>";
                    echo "</tr>";
                } if($x<=0){ ?>
        <tr>
            <td collable="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
        <?php }?>
    </table>
</body>

</html>