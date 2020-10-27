<?php require '../function/connectDB.php';

	$BuliID = $_GET['BuliID'];
	$sql="SELECT *FROM building WHERE BuildingID = $BuliID ";
	$getBuliding = mysqli_fetch_assoc(mysqli_query($condb, $sql));

?>
<form id="bulidingForm" class="formbox-w">

    <input type="hidden" name="BuID" id="BuID" value="<?=$getBuliding['BuildingID']?>">
    <div class="container box">
        <div class="row top-bottom">
            <label class="namef">ชื่ออาคาร :</label>
            <input type="text" name="BuildingName" value="<?=$getBuliding['BuildingName']?>">
        </div>
        <div class="row top-bottom">
            <div class="col-6">
                <div class="mr-ml">
                    <label class="namef">จำนวนห้อง :</label>
                    <input type="text" name="RoomCount" value="<?=$getBuliding['RoomCount']?>">
                </div>

            </div>
            <div class="col-6">
                <div class="mr-ml">
                    <label class="namef">จำนวนชั้น :</label>
                    <input type="text" name="FloorCount" value="<?=$getBuliding['FloorCount']?>">
                </div>
            </div>
        </div>
        <div class="row top-bottom mb10">
            <div class="col-6">
                <div class="mr-ml">
                    <label class="namef">อัตราค่าเช่าห้อง :</label>
                    <input type="text" name="CompensationRate" value="<?=$getBuliding['CompensationRate']?>">
                </div>
            </div>
            <div class="col-6">
                <label class="namef">ค่าตอบแทนหัวหน้าอาคาร :</label>
                <div class="mr-ml">
                    <input type="text" name="CommitteeRate" value="<?=$getBuliding['CommitteeRate']?>">
                </div>
            </div>
        </div>
    </div>
</form>