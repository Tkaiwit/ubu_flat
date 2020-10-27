<?php include 'inc/toptitle.php'; require 'function/connectDB.php'; include 'function/date.php';
$sqlbuilding="SELECT * FROM building WHERE BuildingType !=0";
$resultb=mysqli_query($condb,$sqlbuilding);
$sqlexpensetype="SELECT * FROM expensetype";
$resexpensetype=mysqli_query($condb,$sqlexpensetype);
?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label
            style="color: #3f99e6;font-weight: 600;">การจัดรายการจ่าย</label>
    </div>
    <h3>การจัดรายการจ่าย</h3>
    <div class="row">
        <div class="col-6">
            <label id="label-title">ค่าตอบแทนคณะกรรมการสวัสดิการที่พักอาศัยและลูกจ้าง (ต่อเดือน)</label>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <div class="mr-ml">
                <select name="BuildingID" id="BuildingID" onchange="Orderbyexpenditure(this.options[this.selectedIndex].value,document.getElementById('ExpTypeID').value)">
                    <option value="0" >ไม่ระบุอาคาร</option>
                    <?php while ($rowb = mysqli_fetch_array($resultb)) { ?>
                    <option value="<?=$rowb['BuildingID'];?>"><?=$rowb['BuildingName'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-3">
            <div class="mr-ml">
                <select name="ExpTypeID" id="ExpTypeID" onchange="Orderbyexpenditure(document.getElementById('BuildingID').value,this.options[this.selectedIndex].value)">
                    <option value="0" disabled selected>เลือกประเภทรายจ่าย</option>
                    <?php while ($rowE = mysqli_fetch_array($resexpensetype)) { ?>
                    <option value="<?=$rowE['ExpTypeID'];?>"><?=$rowE['ExpenseName'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-7">
            <div class="mr-ml">
                <button onclick="addExpenditure(0,1)" class="btn-add"><i class="icons plus nameicon"></i>เพิ่มรายจ่าย</button>
            </div>
        </div>
    </div><br>
    <lable id="lableexpenditure">
        <form method="post">
            <table class="table1 table-sm">
                <thead>
                    <tr>
                        <th>ที่</th>
                        <th>จ่ายวันที่</th>
                        <th>จ่ายอนุกรรมการ</th>
                        <th>จำนวนเงินที่จ่าย</th>
                        <th>จ่ายเงินโดย</th>
                        <th rowspan="2" width="10%">จัดการ</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <tr>
                        <td colspan="6" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
                    </tr>
                </tbody>
            </table>
        </form>
    </lable>
</div>
<?php include('inc/footer.php'); ?>