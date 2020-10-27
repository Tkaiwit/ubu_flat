<?php include './inc/toptitle.php'; include './function/date.php';  $MR=1;
?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label
            style="color: #3f99e6;font-weight: 600;">การจัดการข้อมูลน้ำประปา</label>
    </div>
    <h3>การจัดการข้อมูลน้ำประปา</h3>
    <div class="row mb10">
        <div class="col-2">
            <div class="mr-ml">
                <label id="label-title">เดือน</label>
                <?=monthselect(date("m"),'monthly',100,'onchange="OrderByRevenue()"');?>
            </div>
        </div>
        <div class="col-1">
            <div class="mr-ml">
                <label id="label-title">ปี</label>
                <?php echo "<lable id=\"lableyearly\">".yearselect(date("Y"),'yearly',2019,date("Y"),100,'onchange="OrderByRevenue()"')."</lable>"?>
            </div>
        </div>
        <div class="col-3">
            <div class="mr-ml">
            <label>&nbsp;</label><br>
                <button onclick="my_revenue.click()" class="btn-add"><i class="icons upload nameicon"></i>
                    เพิ่มไฟล์ข้อมูลน้ำประปา</button>
                <input type="file" id="my_revenue" onchange="onfileselect(event)" accept=".csv">
            </div>
        </div>
        <div class="col-3">
        <div id="progress" class="w3-light-grey" ><lable>0%</lable><div style="width:0%;"></div></div>
        </div>
        <div class="col-3 right">
            <div class="mr-ml">
            <label>&nbsp;</label><br>
            <lable id="btn_Revenue">
            </lable>
                
            </div>
        </div>
    </div>
    <lable id="lablerevenue_ex">
    </lable>
</div>
<?php include './inc/footer.php'; ?>