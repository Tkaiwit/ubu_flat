<?php session_start(); include '../function/connectDB.php';
$sqlbuilding = "SELECT * FROM building ";
$resb = mysqli_query($condb,$sqlbuilding);
?>
<table class="table1 table-sm">
    <thead>
        <tr>
            <th align="center">#ลำดับ</th>
            <th align="center">ชื่ออาคาร</th>
            <th align="center">จำนวนชั้น</th>
            <th align="center">จำนวนห้อง</th>
            <th align="center">ค่าตอบแทนกรรมการแฟลต</th>
            <?php if($_SESSION['UserType']==9){ ?>
            <th width="12%">จัดการ</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody id="myTables">
        <?php  $x=0;
            while ($rowb = mysqli_fetch_array($resb)) { $x++; ?>
        <tr>
            <td align="center"><?=$x; ?></td>
            <td id="bname<?=$rowb['BuildingID']; ?>" align="center"><?=$rowb['BuildingName']; ?>
            </td>
            <td id="fc<?=$rowb['BuildingID']; ?>" align="center"><?=$rowb['FloorCount']; ?></td>
            <td align="center"><?=$rowb['RoomCount'];?></td>
            <td align="center"><?= number_format($rowb['CommitteeRate'],2); ?></td>
            <?php if($_SESSION['UserType']==9){ ?>
            <td align="center">
                <a href="#" class="tooltip acc" onclick="Editbuliding(<?=$rowb['BuildingID'];?>)">
                <i class="icons edit"  ></i><lable class="tooltiptext">แก้ไขข้อมูล</lable></a>
                <label style="color: #a8a4a4;">|</label>
                <a href="buliding_room/deleteBuliding.php?id=<?= $rowb['BuildingID'];?>" class="tooltip acc"
                    onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');"><i class="icons trash"
                        aria-hidden="true"></i><lable class="tooltiptext">ลบข้อมูล</lable></a>
            </td>
            <?php } ?>
        </tr>
        <?php } ?>
    </tbody>
</table>