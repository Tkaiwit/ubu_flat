<?php include './inc/toptitle.php'; include './function/date.php'; include './function/connectDB.php';  $SM=1;
$sqlb = "SELECT * FROM building WHERE BuildingType!=0";
$resultb = mysqli_query($condb,$sqlb);
?>
<div class="container box" style="margin-top: 10px;height:auto;">
<div>
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label
            style="color: #3f99e6;font-weight: 600;">ค้นหาข้อมูลผู้พักอาศัย</label>
    </div>
    <div class="row mb10">
        <div align="center" class="req-edit" style="width: 35%;margin: auto;">
            <form id="ListRequest" name="ListRequest" method="POST" action="./form/search_resident.php">
                <h2 style="font-size:1.2em;" align="center">ค้นหาข้อมูลผู้พักอาศัย</h2>
                <div style="width: 90%;">
                    <lable class="f-left">ชื่อ-นามสกุล </lable>
                    <input type="text" onchange="SearchMemberResident()" name="UserNameT" id="UserNameT">
                </div>
                <div style="width: 92%;">
                    <div class="center"><lable>หรือ</lable></div>
                    <div class="row">
                        <div class="col-8">
                            <div class="mr-ml">
                                <lable class="f-left">อาคาร</lable>
                                <select name="BuildingID" id="BuildingID"
                                    onchange="SearchMemberResident()">
                                    <option value="0">ทุกอาคาร</option>
                                    <?php while ($rowb = mysqli_fetch_assoc($resultb)) { ?>
                                    <option value="<?=$rowb['BuildingID'];?>"><?=$rowb['BuildingName'];?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mr-ml">
                                <lable class="f-left">หมายเลขห้อง</lable>
                                <input type="text" onchange="SearchMemberResident()" name="RoomName" id="RoomName">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="padding:15px 0px;">
                    <lable id="ErrMsgRequest" style="color:red;padding: 5px 15px;"></lable>
                </div>
                <div style="padding:5px 0 20px 0">
                    
                </div>
        </form>
        </div>
    </div>
    <div style="min-height: 150px;"><lable id="lableSearchmembers"></lable></div>
    </div>
</div>
<?php include './inc/footer.php'; ?>