<?php session_start(); include '../function/connectDB.php';
$BID=$_POST['BuildingID']; $RS1=$_POST['RoomStatus1']; $RS2=$_POST['RoomStatus2'];$RS3=$_POST['RoomStatus3'];
$room="SELECT * FROM v_room ";
if($BID>0 || $RS1>0 || $RS2>0 ||$RS3>0){
    $room.="WHERE ";
$cond="";
    if($RS1>0)$cond .= " 1 ";
    if($RS2>0){
        if($cond !="")$cond .= ",";
        $cond .= " 2 ";
    }
    if($RS3>0){
        if($cond !="")$cond .= ",";
        $cond .= " 3 ";
    }
    if($cond!="")$room.= " RoomStatus IN($cond) ";
    if($BID>0){
        if($cond!="")$room .=" AND ";
        $room .= " BuildingID=$BID" ;
    }
}
    $room.=" ORDER BY BuildingID , Floor , RoomName";
    $getroom=mysqli_query($condb,$room);
?>
<table class="table1 table-sm">
    <thead>
        <tr>
            <th>#ลำดับ</th>
            <?=($BID==0)?"<th>อาคาร</th>":''?>
            <th>ชั้น</th>
            <th align="center">ชื่อห้อง</th>
            <th>ประเภทห้องพัก</th>
            <th>ค่าบำรุงห้อง</th>
            <th>สถานะห้องพัก</th>
            <th width="12%">จัดการ</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php 
        $x = 0;
        while ($row = mysqli_fetch_array($getroom)) { $x++;
          ?>
        <tr>
            <td align="center"><?php echo $x;?></td>
            <?=($BID==0)?"<td align=\"center\">$row[BuildingName]</td>":'';?>
            <td align="center"><?php echo $row['Floor']; ?></td>
            <td align="center"><?php echo $row['RoomName']; ?></td>
            <td align="center"><?=$row['RoomTypeName2']; ?></td>
            <td align="center"><?=$row['RoomRate']; ?></td>
            <td align="center"><?=$row['RoomStatusName']; ?></td>
            <td align="center">
                <a href="#" class=" tooltip acc" onclick="AddEquipment(<?php echo $row['RoomID'];?>)">
                <i class="icons thumb"></i><lable class="tooltiptext">ครุภัณฑ์</lable></a></a>
                <label style="color: #a8a4a4;">
                <?php if($_SESSION['UserType']==9){ ?> |</label>
                <a href="#" class=" tooltip acc editRBtn" onclick="ViewEditRoom(<?php echo $row['RoomID'];?>)"><i
                        class="icons edit" aria-hidden="true"></i><lable class="tooltiptext">แก้ไขข้อมูล</lable></a>
                <label style="color: #a8a4a4;">|</label>
                <a href="buliding_room/deleteRoom.php?rid=<?php echo $row['RoomID'];?>&&id=<?php echo $row['RoomID'];?>"
                    class="tooltip acc" onClick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่ ?');">
                    <i class="icons trash" aria-hidden="true"></i><lable class="tooltiptext">ลบข้อมูล</lable></a>
                <?php }?>
            </td>

        </tr>
        <?php  } if($x<=0){//end while loop ?>
        <tr>
            <td collable="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
        <?php } ?>
    </tbody>
</table>