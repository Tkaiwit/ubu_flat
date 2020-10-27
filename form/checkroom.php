<?php session_start(); include '../function/connectDB.php';  include '../function/date.php';
$sqlRTF = "SELECT * FROM v_return_form WHERE ReturnID=$_POST[ReturnID] ";
$getRTF = mysqli_fetch_assoc(mysqli_query($condb,$sqlRTF));

$btn=($_SESSION["UserType"]==4 || $_SESSION["UserType"]==5)?"UpdateCheckroom(1,$_POST[ReturnID])":(($_SESSION["UserType"]==9)?"UpdateCheckroom(2,$_POST[ReturnID])":"");
?>
<div class="formbox-w">
    <div style="margin-top:20px;">
        <b>ช้อมูลเบื้องต้น</b>
    </div>
    <div>
        <label><b>ชื่อ : </b> <?=$getRTF['UserPNameT'].$getRTF['UserNameT']." ".$getRTF['UserSNameT'];?></label>
    </div>
    <div>
        <label><b>อาคาร/ตึก : </b> <?=$getRTF['BuildingName']?> <b>หมายเลขห้อง : </b> <?=$getRTF['RoomName'];?></label> 
    </div> <hr>
    <form id="checkroom" onsubmit="<?=$btn;?>">
        <?php if($_SESSION["UserType"]==4 || $_SESSION["UserType"]==5){ ?>
        <div style="margin-top: 10px;">
            <input type="checkbox" onclick="checkstatus(this.checked,document.getElementById('checkroom'))" name="Suggest1" id="Suggest1">
            <label style="font-size:0.9em;" class="namecheckbox">สภาพห้องเรียบร้อย</label>
        </div>
        <div >
            <input type="checkbox" name="Suggest1_1" id="Suggest1_1">
            <label style="font-size:0.9em;" class="namecheckbox">ครุภัณฑ์ครบถ้วนและใช้การได้ดีเห็นควรคืนค่าประกัน
                ความเสียหาย ค่ามัดจำ</label>
        </div>
        <div >
            <input type="checkbox" onclick="checkstatus(this.checked,document.getElementById('checkroom'))" name="Suggest1_2" id="Suggest1_2">
            <label style="font-size:0.9em;" class="namecheckbox">สภาพห้องไม่เรียบร้อย วัสดุ
                อุปกรณ์และครุภัณฑ์มีการ ชำรุด สึกหรอ จำเป็นต้องปรับปรุง ซ่อมแซม หรือซื้อทดแทน</label>
        </div>
        <div>
            <label style="font-size:0.9em;">ของเดิมดังนี้</label>
        </div>
        <div >
        <textarea name="Comment1" id="Comment1" cols="30" rows="2" placeholder="รายละเอียด"></textarea>
        </div>
        <div >
            <label>ประมาณการรายจ่าย</label>
            <input type="number" name="EvalExpense" placeholder="จำนวนเงิน">
        </div><br>
        <?php }else if($_SESSION["UserType"]==9){ ?>
            <div class="row" style="margin-top: 10px; margin-bottom: 5px;">
            <input type="radio" value="1" name="Suggest2">
            <label style="font-size:0.9em;" class="nameradio">ได้คืนเงินให้ผู้พักอาศัยแล้ว</label>
            </div>
            <div class="row" style="margin: 5px 0px;">
            <input type="radio" value="2" name="Suggest2">
            <label style="font-size:0.9em;" class="nameradio">ได้รับเงินสด /เช็คเงินสดเพิ่มเติมจากผู้พักอาศัยแล้ว</label>
            </div>
            <div class="row" style="margin: 5px 0px;">
            <input type="radio" value="3" name="Suggest2">
            <label style="font-size:0.9em;" class="nameradio">ได้แจ้งกองคลังเพื่อหักบัญชีเงินเดือน /รายได้อื่นของผู้พักอาศัยแล้ว</label>
            </div>
            <div style="margin: 5px 0px;">
                <input type="text" name="AcceptPayment" id="AcceptPayment" placeholder="จำนวนเงิน">
            </div>
            <div style="margin: 5px 0px;">
            <input type="checkbox"  name="keycard">
            <label style="font-size:0.9em;" class="namecheckbox">ได้รับกุญแจและคีย์การ์ดห้องพักคืนแล้ว</label>
            </div>
            <div style="margin: 5px 0px;">
            <input type="checkbox"  name="authorize">
            <label style="font-size:0.9em;" class="namecheckbox">มอบอำนาจให้</label>
            </div>
            <div style="margin: 5px 0px;">
                <input type="text" name="Comment2" id="Comment2" placeholder="ชื่อผู้รับแทน">
            </div>
            <div >
                <label>เป็นผู้รับเงินค่าประกันความเสียหาย ค่ามัดจำ แทน</label>
            </div><br>
        <?php } ?>
        <div class="center">
            <input type="submit" class="btn-sm btn-sm-info" value="บันทึก">
        </div>
    </form>
</div>