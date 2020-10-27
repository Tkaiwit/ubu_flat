<?php include '../function/connectDB.php';
$room="SELECT B.*, E.EntryCount, L.LeaveCount 
FROM v_building_activity B 
LEFT JOIN v_monthlyentry E ON B.BuildingID=E.BuildingID AND E.StartDate='$_POST[Year]-$_POST[Month]'
LEFT JOIN v_monthlyleave L ON B.BuildingID=L.BuildingID AND L.EndDate='$_POST[Year]-$_POST[Month]' ";
$getroom=mysqli_query($condb,$room);
?>
<table class="table table-sm mt10">
    <thead>
        <tr>
            <th rowspan="2" width="10%">แฟลต</th>
            <th colspan="4" width="20%" style="background: #18cdac;">ห้องครอบครัว</th>
            <th colspan="4" width="20%" style="background: #cd7418;">ห้องโสด</th>
            <th colspan="4" width="20%" style="background: #98cd18;"> เรือนรับรอง</th>
            <th rowspan="2" style="background:#13711a">ย้ายเข้า</th>
            <th rowspan="2" style="background:#b90b0b">ย้ายออก</th>
            <th colspan="4" width="20%" style="background: #189bcd;">รวม</th>
        </tr>
        <tr>
            <th width="45px" style="background: #18cdac;">ทั้งหมด</th>
            <th width="30px" style="background: #18cdac;">ว่าง</th>
            <th width="30px" style="background: #18cdac;">ชำรุด</th>
            <th width="70px" style="background: #18cdac;">มีผู้พักอาศัย</th>
            <th width="45px" style="background: #cd7418;">ทั้งหมด</th>
            <th width="30px" style="background: #cd7418;">ว่าง</th>
            <th width="30px" style="background: #cd7418;">ชำรุด</th>
            <th width="70px" style="background: #cd7418;">มีผู้พักอาศัย</th>
            <th width="45px" style="background: #98cd18;">ทั้งหมด</th>
            <th width="30px" style="background: #98cd18;">ว่าง</th>
            <th width="30px" style="background: #98cd18;">ชำรุด</th>
            <th width="70px" style="background: #98cd18;">มีผู้พักอาศัย</th>
            <th width="45px" style="background: #189bcd;">ทั้งหมด</th>
            <th width="30px" style="background: #189bcd;">ว่าง</th>
            <th width="30px" style="background: #189bcd;">ชำรุด</th>
            <th width="70px" style="background: #189bcd;">มีผู้พักอาศัย</th>
        </tr>
    </thead>
    <tbody id="myTable" name="table1">
    <?php
    $x=0; 
    $AllRoom=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    while($groom=mysqli_fetch_assoc($getroom)){$x++;
        $Allr=$groom['RT1']+$groom['RT2']+$groom['RT3'];
        $AllrE=$groom['RT1ST1']+$groom['RT2ST1']+$groom['RT3ST1'];
        $AllrR=$groom['RT1ST2']+$groom['RT2ST2']+$groom['RT3ST2'];
        $AllrRS=$groom['RT1ST3']+$groom['RT2ST3']+$groom['RT3ST3'];
        echo '<tr>';
            echo "<td align='center'>$groom[BuildingName]</td>";
            echo "<td align='center' style='background: #18cdac26;'>$groom[RT2]</td>";
            echo "<td align='center' style='background: #18cdac26;'>$groom[RT2ST1]</td>";
            echo "<td align='center' style='background: #18cdac26;'>$groom[RT2ST2]</td>";
            echo "<td align='center' style='background: #18cdac26;'>$groom[RT2ST3]</td>";
            echo "<td align='center' style='background: #cd74181a;'>$groom[RT1]</td>";
            echo "<td align='center' style='background: #cd74181a;'>$groom[RT1ST1]</td>";
            echo "<td align='center' style='background: #cd74181a;'>$groom[RT1ST2]</td>";
            echo "<td align='center' style='background: #cd74181a;'>$groom[RT1ST3]</td>";
            echo "<td align='center' style='background: #98cd1829;'>$groom[RT3]</td>";
            echo "<td align='center' style='background: #98cd1829;'>$groom[RT3ST1]</td>";
            echo "<td align='center' style='background: #98cd1829;'>$groom[RT3ST2]</td>";
            echo "<td align='center' style='background: #98cd1829;'>$groom[RT3ST3]</td>";
            echo "<td align='center' style='background: #13711a38;'>$groom[EntryCount]</td>";
            echo "<td align='center' style='background: #b90b0b36;'>$groom[LeaveCount]</td>";
            echo "<td align='center' style='background: #189bcd30;'>$Allr</td>";
            echo "<td align='center' style='background: #189bcd30;'>$AllrE</td>";
            echo "<td align='center' style='background: #189bcd30;'>$AllrR</td>";
            echo "<td align='center' style='background: #189bcd30;'>$AllrRS</td>";
            $AllRoom[0]+=$groom['RT2'];
            $AllRoom[1]+=$groom['RT2ST1'];
            $AllRoom[2]+=$groom['RT2ST2'];
            $AllRoom[3]+=$groom['RT2ST3'];
            $AllRoom[4]+=$groom['RT1'];
            $AllRoom[5]+=$groom['RT1ST1'];
            $AllRoom[6]+=$groom['RT1ST2'];
            $AllRoom[7]+=$groom['RT1ST3'];
            $AllRoom[8]+=$groom['RT3'];
            $AllRoom[9]+=$groom['RT3ST1'];
            $AllRoom[10]+=$groom['RT3ST2'];
            $AllRoom[11]+=$groom['RT3ST3'];
            $AllRoom[12]+=$groom['EntryCount'];
            $AllRoom[13]+=$groom['LeaveCount'];
            $AllRoom[14]+=$Allr;
            $AllRoom[15]+=$AllrE;
            $AllRoom[16]+=$AllrR;
            $AllRoom[17]+=$AllrRS;
        echo '</tr>';
    }
    echo '<tr>';
        echo '<td align="center"><b>รวมทั้งหมด</b></td>';
        for($i=0;$i<COUNT($AllRoom);$i++){
            echo '<td align="center" ';
            if($i<4){
                    echo "style='background: #18cdac26;'";
                }else if($i<8){
                    echo "style='background: #cd74181a;'";
                }elseif($i<12){
                    echo "style='background: #98cd1829;'";
                }elseif($i==12){
                    echo "style='background: #13711a38;'";
                }elseif($i==13){
                    echo "style='background: #b90b0b36;'";
                }else{
                    echo "style='background: #189bcd30;'";
                }
            echo'><b>'.$AllRoom[$i].'</b></td>';
            
        }
    echo '</tr>';
    if($x<1){
    ?>
        <tr>
            <td collable="20" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
