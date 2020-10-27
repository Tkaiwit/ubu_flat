<?php session_start(); include '../function/date.php';include '../function/connectDB.php';
if(isset($_POST['ReturnID'])){
    $return_form="SELECT * FROM v_return_form WHERE ReturnID=$_POST[ReturnID]";
    $get_return_form=mysqli_fetch_assoc(mysqli_query($condb,$return_form));
    $BuildingID=$get_return_form['BuildingID'];
    $UserPNameT=$get_return_form['UserPNameT'];
    $UserNameT=$get_return_form['UserNameT'];
    $UserSNameT=$get_return_form['UserSNameT'];
    $PositionID=$get_return_form['PositionID'];
    $FacID=$get_return_form['FacID'];
    $RoomName=$get_return_form['RoomName'];
    $BuildingID=$get_return_form['BuildingID'];
    $Cause=$get_return_form['Cause'];
    $ReturnDate=$get_return_form['ReturnDate'];
    $CreateDate=$get_return_form['CreateDate'];
    $Suggest1=$get_return_form['Suggest1'];
    $Comment1=$get_return_form['Comment1'];
    $EvalExpense=$get_return_form['EvalExpense'];
    $PSPName=$get_return_form['PSPName'];
    $PSName=$get_return_form['PSName'];
    $PSSName=$get_return_form['PSSName'];
    $Comment1Date=$get_return_form['Comment1Date'];
    $sqlfaculty="SELECT * FROM faculty WHERE FacID=$FacID";
    $rowfaculty=mysqli_fetch_assoc(mysqli_query($condb,$sqlfaculty));
    $sqlposition="SELECT * FROM position WHERE PositionID=$PositionID";
    $rowposition=mysqli_fetch_assoc(mysqli_query($condb,$sqlposition));
    echo "<div class=\"container box\" style=\"margin-top: 10px\">
    <div id=\"formReturn-w\" class=\"formbox-w\">";
    $btn='UpDateReturnForm()';
}else{
    $UserPNameT=$_POST['UserPNameT'];
    $ResidentID=$_POST['ResidentID'];
    $UserNameT=$_POST['UserNameT'];
    $UserSNameT=$_POST['UserSNameT'];
    $PositionID=$_POST['PositionID'];
    $FacID=$_POST['FacID'];
    $RoomName=$_POST['RoomName'];
    $BuildingID=$_POST['BuildingID'];
    $Cause=$_POST['Cause'];
    $ReturnDate=$_POST['return_y']."-".$_POST['return_m']."-".$_POST['return_d']; 
    $CreateDate=date("Y-m-d");
    $sqlfaculty="SELECT * FROM faculty WHERE FacID=$FacID";
    $rowfaculty=mysqli_fetch_assoc(mysqli_query($condb,$sqlfaculty));
    $sqlposition="SELECT * FROM position WHERE PositionID=$PositionID";
    $rowposition=mysqli_fetch_assoc(mysqli_query($condb,$sqlposition));
    $btn='SaveReturnForm()';
}

