<?php 
$ediformRq=1;
include('inc/toptitle.php'); 
include('function/date.php'); 
?>

<div class="container box" style="margin-top: 10px;min-height: 779px;">
    <div class="border-box">
        <i class="icon homes"></i> ฟอร์มคำร้อง / 
        <label style="color: #3f99e6;font-weight: 600;">แก้ไขฟอร์มคำร้อง / รายการฟอร์มคำร้อง</label>
    </div>
    
    <div align="center" class="req-edit" style="width: 35%;margin: auto;">
        <form id="ListRequest" name="ListRequest" method="POST" action="./request_form_list.php"> <!--  action="./request_form_list.php" -->
            <h2 style="font-size:1.2em;" align="center">แก้ไขคำร้องขอเข้าพัก</h2>
            <div style="width: 90%;">
                <lable class="f-left">เลขบัตรประจำตัวประชาชน *</lable>
                <input type="text" name="SocialID" id="SocialID">
            </div>
            <div style="width: 92%;">
                <lable class="f-left">&nbsp;วันเกิด *</lable><br>
                <div class="row">
                    <div class="col-3">
                <?php echo dateselect(0,'bi_d',100); ?>
                    </div>
                    <div class="col-6">
                    <?php echo monthselect(0,'bi_m',90,''); ?>
                    </div>
                    <div class="col-3">
                    <?php echo yearselect(0,'bi_y',date("Y",strtotime('-60 year')),date("Y",strtotime('-18 year')),100,''); ?>
                    </div>
                </div>
            </div>
            <div style="padding:15px 0px;">
                <lable id="ErrMsgRequest" style="color:red;padding: 5px 15px;"></lable>
            </div>
            <div style="padding:5px 0 20px 0">
                <button type="submit" class="btn-sm btn-sm-green">แก้ไขคำร้อง</button>
            </div>
        </form>
    </div>
    <div id="showlistRequestForm">

    </div>
</div>
<?php include('inc/footer.php');?>