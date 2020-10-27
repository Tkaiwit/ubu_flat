<?php include '../function/connectDB.php'; include '../function/date.php';
$RequestID=$_POST['RequestID'];
$sql="SELECT * FROM v_request_form WHERE RequestID=$RequestID";
$row=mysqli_fetch_assoc(mysqli_query($condb,$sql));
$CurProvinceID=$row['CurProvinceID'];
$CurCityID=$row['CurCityID'];
$CurDistrictID=$row['CurDistrictID'];
$ProvinceID=$row['ProvinceID'];
$CityID=$row['CityID'];
$DistrictID=$row['DistrictID'];
$EmployDate=$row['EmployDate'];
?>

<div class="BoxformAccept" id="formAccept">
    <div class="box-formAccept">
        <div class="formAccept" >
            <form onsubmit="formacceptBy();" method="post" >
            <dt><b>
                <?=($row['FormStatus']==3)?"เรียกคืนแบบฟอร์มคำร้องขอจัดสรรที่พักอาศัย":"ตรวจสอบแบบฟอร์มคำร้องขอจัดสรรที่พักอาศัย"; ?>
            </dt></b>
            <select name="statusform" id="statusform"
                onchange="formacceptByStatus(this.options[this.selectedIndex].value)" class="select">
                <option value="2">ยอมรับเอกสาร</option>
                <option value="3" <?=($row['FormStatus']==3)?"selected":"";?>>ยกเลิกคำร้องขอจัดสรรฯ</option>
            </select>
            <div id="comment" <?=($row['FormStatus']==3)?"style=\"display: block;\"":"";?>>
                <textarea name="" placeholder="หมายเหตุ..." class="box-textarea" id="dt-comment" rows="2"><?=$row['comment'];?></textarea>
            </div>
            <input type="hidden" id="RequestID" value="<?=$RequestID?>">
            <input type="submit" class="btn-sm btn-sm-green" value="บันทึก">
            <input type="button" class="btn-sm btn-sm-drag" onclick="closemodal()" value="ยกเลิก">
            </form>
        </div>
    </div>