?>
<div id="returnForm">
    <div class="container formbox-w">
        <div class="center">
            <b style="font-size:1em;">แบบฟอร์มขอส่งคืนที่พักอาศัยมหาวิทยาลัยอุบลราชธานี</b>
        </div>
        <div class="center">
            <b>
                <i class="inradio<?php if($BuildingID){ echo "ck ";} ?>"></i> แฟลต 1-4
                <i class="inradio<?php if($BuildingID==6){ echo "ck ";} ?>"></i> แฟลต 5
                <i class="inradio<?php if($BuildingID==4){ echo "ck ";} ?>"></i> แฟลต 6
            </b>
        </div>
        <div style="margin:20px 0 15px 0;">
            <b style="font-size:0.9em;">ส่วนที่ 1 ผู้พักอาศัย</b>
        </div>
        <div>
            <b style="font-size:0.9em;">เรียน&nbsp;&nbsp;&nbsp; ประธานคณะกรรมการสวัสดิการที่พักอาศัย
                (ผ่านประธานอนุกรรมการประจำอาคารชุดที่พักอาศัย
                หลังที่ <?=$BuildingID;?>)</b>
        </div>
        <div class="boxfq" style="margin: 0px 80px;">
            <label style="font-size:0.9em;">ข้าพเจ้า <?=$UserPNameT.$UserNameT." ".$UserSNameT;?>
                ตำแหน่ง &nbsp;<?=$rowposition['PositionName'];?>
            </label>
        </div>
        <div>
            <label style="font-size:0.9em;">สังกัด <?=$rowfaculty['FacNameT'];?> ผู้พักอาศัยห้องพักหมายเลข
                <?=$RoomName;?> แฟลต
                <?=$BuildingID;?></label>
        </div>
        <div>
            <label style="font-size:0.9em;"><?=date2str($ReturnDate,0,1)?> เนื่องจาก <?=$Cause;?></label>
        </div>
        <table width="100%">
            <tr>
                <td width="60%">
                    <div style="float: right; padding-right: 15px;text-align: center;">
                        <div style="text-align: center;">
                            <label style="font-size:0.9em;">(ลงชื่อ)............................................
                                ผู้พักอาศัย/ผู้แทน</label>
                        </div>
                        <div>
                            <label style="font-size:0.9em;">(<?=$UserPNameT.$UserNameT." ".$UserSNameT;?>)</label>
                        </div>
                        <div>
                            <label style="font-size:0.9em;"><?=date2str($CreateDate,0,1)?></label>
                        </div>
                    </div>
                </td>
            </tr>
            </tabel>

            <table class="tablefq" cellspacing="0" width="100%">
                <tr>
                    <td width="50%">
                        <div style="margin: 9px 0px 15px 5px;">
                            <b style="font-size:0.9em;">ส่วนที่ 2 ความเห็นของประธานอนุกรรมการหรืออนุกรรมการ<br>
                                ประจำอาคารชุดที่พักอาศัย หรือเจ้าหน้าที่
                            </b>
                        </div>
                        <lable id="lableform1">
                        <?php
                        if(isset($_POST['ReturnID']) && ($_SESSION['UserType']==4 || ($_SESSION['UserType']==9) )){ ?>
                        <form id="frmCheckRoom">
                        <input type="hidden" name="ReturnID" id="ReturnID" value="<?=$_POST['ReturnID'];?>" />
                        <input type="hidden" name="processby" id="processby" value="<?=$_SESSION['UserID'];?>" />
                        <div>
                            <input type="radio" name="Suggest1" onclick="chRoom(this)" style="margin: 0 4px 0 5px;" value="1" <?php if($Suggest1==1){echo "checked";}?>/> 
                            <label style="font-size:0.9em;" class="namelistradio">สภาพห้องเรียบร้อย</label>
                        </div>
                        <div>
                                <input type="radio" name="Suggest1" onclick="chRoom(this)" style="margin: 0 4px 0 5px;" value="2" <?php if($Suggest1==2){echo "checked";}?>/>
                                <label style="font-size:0.9em;" class="namelistradio">ครุภัณฑ์ครบถ้วนและใช้การได้ดีเห็นควรคืนค่าประกัน</label>
                            </div>
                            <div style="margin: 0 4px 0 5px;font-size:0.9em;">ความเสียหาย ค่ามัดจำ
                            </div>
                            <div>
                                <input type="radio" name="Suggest1" onclick="chRoom(this)" style="margin: 0 4px 0 5px;" value="3" <?php if($Suggest1==3){echo "checked";}?>/>
                                <label style="font-size:0.9em;" class="namelistradio">สภาพห้องไม่เรียบร้อย วัสดุ อุปกรณ์และครุภัณฑ์มีการ</label>
                            </div>
                            <div style="margin: 0 4px 0 5px;font-size:0.9em;">
                                ชำรุด สึกหรอ จำเป็นต้องปรับปรุง ซ่อมแซม หรือซื้อทดแทน
                            </div>
                            <div class="mr-ml">
                                <textarea name="Comment1" id="Comment1" cols="30" rows="2" onchange="chRoom(this)"><?=$Comment1;?></textarea>
                            </div>
                            <div class="row" style="margin: 0 4px 0 5px;">
                                <div class="col-6">
                                <label style="font-size:0.9em;">ประมาณการรายจ่าย จำนวน  
                                </label>
                                </div>
                                <div class="col-4" style="margin-top:-7px;">
                                    <input type="number" name="EvalExpense" id="EvalExpense" onchange="chRoom(this)" value="<?=$EvalExpense;?>">
                                </div>
                                <div class="col-2">
                                <label style="margin-left:5px;"> บาท</label>
                                </div>
                            </div>
                        </form>
                        <?php }else{ ?>
                            <div>
                                <i class="inradio" style="margin: 0 4px 0 5px;"></i> 
                                    <label style="font-size:0.9em;">สภาพห้องเรียบร้อย</label>
                            </div>
                            <div>
                                <i class="inradio" style="margin: 0 4px 0 5px;"></i> 
                                <label style="font-size:0.9em;">ครุภัณฑ์ครบถ้วนและใช้การได้ดีเห็นควรคืนค่าประกัน</label>
                            </div>
                            <div style="margin: 0 4px 0 5px;font-size:0.9em;">ความเสียหาย ค่ามัดจำ
                            </div>
                            <div>
                                <i class="inradio" style="margin: 0 4px 0 5px;"></i>
                                <label style="font-size:0.9em;">สภาพห้องไม่เรียบร้อย วัสดุ อุปกรณ์และครุภัณฑ์มีการ</label>
                            </div>
                            <div style="margin: 0 4px 0 5px;font-size:0.9em;">
                                ชำรุด สึกหรอ จำเป็นต้องปรับปรุง ซ่อมแซม หรือซื้อทดแทน
                            </div>
                            <div>
                                <label style="margin: 0 4px 0 5px;font-size:0.9em;">
                                    ของเดิมดังนี้...................................................................
                                </label>
                            </div>
                            <div style="margin: 0 4px 0 5px;" style="font-size:0.9em;">
                                .......................................................................................
                            </div>
                            <div>
                                .........................................................................................
                            </div>
                            <div style="margin: 0 4px 0 5px;">
                                <label style="font-size:0.9em;">ประมาณการรายจ่าย จำนวน...........................บาท
                                </label>
                            </div>
                    <?php } if(isset($_POST['ReturnID']) && $get_return_form['processby']){ ?>
                    
                            <div style="float: right; padding-right: 15px;margin: 6px 20px;text-align: center;font-size:0.9em;">
                                <div style="text-align: center;">
                                    <label
                                        style="font-size:0.9em;">(ลงชื่อ)..........................................</label>
                                </div>
                                <div style="padding-left: 40px;" style="font-size:0.9em;">
                                    <label style="font-size:0.9em;">(<?=$PSPName.$PSName." ".$PSSName;?>)</label>
                                </div>
                                <div style="padding-left: 15px;" style="font-size:0.9em;">
                                    <label
                                        style="font-size:0.9em;"><?=date2str($CreateDate,0,1)?>
                                        <br></label>
                                </div>
                                <div>
                                    <label style="font-size:0.9em;">ประธาน/อนุกรรมการ/เจ้าหน้าที่</label>
                                </div>
                            </div>
                    <?php } else { ?>
                        <div style="float: right; padding-right: 15px;margin: 6px 20px;text-align: center;font-size:0.9em;">
                                <div style="text-align: center;">
                                    <label
                                        style="font-size:0.9em;">(ลงชื่อ)..........................................</label>
                                </div>
                                <div style="padding-left: 40px;" style="font-size:0.9em;">
                                    <label style="font-size:0.9em;">(..........................................)</label>
                                </div>
                                <div style="padding-left: 15px;" style="font-size:0.9em;">
                                    <label
                                        style="font-size:0.9em;">วันที่..........เดือน........................พ.ศ............
                                        <br></label>
                                </div>
                                <div>
                                    <label style="font-size:0.9em;">ประธาน/อนุกรรมการ/เจ้าหน้าที่</label>
                                </div>
                            </div>
                    <?php } ?>
                            <div style="float: right; padding-right: 15px;margin: 46px 20px;text-align: center;">
                                <div style="text-align: center;" style="font-size:0.9em;">
                                    <label
                                        style="font-size:0.9em;">(ลงชื่อ)..........................................</label>
                                </div>
                                <div style="padding-left: 40px;" style="font-size:0.9em;">
                                    <label style="font-size:0.9em;">(<?=$UserPNameT.$UserNameT." ".$UserSNameT;?>)</label>
                                </div>
                                <div style="padding-left: 15px;" style="font-size:0.9em;">
                                    <label
                                        style="font-size:0.9em;">วันที่..........เดือน........................พ.ศ............</label>
                                </div>
                                <div>
                                    <label style="font-size:0.9em;">ผู้พักอาศัย/ผู้รับมอบอำนาจ/ผู้แทน</label>
                                </div>
                            </div>
                        </lable>
                    </td>
                    <td width="50%">
                        <div style="margin: 9px 0px 15px 5px;">
                            <b style="font-size:0.9em;">ส่วนที่ 3 ความเห็นของเลขานุการคณะกรรมการสวัสดิการ<br>
                                ที่พักอาศัยหรือเจ้าหน้าที่หรือผู้พักอาศัย
                            </b>
                        </div>
                        <div style="font-size:0.9em;"><i class="inradio" style="margin: 0 4px 0 5px;"></i>
                            ได้คืนเงินให้ผู้พักอาศัยแล้ว จำนวน....................บาท
                        </div>
                        <div style="font-size:0.9em;"><i class="inradio" style="margin: 0 4px 0 5px;"></i> ได้รับเงินสด
                            /เช็คเงินสดเพิ่มเติมจากผู้พักอาศัยแล้ว
                        </div>
                        <div style="margin: 0 4px 0 36px;">จำนวน...................................บาท
                        </div>
                        <div style="font-size:0.9em;"><i class="inradio"
                                style="margin: 0 4px 0 5px;"></i>ได้แจ้งกองคลังเพื่อหักบัญชีเงินเดือน
                            /รายได้อื่นของผู้พัก
                        </div>
                        <div style="margin: 0 4px 0 36px;">อาศัยแล้ว จำนวน.......................บาท
                        </div>
                        <div style="font-size:0.9em;"><i class="inradio"
                                style="margin: 0 4px 0 5px;"></i>ได้รับกุญแจและคีย์การ์ดห้องพักคืนแล้ว
                        </div>
                        <div style="font-size:0.9em;"><i class="inradio"
                                style="margin: 0 4px 0 5px;"></i>มอบอำนาจให้............................................................
                        </div>
                        <div style="margin: 0 4px 0 36px;">
                            <label style="font-size:0.9em;">เป็นผู้รับเงินค่าประกันความเสียหาย ค่ามัดจำ แทน</label>
                        </div>
                        <div
                            style="float: right;padding-right: 15px;text-align: center;margin-top: 12px;margin-bottom: 24px;">
                            <div style="text-align: center;">
                                <label
                                    style="font-size:0.9em;">(ลงชื่อ)..........................................</label>
                            </div>
                            <div style="padding-left: 40px;">
                                <label style="font-size:0.9em;">(..........................................)</label>
                            </div>
                            <div style="padding-left: 15px;">
                                <label
                                    style="font-size:0.9em;">วันที่..........เดือน........................พ.ศ............</label>
                            </div>
                            <div>
                                <label style="font-size:0.9em;">เลขานุการคณะ กก.หรือ<br>
                                    ประธาน/อนุกรรมการ/เจ้าหน้าที่</label>
                            </div>
                        </div>
                        <div style="float: right;padding-right: 15px;margin: 13px 0 44px 0;text-align: center;">
                            <div style="text-align: center;">
                                <label style="font-size:0.9em;">(ลงชื่อ)..........................................
                                </label>
                            </div>
                            <div style="padding-left: 40px;">
                                <label style="font-size:0.9em;">(<?=$UserPNameT.$UserNameT." ".$UserSNameT;?>)</label>
                            </div>
                            <div style="padding-left: 15px;">
                                <label
                                    style="font-size:0.9em;">วันที่..........เดือน........................พ.ศ............</label>
                            </div>
                            <div>
                                <label style="font-size:0.9em;">ผู้พักอาศัย/ผู้รับมอบอำนาจ/ผู้แทน</label>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <div>
                <label style="font-size:0.9em;"><b>ส่วนที่ 4 ข้อคิดเห็นอื่น (ถ้ามี)</b></label><br>
                ..................................................................................................................................................................................
                ..................................................................................................................................................................................
            </div>
            <div class="row">
                <div class="col-1">
                    <b style="font-size:0.9em;"><u>หมายเหตุ</u></b>
                </div>
                <div class="col-11" style="font-size:0.9em;">
                    <div style="margin: 0px 9px">
                        ให้ผู้พักอาศัยยื่นแบบฟอร์มนี้ต่อประธานอนุกรรมการประจำอาคารที่พักอาศัย(ประธานแฟลต)ของท่าน
                        เพื่อตรวจสอบ
                        และลงนามยืนยันผลการตรวจสอบสภาพห้องก่อน จึงนำส่งงานสวัสดิการ โครงการจัดตั้งกองการเจ้าหน้าที่
                        พร้อม
                        กุญแจห้องพักอาศัย
                    </div>
                </div>
            </div>
            <form id="sreturnform" onsubmit="return <?=$btn;?>" method="post">
                <?php if(isset($_POST['ReturnID'])){?>

                <?php }else{ ?>
                <input type="hidden" name="ResidentID" value="<?=$ResidentID;?>">
                <input type="hidden" name="return_d" value="<?=$ReturnDate;?>">
                <input type="hidden" name="Cause" value="<?=$Cause?>">
                <?php }?>
                <div class="row">
                    <div class="alr">
                        <?php if(isset($_POST['ReturnID'])){?>
                        <!-- <input type="button" id="blackin" class="btn-sm btn-sm-info" value="แก้ไข" onclick="CheckRoom()" > -->
                        <!-- <input type="submit" id="savereturnform" class="btn-sm btn-sm-info" value="ยืนยัน"> -->
                        <?php }else{ ?>
                        <input type="button" id="blackin" class="btn-sm btn-sm-info" value="แก้ไข"
                            onclick="location.href='./return_form.php';">
                        <input type="submit" id="savereturnform" class="btn-sm btn-sm-info" value="ยืนยัน">
                        <input type="้button" id="returnformprint" class="btn-sm btn-sm-info" value="พิมพ์"
                            onclick="printForm('returnForm')">
                        <input type="button" id="cosrfrm" onclick="location.href='./Profile.php'"
                            class="btn-sm btn-sm-drag" value="ปิด" onclick="window.location='./index.php';">
                        <?php }?>
                    </div>
                </div>
            </form>
    </div>
</div>
<?php if(isset($_POST['ReturnID'])){?>
</div>
</div>
<?php } ?>