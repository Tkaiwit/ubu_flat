<?php include 'inc/toptitle.php'; include 'function/connectDB.php'; include 'function/date.php'; $BR=1;
$sqlbuilding = "SELECT * FROM building ";
$resultb = mysqli_query($condb,$sqlbuilding);
 ?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label
            style="color: #3f99e6;font-weight: 600;">การจัดการอาคาร/ห้อง</label>
    </div>
    <h3>จัดการอาคาร/ห้อง</h3>
    <nav>
        <div class="tabs nav-tabs">
            <a class="nav-item nav-link active" id="tabBuilding" onclick="ShowDataBuilding()">ข้อมูลอาคาร</a>
            <a class="nav-item nav-link " id="tabRoom" onclick="ShowDataRoom()">ข้อมูลห้องพัก</a>
        </div>
    </nav>
    <div class="tab-content">
        <div class="tab-pane fade show " id="ShowDataBuilding">
            <div class="mb10">
                <?php if($_SESSION['UserType']==9){?>
                <button class="btn-add addBuliding"><i class="icon plus nameicon"></i>เพิ่มอาคาร</button>
                <?php } ?>
            </div>
            <lable id="lableBuilding">
            </lable>
        </div>
        <div class="tab-pane fade" id="ShowDataRoom" style="display:none;">
            <div class="row mb10">
                <div class="col-3">
                    <label id="label-title">อาคาร</label>
                    <select name="building" id="building"
                        onchange="OrderByBuilding(this.options[this.selectedIndex].value)">
                        <option value="0" >ทุกอาคาร</option>
                        <?php while ($rowb = mysqli_fetch_array($resultb)) { ?>
                        <option value="<?=$rowb['BuildingID'];?>"><?=$rowb['BuildingName'];?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-5" style="margin-top: 36px;">
                    <input type="checkbox" onclick="OrderByBuilding()" name="RoomStatus1" id="RoomStatus1">
                    <label class="namecheckbox">ว่าง พร้อมใช้งาน</label>
                    <input type="checkbox" onclick="OrderByBuilding()" name="RoomStatus2" id="RoomStatus2">
                    <label class="namecheckbox">ว่าง ไม่พร้อมใช้งาน</label>
                    <input type="checkbox" onclick="OrderByBuilding()" name="RoomStatus3" id="RoomStatus3">
                    <label class="namecheckbox">มีผู้พักอาศัย</label>
                </div>
            </div>
            <lable id="lableRoom">
            </lable>
        </div>
    </div>

</div>
<?php include 'inc/footer.php'; ?>