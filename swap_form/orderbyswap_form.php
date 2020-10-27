<?php session_start(); include '../function/connectDB.php'; include '../function/date.php';
$BuildingID=$_POST['BuildingID'];
$z_swaproom="SELECT * FROM `v_z_swaproom` ";
($BuildingID>0)?$z_swaproom.="WHERE BuildingID=$BuildingID ":" ";
$z_swaproom.="ORDER BY AcceptBy";
$getz_swaproom=mysqli_query($condb,$z_swaproom);
?>
<table class="table1 table-sm">
    <thead>
            <tr>
                <th align="left" width="8%">#ที่</th>
                <th align="left">ชื่อ - นามสกุล</th>
                <th align="left" width="15%">อาคาร</th>
                <th align="left" width="15%">หมายเลขห้อง</th>
                <th align="left" width="15%">วันที่ส่งเอกสาร</th>
                <th align="left">อนุมัติ</th>
                <th align="left">วันที่อนุมัติ</th>
                <th width="9%" align="center">จัดการ</th>
            </tr>
    </thead>
    <tbody id="myTable">
        <?php $i=0; while ($row = mysqli_fetch_assoc($getz_swaproom)) { $i++;
            echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$row[UserPNameT]$row[UserNameT] $row[UserSNameT]</td>";
                echo "<td>$row[BuildingName]</td>";
                echo "<td>$row[RoomName]</td>";
                echo "<td>".date2str($row['CreateDate'])."</td>";
                echo "<td>";echo($row['AcceptBy']>0)?"อนุมัติฟอร์มแล้ว":"";echo"</td>";
                echo "<td>";echo($row['AcceptBy']>0)?date2str($row['AcceptDate']):""; echo"</td>";

                echo"<td align=\"center\">"; ?>
                    <a onclick="viewSwapform(<?=$row['SwapID'];?>)" class="tooltip acc"><i class="icons filesearch"></i><lable class="tooltiptext">ดูเอกสาร</lable></a>
                    <?php if($row['AcceptBy']!=1){ ?>
                    <label style="color: #a8a4a4;">|</label>
                    <a onclick="acceptform(<?=$row['SwapID']?>)" class="tooltip acc"><i class="icons filecheck"></i><lable class="tooltiptext">อนุมัติฟอร์ม</lable></a>
                    <?php } ?>
              <?php echo"</td>";
            echo "</tr>";
        } if($i<=0){ ?>
        <tr>
            <td colspan="9" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
        <?php } ?>
    </tbody>
</table>