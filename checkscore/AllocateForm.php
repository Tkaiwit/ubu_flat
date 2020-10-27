<?php include '../function/connectDB.php';  include '../function/date.php';
$RequestID=$_POST['RequestID']; $StaffID=$_POST['StaffID']; $Status=$_POST['Status'];
$sqlvrequest_form="SELECT * FROM v_request_form WHERE RequestID=$RequestID ";
$resvrequest=mysqli_fetch_assoc(mysqli_query($condb,$sqlvrequest_form));

if($Status!=1){
    $sqlroom="SELECT * FROM v_room WHERE BuildingID=$resvrequest[BuildingID] and RoomType=$resvrequest[RoomType] ORDER BY RoomStatus, RoomName";
    $resroom=mysqli_query($condb,$sqlroom);

    $sqlrate="SELECT RoomID, RoomName, RoomStatus, RoomStatusName,RoomRate FROM v_room WHERE BuildingID=$resvrequest[BuildingID] and RoomID=$resvrequest[RoomID]";
    $rate=mysqli_fetch_assoc(mysqli_query($condb, $sqlrate));
    $RoomRate=$rate['RoomRate']; $price=$RoomRate+1500+200;
}else{
    $price=1500+200;
}
$LivingCount=($resvrequest["MaritalStatus"]==2 || $resvrequest['MaritalStatus']==4)? 2: 1;
$LivingCount=$LivingCount+$resvrequest['ChildrenCount'];

$sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE,comment FROM allvars WHERE FieldName = 'RoomType' 
 and FieldCode ='$resvrequest[RoomType]' ";
$resRoomType=mysqli_fetch_assoc(mysqli_query($condb,$sqlRoomType)); 


$sqlbuilding="SELECT * FROM building  WHERE BuildingID IN ($resRoomType[comment])";
$resultb=mysqli_query($condb,$sqlbuilding);



$Passwd=date("dmY",strtotime($resvrequest['BirthDate']));

$sqlresident="SELECT BuildingID,RoomRate,StartDate,RoomID,ResidentID,SocialID FROM v_resident WHERE SocialID='$resvrequest[SocialID]'";
$rsd=mysqli_fetch_assoc(mysqli_query($condb,$sqlresident));
$BuildingID=$rsd['BuildingID']; $RoomRate=$rsd['RoomRate'];$ResidentID=$rsd['ResidentID'];

$st_dayred=dateselect(date("d",($Status!=1)?strtotime($rsd['StartDate']):strtotime(date("Y-m-d"))),'st_dayred',100);
$st_monthred=monthselect(date("m",($Status!=1)?strtotime($rsd['StartDate']):strtotime(date("Y-m-d"))),'st_monthred',100);
$st_yearred=yearselect(date("Y",($Status!=1)?strtotime($rsd['StartDate']):strtotime(date("Y-m-d"))),'st_yearred',2019,date("Y"),100,'');

$get_dayred=dateselect(date("d",($Status!=1)?strtotime($resvrequest['KeyAcceptDate']):strtotime(date("Y-m-d"))),'get_dayred',100);
$get_monthred=monthselect(date("m",($Status!=1)?strtotime($resvrequest['KeyAcceptDate']):strtotime(date("Y-m-d"))),'get_monthred',100);
$get_yearred=yearselect(date("Y",($Status!=1)?strtotime($resvrequest['KeyAcceptDate']):strtotime(date("Y-m-d"))),'get_yearred',2019,date("Y"),100,'');

$labelrate=" <div class=\"row\"><div class=\"col-10\"><label>ค่าประกันความเสียหายต่อห้อง(เฉพาะแรกเข้า) </label></div><div class=\"col-2 right\">00.00 บาท</div></div>
<div class=\"row\"><div class=\"col-10\"><label>ค่ามัดจําสาธารณูปโภคล่วงหน้าต่อห้อง(เฉพาะแรกเข้า) </label></div><div class=\"col-2 right\">00.00 บาท</div></div>
<div class=\"row\"><div class=\"col-10\"><label>ค่าประกันลูกกุญแจและคีย์การ์ดต่อห้อง </label></div><div class=\"col-2 right\">00.00 บาท</div></div>";

