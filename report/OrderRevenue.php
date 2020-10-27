<?php include '../function/connectDB.php'; 
$monthly=$_POST['monthly'];
$yearly=$_POST['yearly'];
$BuildingID=$_POST['BuildingID'];
$monthlycharge="SELECT * FROM v_monthlycharge WHERE MonthlyPeriod=$monthly AND Yearly=$yearly ";
if($BuildingID>0){
    $monthlycharge.="AND BuildingID=$BuildingID ";
}
$monthlycharge.=" Order BY BuildingID,RoomName";
$resmonC=mysqli_query($condb,$monthlycharge);
?>
<table class="table1 table-sm">
    <thead>
        <tr>
            <th width="9%" align="center"># ที่</th>
            <th align="left">อาคาร</th>
            <th align="left">ชื่อห้อง</th>
            <th align="left">ชื่อ-นามสกุล</th>
            <th align="left">ค่าบำรุงห้อง</th>
            <th align="left">ค่าไฟฟ้า</th>
            <th align="left">ค่าน้ำประปา</th>
            <th align="left">รวมค่าใช้จ่าย</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php $x=0;
            while($getmonC=mysqli_fetch_assoc($resmonC)){
                $x++;
                    echo "<tr>";
                        echo "<td align=\"center\">$x</td>";
                        echo" <td>$getmonC[BuildingName]</td>";
                        echo" <td>$getmonC[RoomName]</td>";
                        echo" <td>$getmonC[UserPNameT]$getmonC[UserNameT] $getmonC[UserSNameT]</td>";
                        echo "<td>".number_format($getmonC['RoomRate'],2)."</td>";
                        echo" <td>$getmonC[AmountElec]</td>";
                        echo" <td>$getmonC[AmountWater]</td>";
                        echo" <td>$getmonC[AmountTotal]</td>";
                    echo "</tr>";
            } if($x<=0){ ?>
        <tr>
            <td collable="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
        <?php }?>
    </tbody>
</table>