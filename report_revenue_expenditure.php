<?php include 'inc/toptitle.php'; include './function/connectDB.php'; include './function/date.php'; $RePRevenue=1;
$sqlbuilding="SELECT * FROM building";
$resultb=mysqli_query($condb,$sqlbuilding);
?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label
            style="color: #3f99e6;font-weight: 600;">รายงานรายรับ/รายจ่าย(รายเดือน)</label>
    </div>
    <h3>รายงานรายรับ/รายจ่าย(รายเดือน)</h3>
    <nav>
        <div class="tabs nav-tabs">
            <?php $disp=''; if($_SESSION['UserType']==6 || $_SESSION['UserType']==10 || $_SESSION['UserType']==11){
            $disp="style=\"display:none;\"";
        }
        ?>
            <a class="nav-item nav-link active" id="tabDatRe" <?=$disp;?> onclick="tabDataRe()">ข้อมูล</a>
            <a class="nav-item nav-link " id="tabReprot" onclick="tabReprotRe()">รายงาน</a>
        </div>
    </nav>
    <div class="tab-content">
        <div class="tab-pane fade show " id="tabDataRevenue">
            <div class="row mb10">
                <div cla="2">
                    <div class="mr-ml">
                        <label>เดือน</label>
                        <?=monthselect(date("m"),'monthly',100,'onchange="tabDataRevenue()"');?>
                    </div>
                </div>
                <div cla="1">
                    <div class="mr-ml">
                        <label>ปี</label>
                        <?php echo "<lable id=\"lableyearly\">".yearselect(date("Y"),'yearly',2019,date("Y"),100,'onchange="tabDataRevenue()"')."</lable>"?>
                    </div>
                </div>
                <div class="col-2">
                    <div class="mr-ml">
                        <label>อาคาร</label>
                        <select name="BuildingID" id="BuildingID"
                            onchange="tabDataRevenue(this.options[this.selectedIndex].value)">
                            <option value="0">ทุกอาคาร</option>
                            <?php while ($rowb = mysqli_fetch_assoc($resultb)) { ?>
                            <option value="<?=$rowb['BuildingID'];?>"><?=$rowb['BuildingName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <lable id="lablereportrevenue"></lable>
        </div>
        <div class="tab-pane fade show " id="tabReprotRevenue">
        <div class="row mb10">
        <div cla="2">
            <div class="mr-ml">
                <label>เดือน</label>
                <?=monthselect(date("m"),'monthlyr',100,'onchange="ExpendRevenue()"');?>
            </div>
        </div>
        <div cla="1">
            <div class="mr-ml">
                <label>ปี</label>
                <?php echo "<lable id=\"lableyearly\">".yearselect(date("Y"),'yearlyr',2019,date("Y"),100,'onchange="ExpendRevenue()"')."</lable>"?>
            </div>
        </div>
    </div>
            <lable id="ShowReprotRevenue">
                
            </lable>
        </div>
    </div>

</div>
<?php include 'inc/footer.php'; ?>