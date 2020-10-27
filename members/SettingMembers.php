<?php include '../function/connectDB.php';  include '../function/date.php';
$Status=$_POST['Status'];
$name=(($Status==1)?"UserType":"_UserType");
$nosel=(($Status==1)?"3,5,6,7,8":"2,4");
$members="SELECT * FROM v_members WHERE UserID=$_POST[UserID]";
$getmember=mysqli_fetch_assoc(mysqli_query($condb,$members));
$valid_tru=(($getmember['UserType']==1)?"วาระการดำรงตำแหน่ง จะสิ้นสุดเมื่อ<br>สองปีนับแต่ วันแต่งตั้ง":"วาระการดำรงตำแหน่ง จะสิ้นสุดเมื่อ <br>".date2str($getmember['valid_tru'],0,1));
$sqlusertype="SELECT * FROM allvars WHERE TableName='members' AND FieldName='$name' AND FieldCode IN($nosel) ";
$resusertype=mysqli_query($condb,$sqlusertype);
?>
<div class="container">
    <div id="alertboxstatus">
        <div class="alert alert-success">
            <strong><i class="icon check green" aria-hidden="true"></i> สำเร็จ! </strong> อัพเดทสถานะข้อมูลผู้ใช้งาน
        </div>
    </div>
    <form id="SettingMember" onsubmit="SaveSettingMember(<?=$_POST['UserID'].','.$Status;?>)" method="post">
        <div class="mt10">
            <b>ข้อมูลเบื้องต้น</b>
        </div>
        <div>
            <label><b>ชื่อ-นามสุกล :
                </b><?=$getmember['UserPNameT'].$getmember['UserNameT']." ".$getmember['UserSNameT'];?></label>
                <input type="hidden" id="UserID" value="<?=$_POST['UserID'];?>">
        </div>
        <div>
            <label><b>ตำแหน่ง : </b><?=$getmember['PositionName']?></label>
        </div>

        <div>
            <label><b>สังกัด/คณะ : </b><?=$getmember['FacNameT']?></label>
        </div>
        <div class="mb5">
            <label><b>ภาควิชา : </b><?=$getmember['DeptNameT']?></label>
        </div>
        <div>
            <label>สถานะ</label>
        </div>
        <?php if($Status==1){ ?>
        <div class="mb10 mb10">
            <select name="UserTypeID" id="UserTypeID" onchange="SaveSettingMember(<?=$_POST['UserID'];?>)">
                <option value="0" selected disabled>เลิอกประเภทผู้ใช้งาน</option>
                <?php while ($rowusertype = mysqli_fetch_assoc($resusertype)) {
            echo "<option value=\"$rowusertype[FieldCode]\" ";
            if($getmember['UserType']==$rowusertype['FieldCode']){echo "selected";}
            echo ">$rowusertype[ValueT]</option>";
             } ?>
            </select>
        </div>
        <?php }else if($Status==2){ ?>
            <div>
                <select name="LeaderTypes" id="LeaderTypes" onchange="LeaderType()">
                    <option value="0">ผู้พักอาศัย</option>
                    <option value="1" <?=($getmember['LeaderType']==1)?"selected":"";?> >หัวหน้า อาคารฯ</option>
                    <option value="2" <?=($getmember['LeaderType']==2)?"selected":"";?> >รองหัวหน้า อาคารฯ</option>
                </select>
            </div>
            <div class="mt10">
                <input type="checkbox" style="margin-top: 4px;" <?php if($getmember['SemiCommitee']==1){echo "checked";} ?> onclick="LeaderType()" value="2" id="SemiCommitee">
                <label class="namecheckbox">อนุกรรมการ ตรวจที่พักอาศัย</label>
            </div>
        <?php } ?>
        <div class="mb5 mt10 border-red center">
            <label><b><?=$valid_tru;?></b></label>
        </div>
    </form>
</div>