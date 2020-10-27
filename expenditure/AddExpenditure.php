<?php session_start(); include '../function/connectDB.php';  include '../function/date.php';
$sqlexpedntype="SELECT * FROM expensetype ";

$sqlbuilding="SELECT * FROM building WHERE BuildingType !=0";
$resbuilding=mysqli_query($condb,$sqlbuilding);
$ExpID=$_POST['ExpID'];
$sqlmembers="SELECT UserID,LeaderType,SemiCommitee,BuildingID,UserPNameT,UserNameT,UserSNameT FROM v_members ";
if($ExpID>0){
    $sqlex="SELECT * FROM v_expense WHERE ExpID=$ExpID";
    $getex=mysqli_fetch_assoc(mysqli_query($condb,$sqlex));
    $gExpID=$getex['ExpID']; $ExpTypeID=$getex['ExpTypeID'];
    $sqlmembers.=" WHERE BuildingID=$getex[BuildingID] AND LeaderType IN(1,2)";
    $sqlexpedntype.="WHERE ExpTypeID!=1";
    $btns="if(vailfromEx()){ return UpDateAddexpenditure($gExpID,1);}else{ return false;}";
}else{
    $sqlmembers.=" WHERE BuildingID=0";
    $sqlexpedntype.="WHERE ExpTypeID!=1";
    $btns="if(vailfromEx()){ return SaveAddexpenditure(1);}else{ return false;}";
    // onsubmit="if(vailfromEx()){return SaveAddexpenditure(1);}else{ return false;}"
}
$resexpedntype=mysqli_query($condb,$sqlexpedntype);
$resmembers=mysqli_query($condb,$sqlmembers);
?>
<div class="container formbox-w">
<form id="Frmex" name="Frmex" onsubmit="<?=$btns;?>" method="POST">
        <div>
            <lable>อาคาร</lable> 
            <select name="BuildingIDs" id="BuildingIDs"
                onchange="selectors(this.options[this.selectedIndex].value)">
                <option value="0">ไม่ระบุอาคาร</option>
                <?php
                while($rowb=mysqli_fetch_assoc($resbuilding)){
                    echo "<option value=\"$rowb[BuildingID]\" ";
                    if($_POST['ExpID']>0){
                        if($getex['BuildingID']==$rowb['BuildingID']){echo "selected";} }
                    echo ">$rowb[BuildingName]</option>";
                }
                ?>
            </select>
        </div>
        <div>
            <lable>ประเภทรายจ่าย *</lable>
            <lable id="lableExType">
            <select name="ExpTypeIDs" id="ExpTypeIDs"
                onchange="selectorinput(document.getElementById('BuildingIDs').value,this.options[this.selectedIndex].value)">
                <option value="0" selected disabled>เลือกประเภทรายจ่าย</option>
                <?php
                while($row=mysqli_fetch_assoc($resexpedntype)){
                    echo "<option value=\"".$row['ExpTypeID']."\" ";
                    if($_POST['ExpID']>0){
                    if($getex['ExpTypeID']==$row['ExpTypeID']){echo "selected";} }
                    echo ">".$row['ExpenseName']."</option>";
                }
                ?>
            </select>
            </lable>
        </div>
        <div>
            <lable>จ่ายให้ *</lable>
            <lable id="lablePayFor">
                <?php if($ExpID>0){
                    if($ExpTypeID!=1){
                        echo "<input type=\"text\" name=\"lablePayFor\" id=\"lablePayFor\" placeholder=\"ชื่อ-นามสกุล\" value=\"$getex[NamePayfor]\" />";
                    }else{ 
                        echo "<select name=\"PayFor\" id=\"PayFor\">";
                        echo "<option value=\"0\" selected disabled>เลือกคณะกรรมการ</option>";
                        while($rowm=mysqli_fetch_assoc($resmembers)){
                            echo "<option value=\"$rowm[UserID]\" ";
                            if($getex['PayFor']==$rowm['UserID']){echo "selected";}
                            echo ">$rowm[UserPNameT]$rowm[UserNameT]"." "."$rowm[UserSNameT]</option>";
                        } 
                    }
                echo "</select>"; } else { ?>
                <select name="PayFor" id="PayFor">
                    <option value="0">เลือกคณะกรรมการ</option>
                </select>
                <?php } ?>
            </lable>
        </div>
        <div>
            <lable>จำนวนเงิน *</lable>
            <input type="text" name="Amount" id="Amount" placeholder="จำนวนเงิน" <?=($ExpID>0)?"value=\"$getex[Amount]\"":"";?> >
        </div>
        <div class="row">
            <div class="col-7">
                <lable>ประจำเดือน *</lable>
                <div class="mr-ml">
                    <?=($ExpID>0)?monthselect($getex['MonthlyPeriod'],"MonthlyPeriod",100):monthselect(date("m"),"MonthlyPeriod",100);?>
                </div>
            </div>
            <div class="col-5">
                <lable>ประจำปี *</lable>
                <div class="mr-ml">
                    <?=($ExpID>0)?yearselect($getex['Yearly'],"Yearly",'2019',date("Y"),100," "):yearselect(date("Y"),"Yearly",'2019',date("Y"),100," ");?>
                </div>
            </div>
        </div>
        <div>
            <lable>หมายเหตุ</lable>
            <textarea name="Notics" id="Notics" cols="30" rows="3" placeholder="ระบุหรือไม่ระบุก็ได้"><?=($ExpID>0)?$getex['Notics']:"";?></textarea>
        </div>
        <br>
        <div class="center">
            <!-- <input type="submit" class="btn-sm btn-sm-info" value="บันทึก"> -->
            <!-- <div class="mr-ml"> -->
                <button type="submit" class="btn-sm btn-sm-info btn-add"><i class="icons save nameicon"></i>บันทึกรายจ่าย</button>
            <!-- </div> -->
        </div>
    </form>
</div>