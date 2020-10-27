<?php 
    require '../function/connectDB.php';
    $sql="SELECT max(BuildingID) as id FROM `building`";
    $result = mysqli_query($condb,$sql);
    $row = mysqli_fetch_array($result);
    $id = $row['id']+1;
?>
<form id="FormAddBuli" onsubmit="return SaveBuilding()"  method="post">
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="row top-bottom">
            <label class="namef">ชื่ออาคาร :</label>
            <input type="text" name="BulidingName">
    </div>
    <div class="row top-bottom">
        <div class="col-6">
            <div class="mr-ml">
                <label class="namef" >จำนวนห้อง :</label>
                <input type="text" name="BulidingCountR">
            </div>
            
        </div>
        <div class="col-6">
        <div class="mr-ml">
            <label class="namef" >จำนวนชั้น :</label>
            <input type="text" name=BulidingFrool>
        </div>
        </div>
    </div>
    <div class="row top-bottom mb10">
        <div class="col-6">
            <div class="mr-ml">
                <label class="namef">อัตราค่าเช่าห้อง :</label> 
            <input type="text" name="BulidingPrice">
            </div>    
        </div>
        <div class="col-6">
            <label class="namef">ค่าตอบแทนหัวหน้าอาคาร :</label>
            <div class="mr-ml" >
            <input type="text" name="BulidingPrices">
            </div>
        </div>
    </div>
    <div class="row center">
        <div class="col-12" style="margin-top: 10px;">
            <button class="btn-sm btn-sm-info" type="submit">บันทึก</button>
        </div>
    </div>
</div>
</form>