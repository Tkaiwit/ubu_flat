<?php include '../function/connectDB.php';  include '../function/date.php';
$RequestID=$_POST['RequestID']; $StaffID=$_POST['StaffID'];
$sqlvrequest_form="SELECT MaritalStatus,ChildrenCount,RoomType,SocialID,PName,Name,Surname,PositionName FROM v_request_form WHERE RequestID=$RequestID ";
$resvrequest=mysqli_fetch_assoc(mysqli_query($condb,$sqlvrequest_form));
$SocialID=$resvrequest['SocialID'];
($resvrequest["MaritalStatus"]==2 || $resvrequest['MaritalStatus']==4)?$LivingCount=2:$LivingCount=1;
$LivingCount=$LivingCount+$resvrequest['ChildrenCount'];
$sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode !=6 ORDER BY ValueE";
$resRoomType=mysqli_query($condb,$sqlRoomType); 
$sqlbuilding="SELECT * FROM building ";
$cond="";
($resvrequest['RoomType']==1)?$cond.="1,2,3,4":"";
($resvrequest['RoomType']==4 || $resvrequest['RoomType']==5)? $cond.="6":"";
($resvrequest['RoomType']==2)?$cond.="2,3,4":"";
($resvrequest['RoomType']==3)?$cond.="5":"";
$sqlbuilding.="WHERE BuildingID IN ($cond)";
$resultb=mysqli_query($condb,$sqlbuilding);
echo$sqlresident="SELECT BuildingID,RoomRate,StartDate,KeyAcceptDate,RoomID,ResidentID FROM v_resident WHERE UserLogin='$SocialID'";
$rsd=mysqli_fetch_assoc(mysqli_query($condb,$sqlresident));
$BuildingID=$rsd['BuildingID']; $RoomRate=$rsd['RoomRate'];$ResidentID=$rsd['ResidentID'];
$st_dayred=dateselect(date("d",strtotime($rsd['StartDate'])),'st_dayred',100);
$st_monthred=monthselect(date("m",strtotime($rsd['StartDate'])),'st_monthred',100);
$st_yearred=yearselect(date("Y",strtotime($rsd['StartDate'])),'st_yearred',2019,date("Y"),100,'');
$get_dayred=dateselect(date("d",strtotime($rsd['KeyAcceptDate'])),'get_dayred',100);
$get_monthred=monthselect(date("m",strtotime($rsd['KeyAcceptDate'])),'get_monthred',100);
$get_yearred=yearselect(date("Y",strtotime($rsd['KeyAcceptDate'])),'get_yearred',2019,date("Y"),100,'');
$labelrate="<label>ค่าประกันความเสียหาย 1,000 บาทต่อห้อง(เฉพาะแรกเข้า) </label><br>
    <label>ค่ามัดจําสาธารณูปโภคล่วงหน้า 500 บาทต่อห้อง(เฉพาะแรกเข้า)</label><br>
    <label>ค่าประกันลูกกุญแจและคีย์การ์ด 200 บาทต่อห้อง </label><br>";
$RoomRate="<label>อัตราค่าเช่าห้อง ".$RoomRate." (ต่อเดือน)</label>";
$sqlde="SELECT RoomID, RoomName, RoomStatus, RoomStatusName,RoomRate FROM v_room  WHERE BuildingID=$BuildingID ORDER BY RoomStatus, RoomName";
$quede=mysqli_query($condb, $sqlde);
?>
<div class="container">
     <form id="UpDateAllocateForm" onclick="return UpDateAllocateForm()" method="post"> <!-- onclick="UpDateAllocateForm()" method="post" -->
        <div>
            <b>ข้อมูลผู้ถูกจัดสรรที่พักอาศัย</b><br>
            <input type="hidden" id="ResidentID" name="ResidentID" value="<?=$ResidentID;?>">
            <input type="hidden" id="RequestID" name="RequestID" value="<?=$RequestID;?>">
            <input type="hidden" id="StaffID" name="StaffID" value="<?=$StaffID;?>">
            <input type="hidden" id="SocialID" name="SocialID" value="<?=$resvrequest['SocialID'];?>">
            <input type="hidden" id="Passwd" name="Passwd" value="<?=$Passwd?>">
            <input type="hidden" id="befRoomID" name="befRoomID" value="<?=$rsd['RoomID'];?>">
            <label><b> ชื่อ :
                </b><?php echo $resvrequest['PName']." ".$resvrequest['Name']." ".$resvrequest['Surname'];?></label>
            <label><b> ตำแหน่ง : </b><?=$resvrequest['PositionName'];?></label>
            <div class="row">
                <div class="col-6">
                    <div class="mr-ml">
                        <label>อาคาร</label>
                        <select name="BuildingID" id="BuildingID"
                            onchange="buildingbyroom(this.options[this.selectedIndex].value,0,<?=$StaffID;?>)">
                            <option value="0" disabled selected>เลือกอาคารที่พักอาศัย</option>
                            <?php while ($rowb = mysqli_fetch_assoc($resultb)) { ?>
                            <option value="<?=$rowb['BuildingID'];?>"
                                <?php if($BuildingID==$rowb['BuildingID']){echo"selected";}?>>
                                <?=$rowb['BuildingName'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mr-ml">
                        <label>หมายเลขห้อง</label>
                        <lable id="RoomNamelable">
                            <select name="RoomID" id="RoomID">
                                <?php while ($getRoom=mysqli_fetch_assoc($quede)){
                                    if($getRoom['RoomStatus']==3){
                                        $st="disabled";
                                    }else{$st="";}
                                    if($getRoom['RoomID']==$rsd['RoomID']){
                                        $st="selected";
                                    }
                                ?>
                                <option value="<?=$getRoom['RoomID']?>" >
                                    <?=$getRoom['RoomName'].' -'.$getRoom['RoomStatusName'];?>
                                </option>
                                <?php } ?>
                            </select>
                        </lable>
                    </div>
                </div>
            </div>
            <label>จำนวนผู้พักอาศัย</label>
            <div class="mr-ml">
                <input type="text" name="LivingCount" id="LivingCount" placeholder="จำนวนผู้พักอาศัย"
                    value="<?=$LivingCount;?>">
            </div>
            <label>วันที่เข้าพักอาศัย</label>
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
            <label>วันที่รับคีย์</label>
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
            <div class="mr-ml">
                <lable id="lablebuilding">
                    <?=$labelrate;?>
                </lable>
                <lable id="lableroomrate">
                    <?=$RoomRate;?>
                </lable>
            </div>
        </div><br>
        <div class="center">
            <input type="submit" class="btn-sm btn-sm-info" value="บันทึก">
        </div>
    </form>
</div>