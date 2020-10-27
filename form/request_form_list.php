<?php 
// include 'inc/toptitle.php'; 
include '../function/date.php';
include '../function/connectDB.php';
$SocialID=$_POST['SocialID'];
$BirthDate=$_POST['bi_y'].'-'.$_POST['bi_m'].'-'.$_POST['bi_d'];

$sqllistSocialID="SELECT RequestID,RoomType,RequestDate,FormAcceptBy,FormAcceptDate,StaffID FROM request_form WHERE StaffID IN ";
$sqllistSocialID .=" (SELECT StaffID FROM staff WHERE SocialID ='$SocialID' AND BirthDate='$BirthDate' ORDER BY RequestDate ASC)";
$rssqllistSocialID=mysqli_query($condb,$sqllistSocialID);
$count = mysqli_num_rows($rssqllistSocialID);
if($count<=0){
    echo "<div style=\"color:red;text-align:center;\">ไม่พบข้อมูล</div>"; 
    exit;
}
?>
<div>
    <h3>รายการคำร้องของจัดสรรที่พักอาศัย ทั้งหมด</h3>
    <div align="center" class="req-edit" style="width: 100%;margin: auto;">
    <table class="table1 table-sm">
        <thead>
            <tr>
                <th>#ลำดับ</th>
                <th align="left">ประเภทห้อง</th>
                
                <th>วันที่กรอกฟอร์ม</th>
                <th>ตรวจสอบ</th>
                <th>วันที่รับฟอร์ม</th>
                <th width="12%">จัดการ</th>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php 
        for ($x = 1; $x <= $count; $x++) {
        while ($row = mysqli_fetch_array($rssqllistSocialID)) {
          $RequestDate =  $row['RequestDate'];
        ?>
            <tr>
                <td align="center" class="<?= (empty($row['FormAcceptBy']))?'td-r':'td-y'; ?>">
                    <?php echo $x++;?>
                </td>
                <td align="left" class="<?= (empty($row['FormAcceptBy']))?'td-r':'td-y'; ?>">
                    <?php if($row['RoomType'] ==1){ echo "ห้องโสด แฟลต 1-4";}
                        else if($row['RoomType'] ==2){echo "ห้องครอบครัว แฟลต 2-4";}
                        else if($row['RoomType'] ==3){echo "ห้องครอบครัว แฟลต 5";}
                        else if($row['RoomType'] ==4){echo "ห้องโสด แฟลต 6";}
                        else if($row['RoomType'] ==5){echo "ห้องครอบครัว แฟลต 6";}   ?>
                </td>
                <td align="center" class="<?= (empty($row['FormAcceptBy']))?'td-r':'td-y'; ?>">
                    <?php echo date2str($RequestDate); ?>
                </td>
                <td align="center" class="<?= (empty($row['FormAcceptBy']))?'td-r':'td-y'; ?>">
                    <?php echo (empty($row['FormAcceptBy']))? "ยังไม่ตรวจสอบ":"ตรวจสอบแล้ว"; ?>
                </td>
                <td align="center" class="<?= (empty($row['FormAcceptBy']))?'td-r':'td-y'; ?>">
                    <?php if($row['FormAcceptBy']!=''){echo date2str($row['FormAcceptDate']);} ?>
                </td>
                <td align="center" class="<?= (empty($row['FormAcceptBy']))?'td-r':'td-y'; ?>">
                <?php if((empty($row['FormAcceptBy']))){ ?>
                    <a href="request_form_editdata.php?RequestID=<?=$row['RequestID']?>" class="tooltip"><i class="icons edit" aria-hidden="true"></i><lable class="tooltiptext">แก้ไขฟอร์ม</lable></a>
                <?php }?>
                </td>
            </tr>
        <?php } } ?>
        </tbody>
    </table>
    </div>
</div>