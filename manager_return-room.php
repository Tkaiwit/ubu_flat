<?php include 'inc/toptitle.php'; require 'function/connectDB.php'; include 'function/date.php'; $RTM=1;
$sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode !=6 ORDER BY ValueE";
$resRoomType=mysqli_query($condb,$sqlRoomType);
	$sqlb = "SELECT * FROM building WHERE BuildingType!=0";
	$resultb = mysqli_query($condb,$sqlb);
	
$sqlreturn="SELECT * FROM v_return_form";
$result = mysqli_query($condb,$sqlreturn);
?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / 
        <label style="color: #3f99e6;font-weight: 600;">การจัดการคำร้องขอคืนห้อง</label>
    </div>
    <h3>การจัดการคำร้องขอคืนห้อง</h3>
    <div class="box-menu row">
        <div class="col-4">
            <div class="mr-ml">
                <label id="label-title">อาคาร</label><br>
                <lable id="lablebuilding">
                <select name="BuildingID" id="BuildingID" onchange="Orderbyreturn()">
                    <option value="0" >ทุกอาคาร</option>
                    <?php while($rowbuilding=mysqli_fetch_array($resultb)){?>
                    <option value="<?=$rowbuilding['BuildingID'];?>"><?=$rowbuilding['BuildingName'];?></option>
                    <?php } ?>
                </select>
                </lable>
            </div>
        </div>
    </div>  <br>
    <div style="min-height: 350px;"><lable id="listreturnform"></lable></div>
</div>
<?php include('inc/footer.php'); ?>