<?php $formRq=1; include "inc/toptitle.php"; include 'function/date.php';include 'function/connectDB.php';
    // $sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode =>3 ORDER BY ValueE";
    $sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode !=4 and FieldCode !=5 and FieldCode !=6 ORDER BY ValueE";
    $resRoomType=mysqli_query($condb,$sqlRoomType);
 ?>
<div class="container box" style="margin-top: 10px">
    <div id="formbox-w" class="formbox-w">
        <span id="box-formreq">
        <div class="heFCSS">
            <b style="font-size:1.1em;">แบบฟอร์มขอรับการจัดสรรที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</b><br>
        </div>
        <form id="FromRqs" name="FromRqs" onsubmit="if(chvalformrequest()) return formRequeset();else return false;" class="formrq" method="post">
            <div class="row">
                <div class="col-5">
                </div>
                <div class="col-7" id="typediv" style="border: 1px solid #f49c93;background:#f7eded;border-radius:10px;padding:8px; ">
                    <div class="row f-right">
                        <?php while($rowRoomType=mysqli_fetch_assoc($resRoomType)){ ?>
                        <input type="radio" id="RoomtypeID<?=$rowRoomType['FieldCode'];?>" name="RoomtypeID" value="<?=$rowRoomType['FieldCode'];?>">
                        <label for="RoomtypeID<?=$rowRoomType['FieldCode'];?>" class="nameradio"><?= $rowRoomType['ValueT'];?></label>
                        <?php if($rowRoomType['ValueE']==2){ ?>
                    </div>
                    <div class="row f-right">
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq" style="margin-top: 2px;">
                        <lable class="label-title">เลขบัตรประชาชน / PassportNo *</lable>
                        <input type="checkbox" name="isforener" style="margin-top: 4px;" onclick="isvalidID=false;"
                            id="isforener">
                        <label for="isforener" class="namecheckbox">ชาวต่างชาติ</label>
                        <input style="margin-top: 6px;" type="text" id="SocialID" name="SocialID" maxlength="13"
                            onchange="if(chkPinID(this,document.FromRqs.isforener.checked)){checkSoID(this.value); return true;}"
                            placeholder="เลขบัตรประชาชน / PassportNo">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="boxfq">
                        <input type="hidden" name="RequestID" id="RequestID" value="">
                        <lable class="label-title">คำนำหน้าชื่อ *</lable>
                        <input type="text" name="PName" maxlength="8" id="stn" placeholder="คำนำหน้าชื่อ.">
                    </div>
                </div>
                <div class="col-5">
                    <div class="boxfq">
                        <lable for="" class="label-title">ชื่อ *</lable>
                        <input type="text" name="Name" maxlength="30" placeholder="กรุณากรอกชื่อ.">
                    </div>
                </div>
                <div class="col-5">
                    <div class="boxfq">
                        <lable for="" class="label-title">นามสกุล *</lable>
                        <input type="text" name="Surname" maxlength="30" placeholder="กรุณากรอกนามสกุล.">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <lable class="label-title">ตำแหน่ง *</lable>
                        <select name="PositionID" class="select-option">
                            <option value="0" default selected>เลือกตำแหน่ง.</option>
                            <?php
							$sql = "SELECT * FROM position ";
							$res = mysqli_query($condb,$sql);
							 while ($row = mysqli_fetch_assoc($res)) { ?>
                            <option value="<?php echo $row['PositionID']; ?>"><?php echo $row['PositionName']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">สังกัด/คณะ *</lable>
                        <select name="FacID" class="select-option"
                            onchange="fac(this.options[this.selectedIndex].value);savesVl(this.name, this.options[this.selectedIndex].value);">
                            <option value="" disabled selected>เลือกสังกัด/คณะ.</option>
                            <?php
							$sqlfa = "SELECT * FROM faculty ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_assoc($resfa)) { ?>
                            <option value="<?php echo $rowfa['FacID']; ?>"><?php echo $rowfa['FacNameT']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">ภาควิชา </lable>
                        <lable id="DeptIDlable">
                            <select class="select-option" name="DeptID">
                                <option value="0" disabled>เลือกรหัสภาควิชา.</option>
                            </select>
                        </lable>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="boxfq">
                        <div class="row">
                            <lable class="label-title">ประเภทบุคลากร *</lable>
                                <input type="radio" id="PersonnelType1" name="PersonnelType" onclick="shownotics(0)" value="1">
                                <label for="PersonnelType1" class="nameradio"> ข้าราชการ</label>
                                <input type="radio" id="PersonnelType2" name="PersonnelType" onclick="shownotics(0)" value="2" checked>
                                <label for="PersonnelType2" class="nameradio"> พนักงานมหาวิทยาลัย</label>
                                <input type="radio" id="PersonnelType3" name="PersonnelType" onclick="shownotics(0)" value="3">
                                <label for="PersonnelType3" class="nameradio">ลูกจ้างประจำ</label>
                                <input type="radio" id="PersonnelType4" name="PersonnelType" onclick="shownotics(1)" value="4">
                                <label for="PersonnelType4" class="nameradio"> กรณีคณะ/สำนัก/หน่วยงาน ยื่นขอเพื่อ
                                    <label style="color:red;">(*ระบุเหตุผล/ความจำเป็น)</label>
                                </label>
                        </div>
                    </div>
                </div>
            </div>
            <div id="notics">
                <div class="col-12" style="padding:0px 20px;">
                    <textarea name="Notics" id="Notics" class="col-12" rows="3"
                        placeholder="ระบุเหตุผล/ความจำเป็น"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq">
                        <div class="row">
                                <lable class="label-title">สิทธิในการเบิกค่าเช่าบ้าน หรือเช่าซื้อบ้าน </lable>
                                <input type="radio" id="RightClaim1" name="RightClaim" onclick="rights(1)" value="1">
                                <label for="RightClaim1" class="nameradio"> มี</label>
                                <input type="radio" id="RightClaim0" name="RightClaim" onclick="rights(0)" value="0" checked>
                                <label for="RightClaim0" class="nameradio">ไม่มี</label>
                        </div>
                    </div>
                </div>
                <div id="rights" class="col-6">
                    <div class="boxfq">
                        <div class="row">
                                <lable class="label-title">กรณีมีสิทธิ ปัจจุบัน *</lable>
                                <input type="radio" id="RepaymentRight1" name="RepaymentRight" value="1">
                                <label for="RepaymentRight1" class="nameradio">ใช้สิทธิ</label>
                                <input type="radio" id="RepaymentRight0" name="RepaymentRight" value="0" checked>
                                <label for="RepaymentRight0" class="nameradio">ไม่ใช้สิทธิ</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-7">
                    <div class="boxfq">
                        <lable class="label-title">สถานภาพ *</lable>
                        <div style="padding:0px 40px">
                            <input type="radio" id="MaritalStatus1" name="MaritalStatus" value="1" checked>
                            <label for="MaritalStatus1" class="namelistradio">โสด</label>
                        </div>
                        <div style="padding:0px 40px">
                            <input type="radio" id="MaritalStatus2" name="MaritalStatus" value="2">
                            <label for="MaritalStatus2" class="namelistradio">สมรส (คู่สมรสเป็นบุคลากรและปฏิบัติงานในมหาวิทยลัยฯ)</label>
                        </div>
                        <div style="padding:0px 40px">
                            <input type="radio" id="MaritalStatus3" name="MaritalStatus" value="4">
                            <label for="MaritalStatus3" class="namelistradio">สมรส (คู่สมรสไม่ได้ปฏิบัติงานในมหาวิทยลัยฯ)</label>

                        </div>
                        <div style="padding:0px 40px">
                            <input type="radio" id="MaritalStatus4" name="MaritalStatus" value="3">
                            <label for="MaritalStatus4" class="namelistradio">หย่า</label>
                        </div>
                    </div>
                </div>
                <div class="col-5 center">
                    <div style="border: 1px solid #f49c93;background:#f7eded;border-radius:10px;padding:8px; ">
                        <label style="color:#FF0800;"><b>กรณีที่ประสบภัยธรรมชาติ (ให้คลิกเลือก)</b></label><br>
                        <input type="checkbox" style="margin-top: 4px;" value="1" name="DissaterEffect" id="DissaterEffect">
                        <label for="DissaterEffect" class="namecheckbox">ประสบภัยธรรมชาติ</label>
                    </div>
                </div>
            </div>
            <label for="" class="label-title">ที่พักอาศัยปัจจุบัน *</label>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">จังหวัด *</lable>
                        <select name="CurProvinceID" id="CurProvinceID" class="select-option"
                            onchange="province(this.options[this.selectedIndex].value,'Cur');savesVl(this.name, this.options[this.selectedIndex].value);">
                            <option value="0" disabled selected>เลือกจังหวัด</option>
                            <?php
							$sqlfa = "SELECT * FROM province ORDER BY ProvinceNameT desc ,CONVERT(ProvinceNameT USING tis620) ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_assoc($resfa)) { ?>
                            <option value="<?php echo $rowfa['ProvinceID']; ?>"><?php echo $rowfa['ProvinceNameT']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">อำเภอ *</lable>
                        <lable id="CurCityIDlable">
                            <select name="CurCityID" id="CurCityID" class="select-option">
                                <option value="0" disabled selected>เลือกอำเภอ</option>
                            </select>
                        </lable>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">ตำบล *</lable>
                        <lable id="CurDistrictIDlable">
                            <select id="CurDistrictID" name="CurDistrictID" class="select-option">
                                <option value="0" disabled selected>เลือกตำบล</option>
                            </select>
                        </lable>
                    </div>
                </div>
            </div>
            <label for="" class="label-title">ที่อยู่ตามทะเบียนบ้าน *</label>
            <div class="row">
                <div class="col-12">
                    <div class="boxfq">
                        <lable class="label-title">บ้านเลขที่ หมู่ที่ *</lable>
                        <input type="text" maxlength="191" name="Address" placeholder="123 ชื่อบ้าน ซอย 4 ถนน...">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">จังหวัด *</lable>
                        <select name="ProvinceID" id="ProvinceID" class="select-option"
                            onchange="province(this.options[this.selectedIndex].value,''); savesVl(this.name, this.options[this.selectedIndex].value);">
                            <option value="0" disabled selected>เลือกจังหวัด</option>
                            <?php
							$sqlfa = "SELECT * FROM province ORDER BY ProvinceNameT desc ,CONVERT(ProvinceNameT USING tis620) ";
							$resfa = mysqli_query($condb,$sqlfa);
							 while ($rowfa = mysqli_fetch_assoc($resfa)) { ?>
                            <option value="<?php echo $rowfa['ProvinceID']; ?>"><?php echo $rowfa['ProvinceNameT']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">อำเภอ *</lable>
                        <lable id="CityIDlable">
                            <select id="CityID" name="CityID" class="select-option">
                                <option value="0" disabled>เลือกอำเภอ</option>
                            </select>
                        </lable>
                    </div>
                </div>
                <div class="col-4">
                    <div class="boxfq">
                        <lable for="" class="label-title">ตำบล *</lable>
                        <lable id="DistrictIDlable">
                            <select id="DistrictID" name="DistrictID" class="select-option">
                                <option value="0" disabled>เลือกตำบล</option>
                            </select>
                        </lable>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <div class="boxfq">
                        <lable class="label-title">จำนวนบุตร *</lable>
                        <input type="number" maxlength="2" name="ChildrenCount" placeholder="จำนวนบุตร.">
                    </div>
                </div>
                <div class="col-4"></div>
                <div class="col-6">
                    <div class="boxfq">
                        <lable class="label-title">วันที่บรรจุเข้าปฏิบัติงานในมหาวิทยาลัยฯ *</lable><br>
                        <?php echo dateselect(0,'st_d',22); ?>
                        <?php echo monthselect(0,'st_m',50,''); ?>
                        <?php echo yearselect(0,'st_y',1987,date("Y"),25,''); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="boxfq" style="line-height: 31px;">
                        <lable class="label-title">วันเดือนปีเกิด *</lable><br>
                        <?php echo dateselect(0,'bi_d',22); ?>
                        <?php echo monthselect(0,'bi_m',50,''); ?>
                        <?php echo yearselect(0,'bi_y',date("Y",strtotime('-60 year')),date("Y",strtotime('-18 year')),25,''); ?>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="alr">
                    <button type="submit" class="btn-add"><i class="icons nextrigth nameicon"></i> ถัดไป</button>
                </div>
            </div><br>
        </form>
        </span>
    </div>
</div>
<?php 
include 'function/formmodals.php';
include 'inc/footer.php'; 
?>