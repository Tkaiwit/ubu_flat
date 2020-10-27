<?php include '../function/connectDB.php'; include '../function/date.php';
$ReqID=$_POST['RequestID'];
$query="SELECT PName, Name, Surname, EmployDate, PositionName, FacNameT, RequestDate, AllocatedDate, RoomName, BuildingName FROM v_eval_form WHERE RequestID=$ReqID";
$getdata=mysqli_fetch_assoc(mysqli_query($condb,$query));
?>
<div class="container" style="background: #f2f2f2;">
    <div class="row" style="margin: 25px;">
            <div class="col-12 center">
                <div class="img">
                    <img src="./assets/img/No_Image_Available.jpg">
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-6">
            <label for=""><b>ชื่อ-นามสกุล : </b><?=$getdata['PName'].$getdata['Name']." ".$getdata['Surname']?></label>
        </div>
        <div class="col-6">
            <label for=""><b>วันที่บรรจุ : </b><?=date2str($getdata['EmployDate'])?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for=""><b>ตำแหน่ง : </b><?=$getdata['PositionName']?></label>
        </div>
        <div class="col-6">
            <label for=""><b>สังกัด : </b><?=$getdata['FacNameT']?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for=""><b>วันที่ส่งฟอร์ม : </b> <?=date2str($getdata['RequestDate'])?></label>
        </div>
        <div class="col-6">
            <label for=""><b>วันที่จัดสรร : </b> <?=date2str($getdata['AllocatedDate'])?></label>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <label for=""><b>อาคาร : </b> <?=$getdata['BuildingName']?></label>
        </div>
        <div class="col-6">
            <label for=""><b>ห้อง : </b><?=$getdata['RoomName']?></label>
        </div>
    </div>
</div>