$actionForm=($Status==1)?"SaveFormAllocate()":"UpDateAllocateForm()";
?>
<div class="container">
    <form id="saveformAllocate" onsubmit="if(chvalFormAllocate()) <?=$actionForm;?>;else return false;"  method="post">
    
        <div>
            <b>ข้อมูลผู้ถูกจัดสรรที่พักอาศัย</b><br>
            <input type="hidden" id="RequestID" name="RequestID" value="<?=$RequestID;?>">
            <input type="hidden" id="StaffID" name="StaffID" value="<?=$StaffID;?>">
            <input type="hidden" id="SocialID" name="SocialID" value="<?=$resvrequest['SocialID'];?>">
            <input type="hidden" id="Passwd" name="Passwd" value="<?=$Passwd?>">
            <?php if($Status!=1){
            echo "<input type=\"hidden\" id=\"befRoomID\" name=\"befRoomID\" value=\"$rsd[RoomID]\">";
            echo "<input type=\"text\" id=\"ResidentID\" name=\"ResidentID\" value=\"$ResidentID\">";
            }?>
            <label><b> ชื่อ :
                </b><?php echo $resvrequest['PName']." ".$resvrequest['Name']." ".$resvrequest['Surname'];?></label>
            <label><b> ตำแหน่ง : </b><?=$resvrequest['PositionName'];?></label>
            <div class="row">
                <div class="col-5">
                    <div class="mr-ml">
                        <label>อาคาร *</label>
                        <select name="BuildingID" id="BuildingID"
                            onchange="buildingbyroom(this.options[this.selectedIndex].value,0,<?=$StaffID;?>)">
                            <option value="0" disabled selected>เลือกอาคารที่พักอาศัย</option>
                            <?php while ($rowb = mysqli_fetch_assoc($resultb)) { ?>
                            <option value="<?=$rowb['BuildingID'];?>"
                                <?php if($resvrequest['BuildingID']==$rowb['BuildingID']){echo "selected";}?>>
                                <?=$rowb['BuildingName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-7">
                    <div class="mr-ml">
                        <label>หมายเลขห้อง *</label>
                        <lable id="RoomNamelable">
                            <select name="RoomID" id="RoomID">
                                <option value="0">เลือกหมายเลขห้องที่พักอาศัย</option>
                                <?php if($Status!=1){
                                    while($getroom=mysqli_fetch_assoc($resroom)){
                                        if($getroom['RoomStatus']==3){
                                            $st="disabled";
                                        }else{$st="";}
                                        if($getroom['RoomID']==$rsd['RoomID']){
                                            $st="selected";
                                        }
                                        //(($resvrequest['RoomID']==$getroom['RoomID'])?'selected':'').(($getroom['RoomStatus']==3)?" disabled":"").
                                        echo "<option value=\"".$getroom['RoomID']."\" ".$st." >".$getroom['RoomName']." -".$getroom['RoomStatusName']."</option>";
                                    }
                                }?>
                            </select>
                        </lable>
                    </div>
                </div>
            </div>
            <label>จำนวนผู้พักอาศัย *</label>
            <div class="mr-ml">
                <input type="text" name="LivingCount" id="LivingCount" placeholder="จำนวนผู้พักอาศัย"
                    value="<?=$LivingCount;?>">
            </div>
            <label>วันที่เข้าพักอาศัย *</label>
            <div class="row">
                <div class="col-3">
                    <div class="mr-ml"><?=$st_dayred;?></div>
                </div>
                <div class="col-6">
                    <div class="mr-ml"><?=$st_monthred;?></div>
                </div>
                <div class="col-3">
                    <div class="mr-ml"><?=$st_yearred;?></div>
                </div>
            </div>
            <label>วันที่รับคีย์ *</label>
            <div class="row">
                <div class="col-3">
                    <div class="mr-ml"><?=$get_dayred;?></div>
                </div>
                <div class="col-6">
                    <div class="mr-ml"><?=$get_monthred;?></div>
                </div>
                <div class="col-3">
                    <div class="mr-ml"><?=$get_yearred;?></div>
                </div>
            </div>
            <label>ผู้พักอาศัยต้องชําระค่าใช้จ่ายในสวัสดิการที่พักอาศัย ดังนี้</label>
            <div class="mr-ml border-rateroom">
                <lable id="lablebuilding">
                    <?php if($Status!=1){
                        echo "<div class=\"row\"><div class=\"col-9\"><label>ค่าประกันความเสียหายต่อห้อง(เฉพาะแรกเข้า) </label></div><div class=\"col-3 right\">1,000.00 บาท</div></div>";
                        echo"<div class=\"row\"><div class=\"col-10\"><label>ค่ามัดจําสาธารณูปโภคล่วงหน้าต่อห้อง(เฉพาะแรกเข้า) </label></div><div class=\"col-2 right\">500.00 บาท</div></div>";
                        echo"<div class=\"row\"><div class=\"col-10\"><label>ค่าประกันลูกกุญแจและคีย์การ์ดต่อห้อง </label></div><div class=\"col-2 right\">200.00 บาท</div></div>";
                    } else {echo $labelrate;} ?>
                </lable>
                <lable id="lableroomrate">
                    <?php if($Status!=1){
                        echo "<div class=\"row\"><div class=\"col-10\"><label>อัตราค่าบำรุงห้อง(ต่อเดือน)</label></div><div class=\"col-2 right\">".number_format($RoomRate,2)." บาท </div></div>";
                        echo "<div class=\"row\"><div class=\"col-9\"><label>รวมทั้งหมด </label></div><div class=\"col-3 right\">".number_format($price,2)." บาท</div></div>";
                    } else {
                        echo "<div class=\"row\"><div class=\"col-10\"><label>อัตราค่าบำรุงห้อง(ต่อเดือน)</label></div><div class=\"col-2 right\">00.00 บาท </div></div>";
                        echo "<div class=\"row\"><div class=\"col-10\"><label>รวมทั้งหมด </label></div><div class=\"col-2 right\">00.00 บาท</div></div>";
                    } 
                    ?>
                </lable>
            </div>
        </div><br>
        <div class="center">
        <button type="submit" class="btn-add"><i class="icons save nameicon"></i>บันทึกข้อมูล</button>

            <!-- <input type="submit" id="btnFrmAllocate" disabled class="btn-sm btn-sm-info" value="บันทึก"> -->
        </div>
    </form>
</div>