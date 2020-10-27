<?php 
include('inc/toptitle.php');
include('function/connectDB.php');
include('function/date.php');
$EVS="SELECT * FROM v_eval_score";
$getEVS=mysqli_query($condb,$EVS);
?>
<div class="container box" style="margin-top: 10px;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก
    </div>
    <h2>ประกาศรายชื่อ (ตามรอบ)</h2>
    <div class="border-content">
        <?php while($row=mysqli_fetch_assoc($getEVS)){
        $EQT=($row['eval_quarter']==1)?"1 เมษายน":(($row['eval_quarter']==2)?"1 สิงหาคม":($row['eval_quarter']==3)?"1 ธันวาคม":"");
        $time=date("H:i:s",strtotime($row['eval_Date']));
        ?>
        <div style="border-bottom: 1px solid #b3b3b3;margin: 10px 8px;">
        <input type="hidden" id="RoomType" value="0">
        <input type="hidden" id="eval_quarter" value="0">
        <input type="hidden" id="eval_year" value="0">
        <a onclick="viewScoreProcess(<?=$row['RoomType'].','.$row['eval_quarter'].','.$row['eval_year']?>);">
            <div class="row">
                <div class="col-1">
                    <div class="center">
                        <i class="icons megaphone" style="font-size: 40px;"></i>
                    </div>
                </div>
                <div class="col-7">
                    <div><b> รายชื่อผู้ผ่านเข้ารอบรอจัดสรรที่พักอาศัย รอบที่ <?=$row['eval_quarter']?> ส่งฟอร์มขอรับจัดสรรที่พักอาศัยก่อน วันที่ <?=$EQT." ".$row['eval_year']?></b></div>
                    <label for="">ปรเภทห้อง <?=$row['RoomTypeName']?> </label> <i class="icons user-circle"></i> <?=$row['UserNameT']." ".$row['UserSNameT']?>
                </div>
                <div class="col-4" align="right">
                    <div>
                        <i class="icons clock"></i> <?=$time;?>
                    </div>
                </div>
            </div>
        </a>
        </div>
        <?php } ?>
    </div>
</div>
<?php include('inc/footer.php'); ?>