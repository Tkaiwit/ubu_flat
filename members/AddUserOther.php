<?php include '../function/connectDB.php';  include '../function/date.php';
$sqlusertype="SELECT * FROM allvars WHERE TableName='members' AND FieldName='UserType' AND FieldCode IN(2,3,4,5,6,7)";
$resusertype=mysqli_query($condb,$sqlusertype);

$UserID=$_POST['UserID'];
if($UserID!=0){
$member="SELECT * FROM members WHERE UserID=$UserID";
$Getmember=mysqli_fetch_assoc(mysqli_query($condb,$member));

$Department="SELECT * FROM department WHERE FacID=$Getmember[FacID]";
$resDep=mysqli_query($condb,$Department);
}
?>
<div class="modal-st">
    <form id="formAddUserOther" method="post" onsubmit="if(chvalSUO()) SaveUserOther();else return false;">
        <div class="row">
            <div class="mt10 col-6">
                <label>รหัสผู้ใช้ *</label>
                <div class="mr-ml">
                    <input type="text" name="UserLogin" id="UserLogin"  placeholder="รหัสผู้ใช้" value="<?=($UserID!=0)?$Getmember['UserLogin']:"";?>">
                </div>
            </div>
            <?php if($UserID==0){?>
            <div class="mt10 col-6">
                <label>รหัสผ่าน *</label>
                <div class="mr-ml">
                    <input type="password" name="Password" id="Password"  placeholder="รหัสผ่าน">
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="mt10 col-6">
                <label>เลขบัตรประจำตัวประชาชน</label>
                <div class="mr-ml">
                    <input type="text" name="SocialID" id="SocialID" placeholder="ระบุหรือไม่ระบุก็ได้" value="<?=($UserID!=0)?$Getmember['SocialID']:"";?>">
                </div>
            </div>
            <div class="mt10 col-6">
                <label>อีเมล์ *</label>
                <div class="mr-ml">
                    <input type="email" name="Email" id="Email"  placeholder="อีเมล์" value="<?=($UserID!=0)?$Getmember['Email']:"";?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mt10 col-2">
                <label>คำนำหน้า *</label>
                <div class="mr-ml">
                    <input type="text" name="UserPNameT" id="UserPNameT" placeholder="คำนำหน้า" value="<?=($UserID!=0)?$Getmember['UserPNameT']:"";?>">
                </div>
            </div>
            <div class="mt10 col-5">
                <label>ชื่อ *</label>
                <div class="mr-ml">
                    <input type="text" name="UserNameT" id="UserNameT" placeholder="ชื่อ" value="<?=($UserID!=0)?$Getmember['UserNameT']:"";?>">
                </div>
            </div>
            <div class="mt10 col-5">
                <label>นามสุกล *</label>
                <div class="mr-ml">
                    <input type="text" name="UserSNameT" id="UserSNameT" placeholder="นามสุกล" value="<?=($UserID!=0)?$Getmember['UserSNameT']:"";?>">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mt10 col-6">
                <label>สังกัด/คณะ *</label>
                <div class="mr-ml">
                    <select id="FacID" name="FacID" class="select-option" onchange="fac(this.options[this.selectedIndex].value);">
                        <option value="0">เลือกสังกัด/คณะ.</option>
                        <?php
							$sqlfa = "SELECT * FROM faculty ";
							$resfa = mysqli_query($condb,$sqlfa);
							while ($rowfa = mysqli_fetch_array($resfa)) { 
                            echo "<option value=\"$rowfa[FacID]\" ";
                            if($Getmember['FacID']==$rowfa['FacID']){ echo "selected ";}
                            echo " >$rowfa[FacNameT]</option>";
                         } ?>
                    </select>
                </div>
            </div>
            <div class="mt10 col-6">
                <label for="" class="label-title">ภาควิชา </label>
                <div class="mr-ml">
                    <lable id="DeptIDlable">
                        <?php if($_POST['UserID']>0){
                            echo "<select class=\"select-option\" name=\"DeptID\">";
                            echo "<option value=\"0\" disabled>เลือกรหัสภาควิชา.</option>";
                            while($rowDep=mysqli_fetch_assoc($resDep)){
                                echo "<option value=\"$rowDep[DeptID]\" ";
                                if($Getmember['DeptID']==$rowDep['DeptID']){ echo "selected ";}
                                echo " >$rowDep[DeptNameT]</option>";
                            }
                            echo "</select>";
                        }else { ?>

                        <select class="select-option" name="DeptID">
                            <option value="0" disabled>เลือกรหัสภาควิชา.</option>
                        </select>
                        <?php } ?>
                    </lable>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="mt10 mb10 col-6">
                <label class="label-title">ตำแหน่ง *</label>
                <div class="mr-ml">
                    <select id="PositionID" name="PositionID" class="select-option">
                        <option value="0" >เลือกตำแหน่ง.</option>
                        <?php
							$sql = "SELECT * FROM position ";
							$res = mysqli_query($condb,$sql);
							 while ($row = mysqli_fetch_array($res)) {
                                echo "<option value=\"$row[PositionID]\" ";
                                echo " >$row[PositionName]</option>"; 
                         } ?>
                    </select>
                </div>
            </div>
            <div class="mt10 mb10 col-6">
                <div class="mr-ml">
                    <label>ประเภทผู้ใช้งาน *</label>
                    <select name="UserType" id="UserType">
                        <option value="0">เลิอกประเภทผู้ใช้งาน</option>
                        <?php while ($rowusertype = mysqli_fetch_assoc($resusertype)) { 
                                echo "<option value=\"$rowusertype[FieldCode]\" ";
                                echo " >$rowusertype[ValueT]</option>"; 
                        ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="center">
            <button type="submit" class="btn-add"><i class="icons save nameicon"></i>บันทึกข้อมูล</button>
        </div>
    </form>
</div>