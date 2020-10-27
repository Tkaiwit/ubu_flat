<?php
include 'connectDB.php';
include 'date.php';
include 'iconshow.php';
$RoomType=$_POST['RoomType'];
$FormStatus1=$_POST['FormStatus1'];
$FormStatus2=$_POST['FormStatus2'];
$FormStatus3=$_POST['FormStatus3'];

$sqlreq = "SELECT * FROM v_request_form ";

if($RoomType+$FormStatus1+$FormStatus2+$FormStatus3>0){
    $sqlreq .= " WHERE  ";
    // where (FormStatus = 1 or FormStatus = 2 or FormStatus = 3) and RoomType =$RoomType
    // where FormStatus IN(1,2,3) and RoomType =$RoomType
    $cond="";
    if($FormStatus1>0)$cond .= " 1 ";
    if($FormStatus2>0){
        if($cond !="")$cond .= ",";
        $cond .= " 2 ";
    }
    if($FormStatus3>0){
        if($cond !="")$cond .= ",";
        $cond .= " 3 ";
    }
    if($cond!="")$sqlreq .= " FormStatus IN($cond)";
    if($RoomType>0){
        if($cond!="")$sqlreq .=" AND ";
        $sqlreq .= " RoomType =$RoomType" ;
    }
}
 $sqlreq .=" ORDER BY RequestDate DESC ";
// echo $sqlreq;
$resureq = mysqli_query($condb,$sqlreq);
$count = mysqli_num_rows($resureq); ?>
<table class="table1 table-sm">
    <thead>
        <tr>
            <th>#ที่</th>
            <th align="left">ชื่อ - นามสกุล</th>
            <th align="left">ตำแหน่ง</th>
            <th align="left">คณะ/หน่วยงาน</th>
            <th>วันที่บรรจุ</th>
            <th>วันที่กรอกฟอร์ม</th>
<?php if($RoomType==0){ ?><th align="left">ประเภทห้อง</th><?php }?>
            <th width="10%">จัดการ</th>
        </tr>
    </thead>
    <tbody id="myTable">
<?php
$x = 0;
while ($row = mysqli_fetch_array($resureq)) {$x++;
?>

    <tr class="<?=(empty($row['FormAcceptBy']))?'td-r':(($row['FormStatus']==2)?'td-y':'td-d'); ?>">
        <td align="center" class="">
            <label><?php echo $x;?></label>
        </td>
        <td align="left" >
            <?php echo $row['PName'].$row['Name']." ".$row['Surname']; ?>
        </td>
        <td align="left" >
            <?=$row['PositionName'];?>
        </td>
        <td >
            <?=$row['FacNameT'];?>
        </td>
        <td align="center" >
            <?=date2str($row['EmployDate']); ?>
        </td>
        <td align="center" >
            <?=date2str($row['RequestDate'],0); ?>
        </td>
        <?php if($RoomType==0){ ?>
        <td >
                    <?=nameRoomType($row['RoomType']);?>
        </td>
        <?php }?>
        <td align="center" >
            <?php if($row['FormAcceptBy']==NULL){ ?>
                <i class="lds-dual-ring" style="color:#FFC300;" aria-hidden="true"></i>
            </label>
            <?php } else {?>
                <i class="<?=iconFormStatus($row['FormStatus'])?>" aria-hidden="true"></i>
            <?php } ?>
            <label style="color: #a8a4a4;">|</label>
            <a href="#" onclick="FormAccept(<?=$row['RequestID'];?>)" id="FormAccept" class="tooltip acc"><i class="icons filesearch" aria-hidden="true"></i><lable class="tooltiptext">ดูข้อมูล</lable></a>

        </td>
    </tr>
    
<?php } if($x<=0){ ?>
                <tr>
                    <td colspan="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
                </tr>
            <?php } ?>
</tbody>
</table>