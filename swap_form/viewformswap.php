<?php  include '../function/connectDB.php'; include '../function/date.php'; $sw_f=1;
$SwapID=$_POST['SwapID'];
$vSwapform="SELECT * FROM `v_z_swaproom`";
$getvSwapform=mysqli_fetch_assoc(mysqli_query($condb,$vSwapform));

if(isset($StatusSwap)){
$vresident="SELECT ResidentID,BuildingID,RoomID,UserPNameT,UserNameT,UserSNameT,EndDate FROM v_resident WHERE RoomID=$RoomID AND EndDate IS NULL";
$getvresident=mysqli_fetch_assoc(mysqli_query($condb,$vresident));
}
$building="SELECT * FROM building where BuildingType=1";
$resBuil=mysqli_query($condb,$building);
?>
<div class="container box" style="margin-top: 10px;height:auto;">
    <lable id="lableReturnform">
        <div id="formReturn-w" class="formbox-w">
            <form id="swapform" name="swapform" class="formrq mt10"
                onsubmit="if(chvalFormswapform()) return <?php echo(isset($StatusSwap))?'swapformUpdate('.$SwapID.')':'swapformsave()'; ?>;else return false;"
                method="POST">
                <div class="row">
                    <div class="col-4 left">
                        <img src="./assets/img/unnamed.jpg" width="112px" height="112px" />
                    </div>
                    <div class="col-8">
                        <div style="margin: 74px 0px 0px 80px;">
                            <b style="font-size:24px">บันทึกข้อความ</b>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 left">
                    </div>
                    <div class="col-8">
                        <div style="margin: 0px 0px 0px 120px;">
                            <b style="font-size:20px">วันที่</b> <?=date2str($getvSwapform['CreateDate']);?>
                        </div>
                    </div>
                </div>
                <div>
                    <b style="font-size:20px">เรื่อง</b> <label style="margin-left: 22px;">การขอสลับห้องพัก</label>
                </div>
                <div>
                    <b style="font-size:20px">เรียน</b> <label
                        style="margin-left: 22px;">ประธานกรรมการสวัสดิการที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</label>
                </div>
                <div class="mt10">
                    <div style="margin-left: 100px;">
                        <label>
                            ข้าพเจ้า<?=$getvSwapform['UserPNameT'].$getvSwapform['UserNameT']." ".$getvSwapform['UserSNameT']?>
                            ได้อาศัยอยู่ที่อาคาร <?=$getvSwapform['BuildingName']?> หมายเลขห้อง
                            <?=$getvSwapform['RoomName']?> มีความประสงค์
                        </label>
                        <input type="hidden" value="<?=$row_resident['BuildingID'];?>" id="BeforeBuildingID">
                    </div>
                    <div class="row">
                        <div style="margin-top:18px">
                            ขอสลับห้องพักกับ <span
                                id="NameSwap"><?=$getvSwapform['UserPNameT2']."".$getvSwapform['UserNameT2']." ".$getvSwapform['UserSNameT2'];?></span>
                            ซึ่งพักอาศัยอยู่ในอาคาร
                        </div>
                        <div style="margin-top:18px">
                            <label><?=$getvSwapform['BuildingName2'];?></label>
                        </div>
                        <div style="margin-top:18px">
                            <span>&nbsp;หมายเลขห้อง &nbsp;</span>
                        </div>
                        <div style="margin-top:18px">
                            <span ><?= $getvSwapform['RoomName2'];?></span>
                        </div>
                    </div>
                </div>
                <table width="100%" style="margin-top: 50px;">
                    <tr>
                        <td width="60%">
                            <div style="float: right; padding-right: 13px;">
                                <div style="text-align: center;">
                                    (ลงชื่อ).......................................... ผู้ขอสลับห้อง
                                </div>
                                <div style="padding-left: 35px;">
                                    (
                                    <?=$getvSwapform['UserPNameT'].$getvSwapform['UserNameT']."&nbsp; ".$getvSwapform['UserSNameT']?>
                                    )
                                </div>
                                <div style="padding-left: 15px;">
                                    <?=date2str($getvSwapform['CreateDate'],0,1);?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <table class="tablefq" cellspacing="0" width="100%">
                    <tr>
                        <td width="50%">
                            <div style="float: right; padding-right: 50px;margin-top: 10px;">
                                <div style="text-align: center;">
                                    (ลงชื่อ)..........................................
                                </div>
                                <div style="padding-left: 68px;">
                                    (..........................................)
                                </div>
                                <div style="padding-left: 15px;">
                                    วันที่..........เดือน...........................พ.ศ............
                                </div>
                                <div style="text-align: center;">หัวหน้า/รองหัวหน้า อาคารชุดที่พักอาศัยหลังที่ <lable>
                                        <?=$getvSwapform['BuildingID'];?></lable>
                                </div>
                            </div>
                            <span id="langName">
                                <div style="float: right; padding-right: 50px; margin-top: 50px;">
                                    <div style="text-align: center;">
                                        (ลงชื่อ)..........................................
                                    </div>
                                    <div style="padding-left: 68px;">
                                        (..........................................)
                                    </div>
                                    <div style="padding-left: 15px;">
                                        วันที่..........เดือน...........................พ.ศ............
                                    </div>
                                    <div style="text-align: center;">หัวหน้า/รองหัวหน้า อาคารชุดที่พักอาศัยหลังที่
                                        <lable id="lableAfbuilType"><?=$getvSwapform['BuildingID2'];?></lable>
                                    </div>
                                </div>
                            </span>
                        </td>
                        <td width="50%">
                            <div style="float: right; padding-right: 50px; margin-top: 10px;">
                                <div style="text-align: center;">
                                    (ลงชื่อ)..........................................
                                </div>
                                <div style="padding-left: 68px;">
                                    (..........................................)
                                </div>
                                <div style="padding-left: 15px;">
                                    วันที่..........เดือน...........................พ.ศ............
                                </div>
                                <div style="text-align: center;">ผู้จัดการอาคารที่พักอาศัย</div>
                            </div>
                            <div style="float: right; padding-right: 50px;margin-top: 50px;">
                                <div style="text-align: center;">
                                    (ลงชื่อ)..........................................
                                </div>
                                <div style="padding-left: 68px;">
                                    (..........................................)
                                </div>
                                <div style="padding-left: 15px;">
                                    วันที่..........เดือน...........................พ.ศ............
                                </div>
                                <div style="text-align: center;">ประธานกรรมการสวัสดิการที่พักอาศัย</div>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </lable>
</div>
</div>