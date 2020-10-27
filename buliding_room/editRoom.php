<?php require '../function/connectDB.php';
    $room="SELECT * FROM v_room WHERE RoomID=$_POST[RoomID]";
    $getroom=mysqli_fetch_assoc(mysqli_query($condb,$room));
    $Building="SELECT * FROM building where BuildingID=$getroom[BuildingID]";
    $getBuilding=mysqli_fetch_assoc(mysqli_query($condb,$Building));
?>
<script type="javascript/text"></script>
<form id="FormeditRoom" method="post">
    <div class="container">
        <div class="row mt10">
            <div class="col-6">
                <div class="mr-ml">
                    <label>หมายเลขห้อง :</label>
                    <input type="hidden" id="BuildingID" value="<?=$getroom['BuildingID'];?>">
                    <input type="text" name="roomnaem" value="<?=$getroom['RoomName'];?>">
                    <input type="hidden" name="roomid" value="<?=$_POST['RoomID'];?>">
                </div>
            </div>
            <div class="col-6">
                <div class="mr-ml">
                    <label>ที่อยู่ห้อง :</label>
                    <input type="text" name="roomaddress" value="<?=$getroom['RoomAddress'];?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mr-ml">
                    <label>ชั้น :</label>
                    <select id="select-option" name="roomfloor">
                        <option value="0" selected disabled>เลือกชั้น</option>
                        <?php for($f=1;$f<=$getBuilding['FloorCount'];$f++){ ?>
                        <option <?php if($getroom['Floor']==$f){echo "selected";} ?> value="<?=$f;?>"> <?=$f;?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mr-ml">
                    <label>สถานะห้องพัก :</label>
                    <select id="select-option" name="roomstatus">
                        <option <?php if($getroom['RoomStatus']==0){echo "selected";} ?> value="0">เลือกสถานะห้องพัก
                        </option>
                        <option <?php if($getroom['RoomStatus']==1){echo "selected";} ?> value="1">ว่างพร้อมใช้งาน</option>
                        <option <?php if($getroom['RoomStatus']==2){echo "selected";} ?> value="2">ว่างไม่พร้อมใช้งาน
                        </option>
                        <option <?php if($getroom['RoomStatus']==3){echo "selected";} ?> value="3">มีผู้พักอาศัย</option>
                        <option <?php if($getroom['RoomStatus']==4){echo "selected";} ?> value="4">ห้องรับรอง คณะ</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mr-ml">
                    <label>ประเภทห้องพัก :</label>
                    <select id="select-option" name="roomtype">
                        <?php ?>
                        <option <?php if($getroom['RoomType']==0){echo "selected";} ?> value="0">เลือกประเภทห้องพัก</option>
                        <option <?php if($getroom['RoomType']==1){echo "selected";} ?> value="1">ห้องโสด</option>
                        <option <?php if($getroom['RoomType']==2){echo "selected";} ?> value="2">ห้องครอบครัว</option>
                        <option <?php if($getroom['RoomType']==3){echo "selected";} ?> value="3">เรือนรับรอง</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mr-ml">
                    <label>อัตราค่าเช่าต่อดือน :</label>
                    <input type="text" name="roomprice" value="<?=$getroom['RoomRate'];?>">
                </div>
            </div>
            <div class="col-6">
                <div class="mr-ml">
                    <label>ค่าประกันของเสียหาย :</label>
                    <input type="text" name="roompay" value="<?=$getroom['InsurantRate'];?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <label>หมายเหตุ :</label>
                <textarea name="Notics" id="" class="col-12" rows="3"><?=$getroom['Notics'];?></textarea>
            </div>
        </div>
        <div class="center">
            <button onclick="return SaveRoom()" class="btn-add"><i class="icons save nameicon"></i>บันทึก</button>
            <!-- <input type="button" onclick="SaveRoom()" class="btn-sm btn-sm-info" value="บันทึก"> -->
        </div>
    </div>
</form>
