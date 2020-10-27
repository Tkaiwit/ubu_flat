<?php 
    require '../function/connectDB.php';
    $id=$_GET['id'];
    $sql = "SELECT * , count(`RoomID`) AS num FROM `room` ";
    $sqlb="SELECT * FROM `building` WHERE `BuildingID`=$id";
    $result=mysqli_query($condb,$sql);
    $resultb=mysqli_query($condb,$sqlb);
    $row = mysqli_fetch_array($result);
    $rowb=mysqli_fetch_array($resultb);
?>
<form id="FormAddRoom" action="buliding_room/saveAddbuliding.php" method="post">
<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>รหัสห้อง :</label>
            </div>
        </div>
        <div class="col-8">
            <input type="text" readonly name="roomid" value="<?= $row['num']+1;?>">
            <input type="hidden" name="bulidingid" value="<?php echo $_GET['id']; ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>หมายเลขห้อง :</label>
            </div>
        </div>
        <div class="col-8">
            <input type="text" name="roomanem" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>ที่อยู่ห้อง :</label>
            </div>
        </div>
        <div class="col-8">
            <input type="text" name="roomaddress" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>ชั้น :</label>
            </div>
        </div>
        <div class="col-8">
            <select id="select-option" name="roomfrool">
				<option value="0" selected>เลือกชั้น</option>
				<?php for($f=1;$f<=$rowb['FloorCount'];$f++){ ?>
				<option <?php if(!empty($row['Floor'])){ if($row['Floor']==$f){echo "selected";} } ?> value="<?=$f;?>"><?=$f;?></option>
                <?php
                }
                ?>>
			</select>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>สถานะห้องพัก :</label>
            </div>
        </div>
        <div class="col-8">
            <select id="select-option" name="roomstatus">
				<option value="0">เลือกสถานะห้องพัก</option>
				<option value="1">ว่างพร้อมใช้งาน</option>
				<option value="2">ว่างไม่พร้อมใช้งาน</option>
                <option value="3">มีผู้พักอาศัย</option>
			    <option value="4">ห้องรับรอง คณะ</option>
			</select>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>ประเภทห้องพัก :</label>
            </div>
        </div>
        <div class="col-8">
            <select id="select-option" name="roomtype">
				<option value="0">เลือกประเภทห้องพัก</option>
				<option value="1">ห้องโสด</option>
				<option value="2">ห้องครอบครัว</option>
                <option value="3">เรือนรับรอง</option>
			</select>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>อัตราค่าเช่าต่อดือน :</label>
            </div>
        </div>
        <div class="col-8">
            <input type="text" name="roomprice" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>ค่าประกันของเสียหาย :</label>
            </div>
        </div>
        <div class="col-8">
            <input type="text" name="roompay" value="">
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="namef">
                <label>หมายเหตุ :</label>
            </div>
        </div>
        <div class="col-8">
            <textarea name="" id="" class="col-12" rows="5"></textarea>
        </div>
    </div>
    <div class="row">
        <div align="center">
            <button class="btn-sm btn-sm-info" type="submit">บันทึก</button>
        </div>
    </div>
</div>
</form>