</div>
<div class="formbox-w">
    <div class="borderimgfq" style="right: 250px;">
    </div>
    <div class="heFCSS l1">
        <b style="font-size:1.1em;">แบบฟอร์มขอรับการจัดสรรที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</b><br> (แฟลต 6
        จัดสรรให้เฉพาะบุคลากร ว.แพทย์ คณะเภสัชศาสตร์และพยาบาลศาสตร์)
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
                        <i class="inradio<?php if($row['RoomType']==1){ echo "ck ";} ?>"></i> แฟลต 1-4
                        <i class="inradio<?php if($row['RoomType']==6){ echo "ck ";} ?>"></i> แฟลต 5
                        <i class="inradio<?php if($row['RoomType']==4){ echo "ck ";} ?>"></i> แฟลต 6 <br>
                        <i class="inradio<?php if($row['RoomType']==2){ echo "ck ";} ?>"></i> แฟลต 2-4
                        <i class="inradio<?php if($row['RoomType']==3){ echo "ck ";} ?>"></i> แฟลต 5
                        <i class="inradio<?php if($row['RoomType']==5){ echo "ck ";} ?>"></i> แฟลต 6
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
                    <i class="inradio"></i>
                    นักเรียนทุน(ระบุประเภท/แหล่งทุน)..........................................
                </div>
            </div>
        </div>
        <div>
            <div class=col-12><b>เรียน ประธานคณะกรรมการสวัสดิการที่พักอาศัย มหาวิทยาลัยอุบลราชธานี</b></div>
        </div>
        <div>
            <div class="col-12">
                <div class="boxfq" style="margin: 0px 80px;">
                    ข้าพเจ้า <label class="inputfq">
                        <?=$row['PName']." ".$row['Name']." &nbsp; ".$row['Surname']; ?></label>
                    <?php
                    $PositionID=$row['PositionID'];
							$sql = "SELECT * FROM position where PositionID=$PositionID";
							$res = mysqli_query($condb,$sql);
							$rows = mysqli_fetch_array($res); ?>
                    <label>ตำแหน่ง <label class="inputfq"><?= $rows['PositionName']; ?></label></label>
                </div>
            </div>
        </div>
        <div>
            <div class="col-12">
                <?php
                $FacID=$row['FacID'];
					 $sqlfa = "SELECT * FROM faculty where FacID=$FacID";
						$resfa = mysqli_query($condb,$sqlfa);
						$rowfa = mysqli_fetch_array($resfa);?>
                สังกัด <label class="inputfq"> <?php echo $rowfa['FacNameT']; ?></label>
                <label>ประเภทบุคลากร </label>
                <i class="inradio<?php if($row['PersonnelType']==1) echo "ck "; ?>"></i> ข้าราชการ
                <i class="inradio<?php if($row['PersonnelType']==2) echo "ck "; ?>"></i> พนักงานมหาวิทยาลัย
                <i class="inradio<?php if($row['PersonnelType']==3) echo "ck "; ?>"></i> ลูกจ้างประจำ
            </div>
        </div>
        <div>
            <div class="col-12">
                <i class="inradio<?php if($row['PersonnelType']==4) echo "ck "; ?>"></i> กรณีคณะ/สำนัก /หน่วยงาน
                ยื่นขอเพื่อ
                (*ระบุเหตุผล/ความจำเป็น)
                <label class="inputfq">
                    <?php if(!empty($_POST['Notics'])){ if($row['Notics']==4){ echo '';} }?></label>
            </div>
        </div>
        <div>
            <div class="col-12">
                <label>สิทธิในการเบิกค่าเช่าบ้าน หรือเช่าซื้อบ้าน</label>
                <i class="inradio<?php if($row['RightClaim']==1) echo "ck "; ?>"></i> มี
                <i class="inradio<?php if($row['RightClaim']==0) echo "ck "; ?>"></i> ไม่มี
                <label>กรณีมีสิทธิ ปัจจุบัน </label>
                <i class="inradio<?php if($row['RepaymentRight']==1) echo "ck "; ?>"></i> ใช้สิทธิ
                <i class="inradio<?php if($row['RepaymentRight']==0) echo "ck "; ?>"></i> ไม่ใช้สิทธิ
            </div>
        </div>
        <div>
            <div class="col-12">
                <label>สถานภาพ</label>
                <i class="inradio<?php if($row['MaritalStatus']==1) echo "ck "; ?>"></i> โสด
                <i class="inradio<?php if($row['MaritalStatus']==2) echo "ck "; ?>"></i> สมรส
                <i class="inradio<?php if($row['MaritalStatus']==3) echo "ck "; ?>"></i> หย่า
                <i class="inradio<?php if($row['MaritalStatus']==4) echo "ck "; ?>"></i> คู่สมรสในมหาวิทยลัยฯ
                <label>จำนวนบุตร <label class="inputfq"> <?= $row['ChildrenCount']; ?></label> คน </label>
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
							$rofa=mysqli_fetch_array($resfa); 
							?>
                    ที่พักอาศัยปัจจุบัน ตำบล <label class="inputfq"><?=$rofa['DistrictNameT'] ; ?></label> อำเภอ
                    <label class="inputfq"><?=$rofa['CityNameT']; ?></label> จังหวัด <label
                        class="inputfq"><?=$rofa['ProvinceNameT']; ?></label>
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
							$rofan=mysqli_fetch_array($resfa); 
							?>
                <label>
                    ที่อยู่ตามทะเบียนบ้าน บ้านเลขที่ <label class="inputfq"><?=$row['Address']; ?></label> ตำบล
                    <label class="inputfq"><?=$rofan['DistrictNameT']; ?></label> อำเภอ
                    <label class="inputfq"> <?=$rofan['CityNameT']; ?> </label>
                </label>
            </div>
        </div>
        <div>
            <div class="col-12">
                <label>จังหวัด <label class="inputfq"><?=$rofan['ProvinceNameT'] ?></label> </label>
                <label>บรรจุเข้าปฏิบัติงานในมหาวิทยาลัยอุบลราชธานี เมื่อ </label><label
                    class="inputfq"><?php echo date2str($EmployDate); ?></label>
            </div>
        </div>
        <div>
            <div class="col-12">
                <label>ได้แนบสำเนาเอกสารประกอบ ดังนี้</label>
                <input type="checkbox"style="border: 1px solid #8d8d8d;" name="wordsheel" value="1">
                <label class="namecheckbox"> บัตรประจำตัว</label> 
                <input type="checkbox" style="border: 1px solid #8d8d8d;" name="wordshee2" value="2">
                <label class="namecheckbox"> ทะเบียนบ้าน</label>  
                <input type="checkbox" style="border: 1px solid #8d8d8d;" name="wordshee3" value="3">
                <label class="namecheckbox"> ทะเบียนสมรส</label>
                <input type="checkbox" style="border: 1px solid #8d8d8d;" name="wordshee4" value="4">
                <label class="namecheckbox"> สูติบัตรบุตร</label>   
            </div>
        </div>
        <div>
            <label><b>ข้าพเจ้าขอรับรองว่า</b></label>
            <div class="col-12">
                <label>1. ข้อมูลข้างต้นเป็นความจริงทุกประการ หากตรวจสอบแล้วไม่เป็นจริง
                    ยินดีให้ยกเลิกการใช้สิทธิในที่พักอาศัยที่ได้รับจัดสรร</label><br>
                <label>2. หากข้าพเจ้าได้รับการจัดสรรที่พักอาศัยแล้ว ข้าพเจ้าจะปฏิบัติตามกฎระเบียบต่างๆ โดยเคร่งครัด
                    และยินยอมให้หักเงินเดือน เพื่อชำระค่าบำรุง ค่าน้ำ ค่าไฟฟ้า หรือค่าใช้จ่ายอื่นๆ
                    อันเนื่องมาจากการพักอาศัย</label>
            </div>
        </div>
        <table width="100%">
            <tr>
                <!-- <td width="50%"></td> -->
                <td width="60%">
                    <div style="float: right; padding-right: 45px;">
                        <div style="text-align: center;">
                            (ลงชื่อ).......................................... ผู้ขอรับการจัดสรร
                        </div>
                        <div style="padding-left: 35px;">
                            ( <?php echo $row['PName'].$row['Name']." &nbsp; ".$row['Surname']; ?> )
                        </div>
                        <div style="padding-left: 15px;">
                        <?=date2str($row['RequestDate'],0,1);?>
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
                <!-- <td width="50%"></td> -->
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
                <label><b>หมายเหตุ * </b> เหตุผล/ความจำเป็นของคณะ/สำนัก/หน่วยงาน เช่น
                    เป็นที่พักสำหรับพยาบาลที่เข้าเวร
                    หรือ เป็นที่พักสำหรับ
                    คนงานที่ดูแลระบบไฟฟ้าหรือเป็นที่พักสำหรับเจ้าหน้าที่จัดเตรยีมงานปริญญาบัตรฯที่ปฏิบตัิงานนอกเวลาราชการ
                    ฯลฯ</label>
            </div>
    </div>
</div>
<!-- </div> -->