<?php include('inc/toptitle.php'); require 'function/flatfunction.php'; include './function/connectDB.php'; include './function/date.php';
$Monthly=date('m',strtotime("-1month")); $Yearly=date('Y');
$resident="SELECT * FROM ";
$monthlycharge="SELECT * FROM v_monthlycharge WHERE ";
if($_SESSION['UserType']!=1){
    $resident.=" v_members WHERE UserID=$_SESSION[UserID]";
}else{
    $resident.=" v_resident WHERE UserID=$_SESSION[UserID]";
}
$resulit=mysqli_fetch_assoc(mysqli_query($condb,$resident));
$monthlycharge.=" UserID=$_SESSION[UserID] AND MonthlyPeriod=$Monthly AND Yearly =$Yearly";

$getmontc=mysqli_fetch_assoc(mysqli_query($condb,$monthlycharge));
?>
<div class="container box" style="margin-top: 10px;">
    <div class="border-box center">
        <div style="margin-top: 50px;">
            <label style="color: #3f99e6;font-weight: 600;">ยินดีต้อนรับเข้าสู่ระบบ<br>
                ระบบจัดการอาคารที่พักอาศัยบุคลากรมหาวิทยาลัยอุบลราชธานี</label>
        </div>
        <div class=row>
            <div class="col-12 center">
                <div class="img" style="margin-top: 50px;">
                    <img src="./assets/img/No_Image_Available.jpg">
                </div>
                <div class=personf>
                    <label><?=$resulit['UserPNameT'].$resulit['UserNameT']." ".$resulit['UserSNameT'];?></label></div>
                <div>
                    <?=($_SESSION['LeaderType']>0)?"( ".LeaderType($_SESSION['LeaderType'])." )<br>":""; ?>
                    <?=($_SESSION['SemiCommitee']>0)?"( ".SemiCommitee($_SESSION['SemiCommitee'])." )<br>":""; ?>
                    ( <?=userTypename($_SESSION['UserType']);?> )
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6" style="margin-top: 20px;">
                <div class="box-profile">
					<div class=personf><label>ข้อมูลส่วนตัว</label></div>
						<div class="box-profile-icons"><a href="#" onclick="editProfile(<?=$_SESSION['UserID'];?>)" id="FormAccept" class="tooltip acc"><i class="icons edit" aria-hidden="true"></i><lable class="tooltiptext">แก้ไขโปรไฟล์</lable></a></div>
                    <div class="left ml50">
                        <div>ชื่อ-นามกุล : <?=$resulit['UserPNameT'].$resulit['UserNameT']." ".$resulit['UserSNameT'];?>
                        </div>
                        <div>ตำแหน่ง : <?=$resulit['PositionName'];?></div>
                        <div>สังกัด/คณะ : <?=$resulit['FacNameT'];?></div>
						<div>ภาควิชา : <?=$resulit['DeptNameT'];?></div>
						<div>อาคาร : <?=($_SESSION['UserType']==1)?$resulit['BuildingName']:"-";?> หมายเลขห้อง : <?=($_SESSION['UserType']==1)?$resulit['RoomName']:"-";?></div>
                    </div>
                </div>
            </div>
            <div class="col-6" style="margin-top: 20px;">
                <div class="box-profile">
                    <div class=personf><label>ข้อมูลค่าใช้จ่ายประจำเดือน</label></div>
                    <?php if($_SESSION['UserType']==1){ ?>
					<div class="box-profile-icons">
                        <a href="#" onclick="FormAccept(32)" id="FormAccept" class="tooltip acc">
                        <!-- <i class="icons eye"></i>
                        <lable class="tooltiptext">ดูข้อมูลย้อนหลัง</lable> -->
                        </a>
                    </div>
                    <?php } ?>
					<div>วันที่ <?=date2str(date("Y-m-01"));?></div>
                    <div class="left ml50">
					<div>
                       <dt>ค่าบำรุงห้อง <label class="box-profile-price"><?=($_SESSION['UserType']==1)?$getmontc['RoomRate']:"-";?></label></dt> 
                    </div>
                    <div>
						<dt>ค่าน้ำ <label class="box-profile-price"><?=($_SESSION['UserType']==1)?$getmontc['AmountWater']:"-";?></label></dt>
                    </div>
                    <div>
						<dt>ไฟฟ้า <label class="box-profile-price"><?=($_SESSION['UserType']==1)?$getmontc['AmountElec']:"-";?></label></dt>
                    </div>
                    <div>
						<dt>รวมทั่งสิ้น <label class="box-profile-price"><?=($_SESSION['UserType']==1)?$getmontc['AmountTotal']:"-";?></label></dt>
                    </div>
					</div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>