<?php 
include('../function/connectDB.php');
include '../function/date.php';
if(isset($_POST['RequestID']) && isset($_POST['RequestDate'])){$RequestID=$_POST['RequestID'];$RequestDate=$_POST['RequestDate'];}
$RequestID=$_POST['RequestID'];
$RequestDate=date("Y-m-d");
$RoomtypeID=$_POST['RoomtypeID'];
$PName=$_POST['PName'];$Name=$_POST['Name']; $Surname=$_POST['Surname'];
$PositionID=$_POST['PositionID']; $FacID=$_POST['FacID'];  $DeptID=$_POST['DeptID'];
$PersonnelType= $_POST['PersonnelType'];
$DissaterEffect=$_POST['DissaterEffect'];
$RightClaim=$_POST['RightClaim'];$RepaymentRight=$_POST['RepaymentRight'];
$MaritalStatus=$_POST['MaritalStatus'];
$CurProvinceID=$_POST['CurProvinceID'];$CurCityID=$_POST['CurCityID'];$CurDistrictID=$_POST['CurDistrictID'];
$Address=$_POST['Address'];
$ProvinceID=$_POST['ProvinceID'];$CityID=$_POST['CityID']; $DistrictID=$_POST['DistrictID'];
$bi_d=$_POST['bi_d'];$bi_m=$_POST['bi_m'];$bi_y=$_POST['bi_y'];
$BirthDate= $bi_y."-".$bi_m."-".$bi_d;
$ChildrenCount=$_POST['ChildrenCount']; 
$st_d=$_POST['st_d'];$st_m=$_POST['st_m'];$st_y=$_POST['st_y'];
$EmployDate=$st_y."-".$st_m."-".$st_d;
$SocialID=$_POST['SocialID'];
if(!empty($_POST['Notics'])){ $Notics=$_POST['Notics'];} else {$Notics='';}
?>
<div class="container" id="printableArea">
    
    <div class="formbox-w" style="position: relative;">
    <div class="borderimgfq">
    </div>
        <div class="heFCSS l1">
            <b style="font-size:1.1em;">แบบฟอร์มขอรับการจัดสรรที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</b><br> (แฟลต 6 จัดสรรให้เฉพาะบุคลากร ว.แพทย์ คณะเภสัชศาสตร์และพยาบาลศาสตร์)
        </div>
        <div class="container l1">
            <div style="display: flex;flex-wrap: wrap;">
                <div class="col-12 center">
                    <div style="display: flex;flex-wrap: wrap;">
                        <div class="col-3 right"></div>
                        <div class="col-2 left">
                            ห้องโสด <br> ห้องครอบครัว
                        </div>
                        <div class="col-6 left">
                            <i class="inradio<?php if($RoomtypeID==1){ echo "ck ";} ?>"></i> แฟลต 1-4
                            <i class="inradio<?php if($RoomtypeID==6){ echo "ck ";} ?>"></i> แฟลต 5
                            <i class="inradio<?php if($RoomtypeID==4){ echo "ck ";} ?>"></i> แฟลต 6 <br>
                            <i class="inradio<?php if($RoomtypeID==2){ echo "ck ";} ?>"></i> แฟลต 2-4
                            <i class="inradio<?php if($RoomtypeID==3){ echo "ck ";} ?>"></i> แฟลต 5
                            <i class="inradio<?php if($RoomtypeID==5){ echo "ck ";} ?>"></i> แฟลต 6
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div style="display: flex;flex-wrap: wrap;">
                <div class="col-12 center l1 " style="display: flex;flex-wrap: wrap;;">
                    <div class="col-5 left">ส่วนที่ 1 ผู้ขอรับการจัดสรร</div>
                    <div class="col-7 left">
                        <i class="inradio"></i> ไม่เป็นนักเรียนทุน<br>
                        <i class="inradio"></i> นักเรียนทุน(ระบุประเภท/แหล่งทุน)..........................................
                    </div>
                </div>
            </div>
            <div>
                <div class=col-12><b>เรียน   ประธานคณะกรรมการสวัสดิการที่พักอาศัย มหาวิทยาลัยอุบลราชธานี</b></div>
            </div>
            <div>
                <div class="col-12">
                    <div class="boxfq" style="margin: 0px 80px;">
                        ข้าพเจ้า <label class="inputfq"> <?php echo $PName.$Name." &nbsp; ".$Surname; ?></label>
                        <?php
							$sql = "SELECT * FROM position where PositionID=$PositionID";
							$res = mysqli_query($condb,$sql);
							$row = mysqli_fetch_assoc($res); ?>
                            <label>ตำแหน่ง <label class="inputfq"><?php echo $row['PositionName']; ?></label></label>
                    </div>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <?php
					 $sqlfa = "SELECT * FROM faculty where FacID=$FacID";
						$rowfa = mysqli_fetch_assoc(mysqli_query($condb,$sqlfa));?>
                        สังกัด <label class="inputfq">  <?php echo $rowfa['FacNameT']; ?></label>
                        <label>ประเภทบุคลากร </label>
                        <i class="inradio<?php if($PersonnelType==1) {echo "ck ";} ?>"></i> ข้าราชการ
                        <i class="inradio<?php if($PersonnelType==2) {echo "ck ";} ?>"></i> พนักงานมหาวิทยาลัย
                        <i class="inradio<?php if($PersonnelType==3) {echo "ck ";} ?>"></i> ลูกจ้างประจำ
                </div>
            </div>
            <div>
                <div class="col-12">
                    <i class="inradio<?php if($PersonnelType==4) {echo "ck ";} ?>"></i> กรณีคณะ/สำนัก /หน่วยงาน ยื่นขอเพื่อ (*ระบุเหตุผล/ความจำเป็น)
                    <label class="inputfq"> <?php if(!empty($_POST['Notics'])){ if($Notics==4){ echo $Notics;} }?></label>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <label>สิทธิในการเบิกค่าเช่าบ้าน หรือเช่าซื้อบ้าน</label>
                    <i class="inradio<?php if($RightClaim==1) {echo "ck ";} ?>"></i> มี
                    <i class="inradio<?php if($RightClaim==0) {echo "ck ";} ?>"></i> ไม่มี
                    <label>กรณีมีสิทธิ ปัจจุบัน </label>
                    <i class="inradio<?php if($RepaymentRight==1) {echo "ck ";} ?>"></i> ใช้สิทธิ
                    <i class="inradio<?php if($RepaymentRight==0) {echo "ck ";} ?>"></i> ไม่ใช้สิทธิ
                </div>
            </div>
            <div>
                <div class="col-12">
                    <label>สถานภาพ</label>
                    <i class="inradio<?php if($MaritalStatus==1) {echo "ck ";} ?>"></i> โสด
                    <i class="inradio<?php if($MaritalStatus==2) {echo "ck ";} ?>"></i> สมรส
                    <i class="inradio<?php if($MaritalStatus==3) {echo "ck ";} ?>"></i> หย่า
                    <i class="inradio<?php if($MaritalStatus==4) {echo "ck ";} ?>"></i> คู่สมรสในมหาวิทยลัยฯ
                    <label>จำนวนบุตร <label class="inputfq"> <?php echo $ChildrenCount; ?></label> คน </label>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <label>
							<?php 
							$sqlfa = "SELECT province.ProvinceID,province.ProvinceNameT, city.CityID,city.CityNameT,city.ProvinceID,city.CitySeq ,district.DistrictID,district.DistrictNameT ";
							$sqlfa .= " FROM province JOIN city ON city.ProvinceID= province.ProvinceID JOIN district on district.CityID=city.CityID ";
							$sqlfa .=" WHERE province.ProvinceID = $CurProvinceID and city.CityID= $CurCityID and district.DistrictID=$CurDistrictID "; 
							$resfa = mysqli_query($condb,$sqlfa);
							$rofa=mysqli_fetch_assoc($resfa); 
							?>
                            ที่พักอาศัยปัจจุบัน ตำบล <label class="inputfq"><?=$rofa['DistrictNameT'] ; ?></label> อำเภอ <label class="inputfq"><?=$rofa['CityNameT']; ?></label> จังหวัด <label class="inputfq"><?=$rofa['ProvinceNameT']; ?></label>
                    </label>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <?php 
							$sqlfa = "SELECT province.ProvinceID,province.ProvinceNameT, city.CityID,city.CityNameT,city.ProvinceID,city.CitySeq ,district.DistrictID,district.DistrictNameT ";
							$sqlfa .= " FROM province JOIN city ON city.ProvinceID= province.ProvinceID JOIN district on district.CityID=city.CityID ";
							$sqlfa .=" WHERE province.ProvinceID = $ProvinceID and city.CityID = $CityID and district.DistrictID=$DistrictID "; 
							$resfa = mysqli_query($condb,$sqlfa);
							$rofan=mysqli_fetch_assoc($resfa); 
							?>
                    <label>
                    ที่อยู่ตามทะเบียนบ้าน บ้านเลขที่ <label class="inputfq"><?php echo $Address; ?></label> ตำบล <label class="inputfq"><?=$rofan['DistrictNameT']; ?></label> อำเภอ
                    <label class="inputfq"> <?=$rofan['CityNameT']; ?> </label>
                    </label>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <label>จังหวัด <label class="inputfq"><?=$rofan['ProvinceNameT'] ?></label> </label>
                    <label>บรรจุเข้าปฏิบัติงานในมหาวิทยาลัยอุบลราชธานี เมื่อ </label><label class="inputfq"><?php echo date2str($EmployDate); ?></label>
                </div>
            </div>
            <div>
                <div class="col-12">
                    <label>ได้แนบสำเนาเอกสารประกอบ ดังนี้</label>
                    &#9744; บัตรประจำตัว &#9744; ทะเบียนบ้าน  &#9744; ทะเบียนสมรส &#9744; สูติบัตรบุตร
                </div>
            </div>
            <div>
                <label><b>ข้าพเจ้าขอรับรองว่า</b></label>
                <div class="col-12">
                    <label>1. ข้อมูลข้างต้นเป็นความจริงทุกประการ หากตรวจสอบแล้วไม่เป็นจริง ยินดีให้ยกเลิกการใช้สิทธิในที่พักอาศัยที่ได้รับจัดสรร</label><br>
                    <label>2. หากข้าพเจ้าได้รับการจัดสรรที่พักอาศัยแล้ว ข้าพเจ้าจะปฏิบัติตามกฎระเบียบต่างๆ โดยเคร่งครัด และยินยอมให้หักเงินเดือน เพื่อชำระค่าบำรุง ค่าน้ำ ค่าไฟฟ้า หรือค่าใช้จ่ายอื่นๆ อันเนื่องมาจากการพักอาศัย</label>
                </div>
            </div>
            <table width="100%">
                <tr>
                    <td width="60%">
                        <div style="float: right; padding-right: 45px;">
                            <div style="text-align: center;">
                                (ลงชื่อ).......................................... ผู้ขอรับการจัดสรร
                            </div>
                            <div style="padding-left: 35px;">
                                ( <?php echo $PName.$Name." &nbsp; ".$Surname; ?> )
                            </div>
                            <div style="padding-left: 15px;">
                                <?php
                                if(isset($RequestID)>0){
                                    echo date2str($RequestDate,0,1);
                                }else{
                                    echo date2str(date("Y-m-d"),0,1);
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <table cellspacing="0" width="100%">
                    <tr>
                        <td width="50%">
                            <b>ส่วนที่ 2 คำรับรองของผู้บังคับบัญชา</b><br>
                            <i class="inradio"></i> ข้อมูลข้างต้นเป็นความจริง <br>
                            <i class="inradio"></i> ขอรับการจัดสรรในนามของคณะ/สำนัก <br>
                            <i class="inradio"></i> อื่น......................................</label>
                        </td>
                        <td width="50%"></td>
                    </tr>
                </table>
            </div>
            <table width="100%">
                <tr>
                    <td width="60%">
                        <div style="float: right; padding-right: 15px;">
                            <div style="text-align: center;">
                                (ลงชื่อ).......................................... ผู้บังคับบัญชา/ผู้บริหาร
                            </div>
                            <div style="padding-left: 35px;">
                                (..........................................)
                            </div>
                            <div style="padding-left: 15px;">
                                วันที่..........เดือน...........................พ.ศ............
                            </div>
                        </div>
                    </td>
                </tr>

                </tabel>
                <table class="tablefq" cellspacing="0" width="100%">
                    <b>ส่วนที่ 3 ความเห็นของเลขานุการ และประธานคณะกรรมการสวัสดิการที่พักอาศัย/หรือตัวแทน</b>
                    <tr>
                        <td width="50%">
                            <i class="inradio"></i> เห็นควรจัดห้องหมายเลข...................แฟลต........... <br>
                            <i class="inradio"></i> เห็นควรนำเข้าที่ประชุมคณะกรรมการ <br>
                            <i class="inradio"></i> เห็นควรส่งเรื่องคืน เนื่องจาก.................................. <br>
                            <div style="float: right; padding-right: 15px;">
                                <div style="text-align: center;">
                                    (ลงชื่อ).......................................... เลขานุการ
                                </div>
                                <div style="padding-left: 40px;">
                                    (..........................................)
                                </div>
                                <div style="padding-left: 15px;">
                                    วันที่..........เดือน...........................พ.ศ............
                                </div>
                            </div>
                        </td>
                        <td width="50%">
                            <i class="inradio"></i> เห็นชอบตามเสนอ<br>
                            <i class="inradio"></i> อนุมัติ<br><br>
                            <div style="float: right; padding-right: 15px;">
                                <div style="text-align: center;">
                                    (ลงชื่อ).......................................... ประธาน
                                </div>
                                <div style="padding-left: 40px;">
                                    (..........................................)
                                </div>
                                <div style="padding-left: 15px;">
                                    วันที่..........เดือน...........................พ.ศ............
                                </div>
                            </div>
                        </td>
                    </tr>

                </table>
                <br>
                <div>
                    <label><b>หมายเหตุ * </b> เหตุผล/ความจำเป็นของคณะ/สำนัก/หน่วยงาน เช่น เป็นที่พักสำหรับพยาบาลที่เข้าเวร หรือ เป็นที่พักสำหรับ
                        คนงานที่ดูแลระบบไฟฟ้าหรือเป็นที่พักสำหรับเจ้าหน้าที่จัดเตรยีมงานปริญญาบัตรฯที่ปฏิบตัิงานนอกเวลาราชการ ฯลฯ</label> <!--" SaveFormReq()" -->
                </div>
                 <form id="confirmFr" name="confirmFr" onsubmit="return <?=($RequestID>0)?'SaveFormReqUpdate()':'SaveFormReq()'; ?>" method="POST"> <!-- action="./form/insertfromreq.php" -->
                    <input type="hidden" name="RoomtypeID" id="RoomtypeID" value="<?=$RoomtypeID;?>">
                    <input type="hidden" name="PName" value="<?=$PName;?>">
                    <input type="hidden" name="Name" value="<?=$Name;?>">
                    <input type="hidden" name="Surname" value="<?=$Surname;?>">
                    <input type="hidden" name="PositionID" value="<?=$PositionID;?>">
                    <input type="hidden" name="FacID" value="<?=$FacID;?>">
                    <input type="hidden" name="DeptID" value="<?=$DeptID;?>">
                    <input type="hidden" name="PersonnelType" value="<?=$PersonnelType;?>">
                    <input type="hidden" name="RightClaim" value="<?=$RightClaim;?>">
                    <input type="hidden" name="RepaymentRight" value="<?=$RepaymentRight;?>">
                    <input type="hidden" name="MaritalStatus" value="<?=$MaritalStatus;?>">
                    <input type="hidden" name="DissaterEffect" value="<?=$DissaterEffect;?>">
                    <input type="hidden" name="ProvinceID" value="<?=$ProvinceID;?>">
                    <input type="hidden" name="CityID" value="<?=$CityID;?>">
                    <input type="hidden" name="DistrictID" value="<?=$DistrictID;?>">
                    <input type="hidden" name="Address" value="<?=$Address;?>">
                    <input type="hidden" name="CurProvinceID" value="<?=$CurProvinceID;?>">
                    <input type="hidden" name="CurCityID" value="<?=$CurCityID;?>">
                    <input type="hidden" name="CurDistrictID" value="<?=$CurDistrictID;?>">
                    <input type="hidden" name="BirthDate" value="<?=$BirthDate;?>">
                    <input type="hidden" name="EmployDate" value="<?=$EmployDate;?>">
                    <input type="hidden" name="ChildrenCount" value="<?=$ChildrenCount;?>">
                    <input type="hidden" name="Notics" value="<?=$Notics;?>">
                    <input type="hidden" name="SocialID" value="<?=$SocialID;?>">
                    <input type="hidden" name="RequestID" value="<?=$RequestID;?>">
                    <div class="row">
                        <div class="alr">
                            <input type="button" id="blackin" class="btn-sm btn-sm-info" value="[ แก้ไข ]" onclick="closefq()">
                            <input type="submit" id="saveform" class="btn-sm btn-sm-info"  value="ยืนยัน">
                            <input type="้button" id="shprint" class="btn-sm btn-sm-info" value="[ พิมพ์ ]" onclick="printDiv('printableArea')">
                            <input type="button" id="cosfr" class="btn-sm btn-sm-drag"  value="[ ปิด ]" onclick="window.location='./index.php';">
                        </div>
                    </div>
                </form>
        </div>
    </div>