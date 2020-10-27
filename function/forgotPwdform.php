<?php include './connectDB.php';
$UserID=$_POST['UserID'];
$member="SELECT UserID,UserLogin,SocialID FROM members WHERE UserLogin='$UserID' OR SocialID='$UserID' ";
$getMb=mysqli_fetch_assoc(mysqli_query($condb,$member));
if($getMb['UserID']>0){
    echo "1".chr(5).'<div style="width: 90%;">
            <lable class="f-left">รหัสผ่านใหม่ *</lable>
                <input id="Pwd1" type="password">
          </div>
          <div style="width: 90%;">
            <lable class="f-left">ยื่นยันรหัสผ่าน *</lable>
                <input id="Pwd2" onchange="return confPwd();" type="password">
            </div>
            <button type="submit" onclick="return SavePwd();" class="btn-exportexcle"><i
            class="icons save nameicon"></i> บันทึกรหัสผ่าน</button>
            <button type="button" onclick="return chUserID(0,1);" class="btn-red"><i
            class="icons redo nameicon"></i> รีเซ็ตข้อมูล</button>';
            
}else{
    echo 2;
}
?>
