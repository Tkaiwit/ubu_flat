<?php include "inc/toptitle.php"; $Y=date("Y"); include './function/connectDB.php'; include './function/date.php'; include './function/iconshow.php'; $MPSF=1;
$sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode !=4 and FieldCode !=6 and FieldCode !=5 ORDER BY ValueE";
$resRoomType=mysqli_query($condb,$sqlRoomType); 
?>
<div class="container box" style="margin-top: 10px">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / 
        <label style="color: #3f99e6;font-weight: 600;">ประมวลผลข้อมูลคำร้อง(ตามรอบ)</label>
    </div>
    <h2>ประมวลผลข้อมูลคำร้อง(ตามรอบ)</h2>
    <div class="row">
        <div class="col-3">
            <div class="mr-ml">
                <label id="label-title">ประเภทห้อง</label><br>
                <select name="RoomType" id="RoomType" onchange="odbprocessform()">
                <option value="0" disabled selected>กรุณาเลือกประเภทห้อง</option>
                    <?php while($rowRoomType=mysqli_fetch_array($resRoomType)){?>
                    <option value="<?=$rowRoomType['FieldCode'];?>"><?=$rowRoomType['ValueT'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="mr-ml">
                <label id="label-title">รอบการจัดสรร</label><br>
                <select name="eval_quarter" id="eval_quarter" onchange="odbprocessform()">
                    <option value="0" disabled selected>กรุณาเลือกรอบการประมวลผล</option>
                    <option value="1">รอบที่หนึ่งระหว่างเดือนมกราคม-เมษายน</option>
                    <option value="2">รอบที่สองระหว่างเดือนพฤษภาคม-สิงหาคม</option>
                    <option value="3">รอบที่สามระหว่างเดือนกันยายน-ธันวาคม</option>
                </select>
            </div>
        </div>

        <div class="col-1">
            <div class="mr-ml">
                <label id="label-title">ปีจัดสรร</label>
                <?php echo yearselect(date("Y"),'eval_year',2019,date("Y"),100,'onchange="odbprocessform()"')?>
            </div>
        </div>
        <div class="col-4 right" style="margin-top: 20px">
            <lable id="showbtnprocess">
            </lable>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-2">
            <div class="mr-ml">
                <label id="label-title">หรือ ส่งฟอร์มก่อนวันที่ </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-1">
            <div class="mr-ml">
                <?php echo  "<lable id=\"day\">".dateselect(0,'day_process',100)."</lable>"?>
            </div>
        </div>
        <div class="col-2">
            <div class="mr-ml">
                <?php echo "<lable id=\"month\">".monthselect(0,'month_process',100,'')."</lable>"?>
            </div>
        </div>
        <div class="col-6 right">
            <lable id="lablerecommend"></lable>
        </div>
    </div>
    <br>
    <lable id="lreprocess"></lable>
    <div>
        <b>หมายเหตุ</b><br>
        1 : สายงาน (วิชาการ/สนับสนุน) <br>
        2 : ที่อยู่ตามทะเบียนบ้าน <br>
        3 : ประสบภัยธรรมชาติ <br>
        4.1 : สถานภาพ (การสมรส) <br>
        4.2 : บุตร/ธิดา<br>
        5 : อายุราชการ<br>
    </div>
</div>
<?php include "inc/footer.php";?>