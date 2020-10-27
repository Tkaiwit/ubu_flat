<?php $formRq=1;include "inc/toptitle.php";include 'function/date.php';include 'function/connectDB.php';
    $RequestID = $_GET['RequestID'];
    $sqlEditrequest = "SELECT *, ";
    $sqlEditrequest .=" DATE_FORMAT(BirthDate, '%Y') as bi_y ,DATE_FORMAT(BirthDate, '%c') as bi_m,DATE_FORMAT(BirthDate, '%e') as bi_d, ";
    $sqlEditrequest .=" DATE_FORMAT(EmployDate, '%Y') as st_y,DATE_FORMAT(EmployDate, '%c') as st_m,DATE_FORMAT(EmployDate, '%e') as st_d ";
    $sqlEditrequest .=" FROM `v_request_form` WHERE RequestID=$RequestID";
    $roweRequest=mysqli_fetch_array(mysqli_query($condb,$sqlEditrequest));
    $sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM `allvars` WHERE `FieldName` = 'RoomType'and FieldCode !=4 and FieldCode !=5 and FieldCode !=6 ORDER BY ValueE";
    $resRoomType=mysqli_query($condb,$sqlRoomType);
 ?>
<div class="container box" style="margin-top: 10px">
    <div id="formbox-w" class="formbox-w" >
    <lable id="box-formreq">
        <div class="heFCSS">
            <b style="font-size:1.1em;">แบบฟอร์มขอรับการจัดสรรที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</b>
        </div>
        <form id="FromRqs" name="FromRqs" onsubmit="if(chvalformrequest()) return formRequeset();else return false;"  class="formrq" method="post">
            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7 right" id="typediv" style="border: 1px solid #f49c93;background:#f7eded;border-radius:10px;padding:8px; ">
                    <?php while($rowRoomType=mysqli_fetch_array($resRoomType)){ ?>
                        <input type="radio" name="RoomtypeID" value="<?=$rowRoomType['FieldCode'];?>" 
                        <?php if($roweRequest['RoomType']==$rowRoomType['FieldCode']){echo "checked";} ?>>
                        <?= $rowRoomType['ValueT']; if($rowRoomType['ValueE']==2){ ?>
                            <br>
                        <?php } ?>
                    <?php } ?>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq" style="margin-top: 2px;">
                        <label class="label-title">เลขบัตรประชาชน / PassportNo *</label>
                        <input type="checkbox" name="isforener" style="margin-top:4px;" onclick="isvalidID=false;" id="isforener"><label class="namecheckbox">ชาวต่างชาติ</label>
                        <input style="margin-top: 6px;" value="<?=$roweRequest['SocialID'];?>" type="text" id="SocialID" name="SocialID" onchange="if(chkPinID(this,document.FromRq.isforener.checked)){checkSoID(this.value); return true;}" placeholder="เลขบัตรประชาชน / PassportNo">
                    </div>
                </div> 
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="boxfq">
                        <input type="hidden" name="RequestID" id="RequestID" value="<?=$RequestID?>">
                        <label class="label-title">คำนำหน้าชื่อ *</label>
                        <input type="text" name="PName" id="stn" value="<?=$roweRequest['PName']?>" placeholder="คำนำหน้าชื่อ.">
                    </div>
                </div>
                <div class="col-5">
                    <div class="boxfq">
                        <label for="" class="label-title">ชื่อ *</label>
                        <input type="text" name="Name" value="<?=$roweRequest['Name']?>" placeholder="กรุณากรอกชื่อ.">
                    </div>
                </div>
                <div class="col-5">
                    <div class="boxfq">
                        <label for="" class="label-title">นามสกุล *</label>    
                        <input type="text" name="Surname" value="<?=$roweRequest['Surname']?>" placeholder="กรุณากรอกนามสกุล.">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <label class="label-title">ตำแหน่ง *</label>
                        <select name="PositionID" class="select-option">
							<option value="0" disabled selected>เลือกตำแหน่ง.</option>
							<?php
							$sql = "SELECT * FROM position ";
							$res = mysqli_query($condb,$sql);
							 while ($row = mysqli_fetch_array($res)) { ?>
								<option value="<?php echo $row['PositionID']; ?>" <?php if($roweRequest['PositionID']==$row['PositionID']){echo "selected";} ?>><?php echo $row['PositionName']; ?></option>
							<?php } ?>
						</select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">สังกัด/คณะ *</label>
                        <select name="FacID" class="select-option" onchange="fac(this.options[this.selectedIndex].value);savesVl(this.name, this.options[this.selectedIndex].value);">
							<option value="0" disabled selected>เลือกสังกัด/คณะ.</option>
							<?php
							$sqlfa = "SELECT * FROM faculty ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_array($resfa)) { ?>
							<option value="<?php echo $rowfa['FacID']; ?>" <?php if($roweRequest['FacID']==$rowfa['FacID']){echo "selected";} ?>><?php echo $rowfa['FacNameT']; ?></option>
							<?php } ?>
						</select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">ภาควิชา </label>
                        <lable id="DeptIDlable">
							<select  class="select-option" name="DeptID">
								<option value="0" disabled >เลือกรหัสภาควิชา.</option>
							</select>
						</lable>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="boxfq">
                        <label class="label-title">ประเภทบุคลากร *</label>
                        <input type="radio" name="PersonnelType" onclick="shownotics(0)" value="1" <?php if($roweRequest['PersonnelType']==1){echo "checked";} ?>> ข้าราชการ
                        <input type="radio" name="PersonnelType" onclick="shownotics(0)" value="2" <?php if($roweRequest['PersonnelType']==2){echo "checked";} ?>> พนักงานมหาวิทยาลัย
                        <input type="radio" name="PersonnelType" onclick="shownotics(0)" value="3" <?php if($roweRequest['PersonnelType']==3){echo "checked";} ?>> ลูกจ้างประจำ
                        <input type="radio" name="PersonnelType" onclick="shownotics(1)" value="4" <?php if($roweRequest['PersonnelType']==4){echo "checked";} ?>> กรณีคณะ/สำนัก /หน่วยงาน ยื่นขอเพื่อ <label style="color:red;">(*ระบุเหตุผล/ความจำเป็น)</label>
                    </div>
                </div>
            </div>
            <div id="notics">
                <div class="col-12" style="padding:0px 20px;">
                    <textarea name="Notics" id="Notics" class="col-12" rows="3" placeholder="ระบุเหตุผล/ความจำเป็น"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq">
                        <label class="label-title">สิทธิในการเบิกค่าเช่าบ้าน หรือเช่าซื้อบ้าน *</label>
                        <input type="radio" name="RightClaim" onclick="rights(1)" value="1" <?php if($roweRequest['RightClaim']==1){echo "checked";} ?>> มี
                        <input type="radio" name="RightClaim" onclick="rights(0)" value="0" <?php if($roweRequest['RightClaim']==0){echo "checked";} ?>> ไม่มี
                    </div>
                </div>
                <div id="rights" class="col-6">
                    <div class="boxfq">
                        <label class="label-title">กรณีมีสิทธิ ปัจจุบัน *</label>
                        <input type="radio" name="RepaymentRight" value="1" <?php if($roweRequest['RepaymentRight']==1){echo "checked";} ?>> ใช้สิทธิ
                        <input type="radio" name="RepaymentRight" value="0" <?php if($roweRequest['RepaymentRight']==0){echo "checked";} ?>> ไม่ใช้สิทธิ
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="boxfq">
                        <label class="label-title">สถานภาพ *</label>
                        <div style="padding:0px 50px">
                            <input type="radio" name="MaritalStatus" value="1" <?php if($roweRequest['MaritalStatus']==1){echo "checked";} ?>> โสด
                        </div>
                        <div style="padding:0px 50px">
                            <input type="radio" name="MaritalStatus" value="2" <?php if($roweRequest['MaritalStatus']==2){echo "checked";} ?>> สมรส (คู่สมรสเป็นบุคลากรและปฏิบัติงานในมหาวิทยลัยฯ)
                        </div>
                        <div style="padding:0px 50px">
                            <input type="radio" name="MaritalStatus" value="4" <?php if($roweRequest['MaritalStatus']==3){echo "checked";} ?>> สมรส (คู่สมรสไม่ได้ปฏิบัติงานในมหาวิทยลัยฯ)
                        </div>
                        <div style="padding:0px 50px"><input type="radio" name="status" value="3" <?php if($roweRequest['MaritalStatus']==3){echo "checked";} ?>> หย่า </div>
                    </div>
                </div>
                <div class="col-5 center">
                    <div style="border: 1px solid #f49c93;background:#f7eded;border-radius:10px;padding:8px; ">
                        <label style="color:#FF0800;"><b>กรณีที่ประสบภัยธรรมชาติ (ให้คลิกเลือก)</b></label><br>
                            <input type="checkbox" style="margin-top: 4px;" value="1" <?=($roweRequest['DissaterEffect']==1)?"checked":""?> name="DissaterEffect" id="DissaterEffect">
                            <label class="namecheckbox">ประสบภัยธรรมชาติ</label>
                    </div>
                </div>
            </div>
            <label for="" class="label-title">ที่พักอาศัยปัจจุบัน *</label>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">จังหวัด *</label>
                        <select name="CurProvinceID" id="CurProvinceID" class="select-option" onchange="province(this.options[this.selectedIndex].value,'Cur');savesVl(this.name, this.options[this.selectedIndex].value);">
							<option value="0" disabled >เลือกจังหวัด</option>
							<?php
							$sqlfa = "SELECT * FROM province ORDER BY ProvinceNameT desc ,CONVERT(ProvinceNameT USING tis620) ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_array($resfa)) { ?>
							<option value="<?=$rowfa['ProvinceID']; ?>" <?php if($roweRequest['CurProvinceID']==$rowfa['ProvinceID']){echo "selected";}?>><?php echo $rowfa['ProvinceNameT']; ?></option>
							<?php } ?>
						</select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">อำเภอ *</label>
                        <!-- <lable id="CurCityIDlable"> -->
						<!-- <select  name="CurCityID" id="CurCityID" class="select-option">
							<option value="0" disabled selected>เลือกอำเภอ</option>
						</select> -->
                        <!-- </lable> -->
                        <?php
                            // echo "<lable id=\"CurCityIDlable\"></lable>";
                            echo "<select name=\"CurCityID\" id=\"CurCityID\" class=\"select-option\" onchange=\"city(this.options[this.selectedIndex].value,'Cur');savesVl(this.name, this.options[this.selectedIndex].value);\">";
                                $sqlfa = "SELECT * FROM city where ProvinceID=$roweRequest[CurProvinceID] ORDER BY CityNameT ASC";
                                $resfa = mysqli_query($condb,$sqlfa);
                                while ($rowfa = mysqli_fetch_array($resfa)) { 
                                echo "<option value=\"".$rowfa['CityID']."\" ";
                                if($rowfa['CityID']==$roweRequest['CurCityID']){echo "selected";}
                                echo " >".$rowfa['CityNameT']."</option>";
                                }
                            echo '</select> '; 
                        ?>
                        
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">ตำบล *</label>
                        <!-- <lable id="CurDistrictIDlable">
						<select id="CurDistrictID" name="CurDistrictID" class="select-option">
							<option value="0" disabled selected>เลือกตำบล</option>
						</select>
                        </lable> -->
                        <?php 
                        // echo '<lable id="CurDistrictIDlable"></lable>';
                        echo "<select name=\"CurDistrictID\" id=\"CurDistrictID\"  class=\"select-option\" onchange=\"savesVl(this.name, this.options[this.selectedIndex].value);\">";
                        echo "<option value=\"0\" >เลือกตำบล</option>";
                            $sqlfa = "SELECT * FROM district WHERE CityID=$roweRequest[CurCityID] ORDER BY DistrictNameT ASC";
                            $resfa = mysqli_query($condb,$sqlfa);
                            while ($rowci = mysqli_fetch_array($resfa)) { 
                            echo '<option value="'.$rowci['DistrictID'].'" ';
                            if($rowci['DistrictID']==$roweRequest['CurDistrictID']){echo "selected";}
                            echo '>' .$rowci['DistrictNameT'].'</option>';
                            }
                        echo '</select> ';
                        ?>
                    </div>
                </div>
            </div>
            <label for="" class="label-title">ที่อยู่ตามทะเบียนบ้าน *</label>
            <div class="row">
                <div class="col-12">
                    <div class="boxfq">
                        <label class="label-title">บ้านเลขที่ หมู่ที่ *</label>
                        <input type="text" name="Address" value="<?=$roweRequest['Address'];?>" placeholder="123 ชื่อบ้าน ซอย 4 ถนน...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">จังหวัด *</label>
                        <select name="ProvinceID" id="ProvinceID" class="select-option" onchange="province(this.options[this.selectedIndex].value,''); savesVl(this.name, this.options[this.selectedIndex].value);">
							<option value="0" disabled selected>เลือกจังหวัด</option>
							<?php
							$sqlfa = "SELECT * FROM `province` ORDER BY `ProvinceNameT` desc ,CONVERT(`ProvinceNameT` USING tis620) ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_array($resfa)) { ?>
							<option value="<?= $rowfa['ProvinceID']; ?>" <?php if($roweRequest['ProvinceID']==$rowfa['ProvinceID']){echo "selected";} ?>><?php echo $rowfa['ProvinceNameT']; ?></option>
							<?php } ?>
						</select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">อำเภอ *</label>
                        <!-- <lable id="CityIDlable">
						<select id="CityID" name="CityID" class="select-option">
							<option value="0" disabled >เลือกอำเภอ</option>
						</select>
						</lable> -->
                        <?php
                        // echo '<lable id="CityIDlable">';
                        // echo '</lable>';
                            echo "<select name=\"CityID\" id=\"CityID\" class=\"select-option\" onchange=\"city(this.options[this.selectedIndex].value,'');savesVl(this.name, $roweRequest[CityID]);\">";
                                $sqlfa = "SELECT * FROM city where ProvinceID=$roweRequest[ProvinceID] ORDER BY CityNameT ASC";
                                $resfa = mysqli_query($condb,$sqlfa);
                                while ($rowfa = mysqli_fetch_array($resfa)) { 
                                echo "<option value=\"".$rowfa['CityID']."\" ";
                                if($rowfa['CityID']==$roweRequest['CityID']){echo "selected";}
                                echo " >".$rowfa['CityNameT']."</option>";
                                }
                            echo '</select> '; 
                        ?>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <label for="" class="label-title">ตำบล *</label>
                        <!-- <lable id="DistrictIDlable">
						<select id="DistrictID" name="DistrictID" class="select-option">
							<option value="0" disabled >เลือกตำบล</option>
						</select>
						</lable> -->
                        <?php 
                        // echo '<lable id="DistrictIDlable"> </lable>';
                        echo "<select name=\"DistrictID\" id=\"DistrictID\"  class=\"select-option\" onchange=\"savesVl(this.name, this.options[this.selectedIndex].value);\">";
                        echo "<option value=\"0\" >เลือกตำบล</option>";
                            $sqlfa = "SELECT * FROM district WHERE CityID=$roweRequest[CityID] ORDER BY DistrictNameT ASC";
                            $resfa = mysqli_query($condb,$sqlfa);
                            while ($rowci = mysqli_fetch_array($resfa)) { 
                            echo '<option value="'.$rowci['DistrictID'].'" ';
                            if($rowci['DistrictID']==$roweRequest['DistrictID']){echo "selected";}
                            echo '>' .$rowci['DistrictNameT'].'</option>';
                            }
                        echo '</select>';
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq">
                        <label class="label-title">จำนวนบุตร *</label>
                        <input type="number" name="ChildrenCount" value="<?=$roweRequest['ChildrenCount']; ?>" placeholder="จำนวนบุตร.">
                    </div>
                </div>
                <div class="col-6">
                    <div class="boxfq">
                        <label class="label-title">วันที่บรรจุเข้าปฏิบัติงานในมหาวิทยาลัยฯ *</label><br>
                        <?php echo dateselect($roweRequest['st_d'],'st_d',22); ?>
                        <?php echo monthselect($roweRequest['st_m'],'st_m',50); ?>
                        <?php echo yearselect($roweRequest['st_y'],'st_y',1987,date("Y"),25,''); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq" style="line-height: 31px;">
                        <label class="label-title">วันเดือนปีเกิด *</label><br>
                        <?php echo dateselect($roweRequest['bi_d'],'bi_d',22); ?>
                        <?php echo monthselect($roweRequest['bi_m'],'bi_m',50); ?>
                        <?php echo yearselect($roweRequest['bi_y'],'bi_y',date("Y",strtotime('-60 year')),date("Y",strtotime('-18 year')),25,''); ?>
                        <input type="hidden" name="RequestDate" id="RequestDate" value="<?=$roweRequest['RequestDate'];?>">
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="alr">
                    <button type="submit" class="btn-add"><i class="icons nextrigth nameicon"></i> ถัดไป</button>
                </div>
            </div><br>
        </form>
    </div>
    </span>
</div>

<?php 
include 'function/formmodals.php';
include 'inc/footer.php'; 
?>