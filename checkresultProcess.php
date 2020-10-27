<?php include 'inc/toptitle.php'; include './function/connectDB.php'; include './function/date.php'; $RSCs=1;
$sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode !=4 and FieldCode !=6 and FieldCode !=5 ORDER BY ValueE";
$resRoomType=mysqli_query($condb,$sqlRoomType); 
?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> ฟอร์มคำร้อง /
        <label style="color: #3f99e6;font-weight: 600;">ตรวจสอบผลการประมาณคะแนน(ตามรอบ)</label>
    </div>
    <h2>ตรวจสอบผลการประมาณคะแนน(ตามรอบ)</h2>
    <lable id="checkscoreresult">
        <div class="row">
            <div class="col-3">
                <div class="mr-ml">
                    <label id="label-title">ประเภทห้อง</label><br>
                    <lable id="lableroomtype">
                        <select name="RoomType" id="RoomType" onchange="checkscoreresult()">
                            <option value="0" disabled selected>กรุณาเลือกประเภทห้อง</option>
                            <?php while($rowRoomType=mysqli_fetch_array($resRoomType)){?>
                            <option value="<?=$rowRoomType['FieldCode'];?>"><?=$rowRoomType['ValueT'];?></option>
                            <?php } ?>
                        </select>
                    </lable>
                </div>
            </div>
            <div class="col-4">
                <div class="mr-ml">
                    <label id="label-title">รอบการจัดสรร</label><br>
                    <lable id="lableeval_quarter">
                        <select name="eval_quarter" id="eval_quarter" onchange="checkscoreresult()">
                            <option value="0" disabled selected>กรุณาเลือกรอบการประมวลผล</option>
                            <option value="1">รอบที่หนึ่ง ระหว่างเดือนมกราคม-เมษายน</option>
                            <option value="2">รอบที่สอง ระหว่างเดือนพฤษภาคม-สิงหาคม</option>
                            <option value="3">รอบที่สาม ระหว่างเดือนกันยายน-ธันวาคม</option>
                        </select>
                    </lable>
                </div>
            </div>

            <div class="col-1">
                <div class="mr-ml">
                    <label id="label-title">ปีจัดสรร</label>
                    <?php echo "<lable id=\"lableeval_year\">".yearselect(date("Y"),'eval_year',2019,date("Y"),100,'onchange="checkscoreresult()"')."</lable>"?>
                </div>
            </div>
        </div>
    </lable><br>
    <lable id="lablecheckscoresult"></lable>
    <div>
        <b>หมายเหตุ</b><br>
        <lable style="color: #007100;">ตัวอักษรข้อมูลสีเขียว</lable>: จัดสรรแล้ว <br>
    </div>
</div>
<?php include 'inc/footer.php'; ?>
