<?php  include 'inc/toptitle.php'; include './function/connectDB.php'; include './function/date.php'; $sw_f=1;
$get_resident="SELECT UserID,UserPNameT,UserNameT,UserSNameT,BuildingID,BuildingName,RoomID,RoomName,RoomTypeName2 FROM v_resident WHERE UserID=$_SESSION[UserID]";
$row_resident=mysqli_fetch_assoc(mysqli_query($condb,$get_resident));

$member="SELECT UserID,UserPNameT,UserNameT,UserSNameT,UserType,LeaderType,BuildingID FROM members 
WHERE BuildingID=$row_resident[BuildingID] AND UserType IN(5,9) AND LeaderType=2";
$swap_status="SELECT SwapID, UserID, Status,BuildingID,MoveToRoomID FROM `v_z_swaproom` WHERE UserID=$_SESSION[UserID]";
$getSwap_Status=mysqli_fetch_assoc(mysqli_query($condb,$swap_status));
$StatusSwap=$getSwap_Status['Status'];$BuildingID=$getSwap_Status['BuildingID'];$RoomID=$getSwap_Status['MoveToRoomID'];$SwapID=$getSwap_Status['SwapID'];

$room="SELECT * FROM v_room WHERE BuildingID=$BuildingID ORDER BY RoomStatus, RoomName";
$gerroom=mysqli_query($condb,$room);

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
                            <b style="font-size:20px">วันที่</b> <?=date2str(date("Y-m-d"));?>
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
                            ข้าพเจ้า<?=$row_resident['UserPNameT'].$row_resident['UserNameT']." ".$row_resident['UserSNameT']?>
                            ได้อาศัยอยู่ที่อาคาร <?=$row_resident['BuildingName']?> หมายเลขห้อง
                            <?=$row_resident['RoomName']?> มีความประสงค์
                        </label>
                        <input type="hidden" value="<?=$row_resident['BuildingID'];?>" id="BeforeBuildingID">
                    </div>
                    <div class="row">
                        <div style="margin-top:18px">
                            ขอสลับห้องพักกับ <span
                                id="NameSwap"><?php echo (isset($StatusSwap))?"$getvresident[UserPNameT]$getvresident[UserNameT] $getvresident[UserSNameT]":"..................................................."; ?></span>
                            ซึ่งพักอาศัยอยู่ในอาคาร
                        </div>
                        <div>
                            <span class="selbIDfrm">
                                <div class="mr-ml">
                                    <select name="BuildingID" id="BuildingID"
                                        onchange="Swap_Room(this.options[this.selectedIndex].value,<?=$row_resident['RoomID']?>)">
                                        <option value="0">เลือกอาคาร</option>
                                        <?php while($getBuil=mysqli_fetch_assoc($resBuil)){
                                        echo "<option value=\"$getBuil[BuildingID]\" ";
                                        echo ($StatusSwap==0 && $getBuil['BuildingID']==$BuildingID)?"selected":""; 
                                        echo ">$getBuil[BuildingName]</option>";
                                    } ?>
                                    </select>
                                </div>
                            </span>
                            <label style="margin-top:18px" class="frmbIDPrint" id="frmbIDPrint">
                            </label>
                        </div>
                        <div style="margin-top:18px">
                            <span>&nbsp;หมายเลขห้อง &nbsp;</span>
                        </div>
                        <div>
                            <span class="selRoomname" id="lableSwapRoomname">
                                <?php 
                        echo "<select name=\"roomname\" id=\"roomname\" onchange=\"Swap_Room($BuildingID,$row_resident[RoomID],this.options[this.selectedIndex].value)\">";
                        echo "<option value=\"0\">เลือกห้อง</option>";
                        while($row=mysqli_fetch_assoc($gerroom)){
                            echo "<option value=\"$row[RoomID]\" ";
                            echo ($RoomID==$row['RoomID'])?" selected":'';
                            if($row_resident['RoomID']==$row['RoomID']){echo "disabled"; $Roomname=$row['RoomName'];}
                            echo($row['RoomTypeName2']!=$row_resident['RoomTypeName2'])?" disabled":"";
                            echo ">$row[RoomName] - $row[RoomStatusName] - $row[RoomTypeName2]</option>";
                        }
                        echo "</select>";
                        ?>
                            </span>
                            <span style="margin-top:18px" class="labelRoomname" id="labelRoomname"></span>
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
                                    <?=$row_resident['UserPNameT'].$row_resident['UserNameT']."&nbsp; ".$row_resident['UserSNameT']?>
                                    )
                                </div>
                                <div style="padding-left: 15px;">
                                    <?=date2str(date("Y-m-d"),0,1);?>
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
                                        <?=$row_resident['BuildingID'];?></lable>
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
                                        <lable id="lableAfbuilType"></lable>
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
                <div class="row mt10">
                    <div class="alr">
                        <span id="btnshow">
                            <button type="submit" class="btn-add"><i
                                    class="icons save nameicon"></i>บันทึกข้อมูล</button>
                        </span>
                    </div>
                    <br>
            </form>

        </div>
    </lable>
</div>
</div>
<?php include 'inc/footer.php'; ?>