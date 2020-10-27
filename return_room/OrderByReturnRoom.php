<?php include '../function/connectDB.php'; include '../function/date.php';
$BuildingID=$_POST['BuildingID'];
$sqlreturn="SELECT * FROM v_return_form";
if($BuildingID>0){
    $sqlreturn.=" WHERE BuildingID=$BuildingID";
}
$sqlreturn.=" Order BY AcceptPayment";
$result = mysqli_query($condb,$sqlreturn);
?>
<table class="table1 table-sm">
        <thead>
            <tr>
                <th width="8%">#ที่</th>
                <th align=left>ชื่อ - นามสกุล</th>
                <th>อาคาร</th>
                <th width="15%">หมายเลขห้อง</th>
                <th>ประเภทห้อง</th>
                <th>วันที่ส่งเอกสาร</th>
                <th>การชำระเงิน</th>
                <th width="9%">ค่าความเสียหาย</th>
                <th width="9%" align=center>จัดการ</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php  $x = 0; while($row=mysqli_fetch_assoc($result)){ $x++;
                $dt=date("Y-m-d",strtotime($row['CreateDate']));    
            ?>
            <tr <?php if($row['AcceptPayment']>0){echo 'style="color: #08792b;"';}?>>
                <td align=center><?=$x?></td>
                <td><?php echo $row['UserPNameT']." ".$row['UserNameT']." ".$row['UserSNameT'];?></td>
                <td align=center><?=$row['BuildingName'];?></td>
                <td align=center><?=$row['RoomName'];?></td>
                <td align=center><?=$row['NameRoomType'];?></td>
                <td align=center><?php echo date2str($dt);?></td>
                <td align=center>
                    <label id="statusAP"><?php if($row['AcceptPayment']>0){ echo "ชำระเงินแล้ว";}else{  echo "ยังไม่ชำระเงิน"; ?></label><?php }?>
                </td>
                <td align="right"><?=$row['EvalExpense'];?></td>
                <td align=center>
                    <?php if($_SESSION['UserType']==9){?>
                    <a onclick="return ViewCheckRoom(<?=$row['ReturnID'];?>,1)" class="tooltip acc"><i class="icons filewrite"></i><lable class="tooltiptext">บันทึกการตรวจ</lable></a>
                    <label style="color: #a8a4a4;">|</label>
                    <?php }else{ ?>
                    <a onclick="return ViewCheckRoom(<?=$row['ReturnID'];?>,0)"><i class="icons filesearch"></i></a> -->
                     <label style="color: #a8a4a4;">|</label>
                   <?php }?>
                    <a onclick="return approvedFormReturn(<?=$row['ResidentID'];?>)" class="tooltip acc"><i class="icons filecheck"></i><lable class="tooltiptext">อนุมัติฟอร์ม</lable></a>
                    <!-- <label style="color: #a8a4a4;">|</label>
                    <a onclick="return ViewCheckRoom(<?=$row['ReturnID'];?>)"><i class="icons filesearch"></i></a> -->
                </td>
            </tr>
            <?php } if($x<=0){ ?>
                <tr>
                    <td colspan="9" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>