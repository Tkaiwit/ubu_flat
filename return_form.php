<?php $formreturn=1; include 'inc/toptitle.php'; include 'function/date.php';include 'function/connectDB.php';
    $UserID=$_SESSION["UserID"];
    $sqluser="SELECT * FROM v_resident WHERE UserID=$UserID";
    $row=mysqli_fetch_array(mysqli_query($condb,$sqluser));
    $today=date("Y-m-d");
	$return_date = (strtotime($today));
    $y=date("Y", $return_date);
    $m=date("m",$return_date);
    $d=date("d",$return_date)+1;
    $date=date( "Y-m-d", strtotime( "$y-$m-$d +15 day" ) );
    $date = (strtotime($date));
    $y=date("Y",$date);
    $m=date("m",$date);
    $d=date("d",$date);
 ?>
<div class="container box" style="margin-top: 10px">
    <div id="formReturn-w" class="formbox-w">
        <lable id="lableReturnform">
        <div class="heFCSS">
            <b style="font-size:1.1em;">แบบฟอร์มขอส่งคืนที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</b>
        </div>
        <form id="FormRetn" name="FormRetn" onsubmit="if(chvalFormreturn()) return ReturnForm();else return false;" class="formrq" style="margin-top: 60px;"  method="post">
            <input type="hidden" name="ResidentID" value="<?=$row['ResidentID'];?>">
            <div class="row">
                <div class="col-2">
                    <div class="boxfq">
                        <lable class="label-title">คำนำหน้าชื่อ *</lable>
                        <input type="text" id="UserPNameT" name="UserPNameT" value="<?=$row['UserPNameT'];?>" placeholder="คำนำหน้าชื่อ.">
                    </div>
                </div>
                <div class="col-5">
                    <div class="boxfq">
                        <lable for="" class="label-title">ชื่อ *</lable>
                        <input type="text" name="UserNameT" value="<?=$row['UserNameT'];?>" placeholder="กรุณากรอกชื่อ.">
                    </div>
                </div>
                <div class="col-5">
                    <div class="boxfq">
                        <lable for="" class="label-title">นามสกุล *</lable>
                        <input type="text" name="UserSNameT" value="<?=$row['UserSNameT'];?>" placeholder="กรุณากรอกนามสกุล.">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <lable class="label-title">ตำแหน่ง *</lable>
                        <select name="PositionID" class="select-option">
                            <option value="0" >เลือกตำแหน่ง.</option>
                            <?php
							$sql = "SELECT * FROM position ";
							$res = mysqli_query($condb,$sql);
							 while ($rowp = mysqli_fetch_array($res)) { ?>
                            <option value="<?php echo $rowp['PositionID']; ?>" <?php if($row['PositionID']==$rowp['PositionID']){ echo "selected";}?>><?php echo $rowp['PositionName']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">สังกัด/คณะ *</lable>
                        <select name="FacID" class="select-option">
                            <option value="0" >เลือกสังกัด/คณะ.</option>
                            <?php
							$sqlfa = "SELECT * FROM faculty ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_array($resfa)) { ?>
                            <option value="<?php echo $rowfa['FacID']; ?>" <?php if($row['FacID']==$rowfa['FacID']){echo'selected';}?>><?php echo $rowfa['FacNameT']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                    <lable>ผู้พักอาศัยห้องพักหมายเลข *</lable>
                    <input type="text" name="RoomName" value="<?=$row['RoomName']?>" placeholder="ผู้พักอาศัยห้องพักหมายเลข">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="boxfq">
                    <lable>แฟลต *</lable>
                    <input type="text" name="BuildingID" value="<?=$row['BuildingID'];?>" placeholder="แฟลต">
                    </div>
                </div>
                <div class="col-6">
                    <div class="boxfq">
                        <lable class="label-title">ขอส่งคืนที่พักอาศัยที่ได้รับจัดสรร ตั้งแต่ *</lable><br>
                        <?php echo dateselect($d,'return_d',22); ?>
                        <?php echo monthselect($m,'return_m',50); ?>
                        <?php echo yearselect($y,'return_y',1987,date("Y"),25,''); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12" style="padding:0px 20px;">
                <lable class="label-title">เนื่องจาก *</lable>
                    <textarea name="Cause" id="Cause" class="col-12" rows="3"
                        placeholder="ระบุเหตุผล"></textarea>
                </div>
            </div><br>
            <div class="row">
                <div class="alr">
                    <button type="submit" class="btn-add"><i class="icons nextrigth nameicon"></i>ถัดไป</button>
                </div>
            </div><br>
        </form>
        </lable>
    </div>
</div>

<?php 
include 'function/formmodals.php';
include 'inc/footer.php'; 
?>