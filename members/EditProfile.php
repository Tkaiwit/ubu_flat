<?php include '../function/connectDB.php';
$getmembers="SELECT * FROM v_members WHERE UserID=$_POST[UserID]";
$resmembers=mysqli_fetch_assoc(mysqli_query($condb,$getmembers));
$lvC=$resmembers['LivingCount'];
?>
<div class="container mt10">
    <div class="row ">
        <div class="col-7 " style="padding-right: 17px;">
            <b>ข้อมูลส่วนตัว</b>
            <form class="formeditProfile" method="post" id="editProfileForm"
                onsubmit="if(chvalEditProfile()) SaveProfile();else return false;">
                <div class="row">
                    <div class="col-2">
                        <label id="label-title">คำนำหน้า *</label>
                        <div class="mr-ml">
                            <input type="text" name="UserPNameT" id="UserPNameT" value="<?=$resmembers['UserPNameT'];?>"
                                placeholder="คำนำหน้า">
                        </div>
                    </div>
                    <div class="col-5">
                        <label id="label-title">ชื่อ *</label>
                        <div class="mr-ml">
                            <input type="text" name="UserNameT" id="UserNameT" value="<?=$resmembers['UserNameT']?>"
                                placeholder="ชื่อ">
                        </div>
                    </div>
                    <div class="col-5">
                        <label id="label-title">นามสุกล *</label>
                        <div class="mr-ml">
                            <input type="text" name="UserSNameT" id="UserSNameT" value="<?=$resmembers['UserSNameT']?>"
                                placeholder="นามสุกล">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label id="label-title">สังกัด/คณะ *</label>
                        <div class="mr-ml">
                            <select name="FacID" class="select-option"
                                onchange="fac(this.options[this.selectedIndex].value);">
                                <option value="" disabled selected>เลือกสังกัด/คณะ.</option>
                                <?php
							$sqlfa = "SELECT * FROM faculty ";
							$resfa = mysqli_query($condb,$sqlfa);
							while ($rowfa = mysqli_fetch_array($resfa)) { 
                            echo "<option value=\"$rowfa[FacID]\" ";
                            if($resmembers['FacID']==$rowfa['FacID']){echo "selected";}
                            echo " >$rowfa[FacNameT]</option>";
                         } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label id="label-title" for="" class="label-title">ภาควิชา </label>
                        <div class="mr-ml">
                            <lable id="DeptIDlable">
                                <?php if($_POST['UserID']>0){
                            echo "<select class=\"select-option\" name=\"DeptID\">";
                            echo "<option value=\"0\" disabled>เลือกรหัสภาควิชา.</option>";
                            while($rowDep=mysqli_fetch_assoc($resDep)){
                                echo "<option value=\"$rowDep[DeptID]\" ";
                                if($resmembers['DeptID']==$rowDep['DeptID']){echo "selected";}
                                echo " >$rowfa[DeptNameT]</option>";
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
                <div class="mt10 mb10">
                    <b>ข้อมูลติดต่อ</b>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label id="label-title">อีเมล์ *</label>
                        <div class="mr-ml">
                            <input type="email" name="email" id="email" placeholder="อีเมล์"
                                value="<?=$resmembers['Email'];?>" />
                        </div>
                    </div>
                    <div class="col-6">
                        <label id="label-title">มือถือ</label>
                        <div class="mr-ml">
                            <input type="text" name="phone" id="phone" placeholder="มือถือ" maxlength="10"
                                value="<?=$resmembers['Phone'];?>">
                        </div>
                    </div>
                </div>
                <div class="mt10">
                    <div class="center">
                        <button type="submit" class="btn-add"><i class="icons save nameicon"></i>อัพเดตข้อมูล</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-5" style="border-left:1px dashed #000; padding-left: 17px;">
            <b>เปลี่ยนรหัสผ่าน</b>
            <form action="" method="post">
                <div class="row">
                    <div class="col-12">
                        <label id="label-title">รหัสผ่านใหม่ *</label>
                        <div class="mr-ml">
                            <input type="password" onchange="changePassword(this.value)" name="Password" id="Password" placeholder="รหัสผ่านใหม่">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <label id="label-title">ยืนยันรหัสผ่านใหม่</label>
                        <div class="mr-ml">
                            <input type="password" onchange="changePassword(document.getElementById('Password').value,this.value)" name="confPassword" id="confPassword" placeholder="รหัสผ่านใหม่">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span id="warningeditprofile"></span>
                    </div>
                </div>
                <div class="mt10">
                    <div class="center" id="btnshoweditprofile">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>