<?php include '../function/connectDB.php'; include '../function/date.php'; include '../function/iconshow.php';
$RoomType = $_POST['RoomType'];
$eval_quarter = $_POST['eval_quarter'];
$eval_year = $_POST['eval_year'];
$eval_condition=$_POST['eval_condition'];
$StatusForm=$_POST['StatusForm'];
if($eval_quarter==1){$mm="4";}elseif($eval_quarter==2){$mm="8";}elseif($eval_quarter==3){$mm="12";}else{$mm='0';};

    $sqleval_score="SELECT eval_ID, eval_quarter,eval_year,RoomType,DATE_FORMAT(eval_condition, '%Y') as year_p ,
    DATE_FORMAT(eval_condition, '%c') as month_p,DATE_FORMAT(eval_condition, '%e') as day_p, eval_Date,UserPNameT,UserNameT,UserSNameT
    FROM v_eval_score WHERE RoomType=$RoomType and eval_quarter=$eval_quarter and eval_year=$eval_year";
    $result=mysqli_fetch_array(mysqli_query($condb,$sqleval_score));
    
    $day=$result['day_p'];$month=$result['month_p'];$year=$result['year_p'];$eval_ID=$result['eval_ID'];

$eval_Date=date("Y-m-d");
if(isset($result['eval_ID'])>0){
    $sqlcheckscore="SELECT PName, Name, Surname,1 Sel ,score1, score2, score3, score41,score42,score5, TotalScore ,PositionName ,FacNameT,RequestID,RequestDate,eval_status  
    FROM `v_eval_form` WHERE eval_ID=$eval_ID Order BY TotalScore DESC";
}else if($StatusForm>0){
    $sqlcheckscore="SELECT RequestID,PName,Name,Surname,PositionName,FacNameT,RequestDate,PositonWeight score1, AddressWeight score2,
    DissaterWeight score3,MaritalStatusWeight score41,ChildrenWeight score42,RoomType,FormAcceptBy,FormStatus, NULL eval_status,
    cal_workyear2Score('$eval_Date',EmployDate) AS score5 ,
    PositonWeight+AddressWeight+DissaterWeight+MaritalStatusWeight+ChildrenWeight+cal_workyear2Score('$eval_Date',EmployDate) AS TotalScore
    FROM v_request_form WHERE ";
    $sqlcheckscore.=(($RoomType>0)?" RoomType =$RoomType":" RoomType =0");
    $sqlcheckscore.=(($eval_quarter>0)?" AND RequestDate <'$eval_year-$mm-1'":" AND RequestDate <'0000-00-00' ");
    $sqlcheckscore.=" AND FormStatus=2 ORDER BY TotalScore DESC ,EmployDate,RequestDate";
}else {
    $sqlcheckscore="SELECT RequestID,PName,Name,Surname,PositionName,FacNameT,RequestDate,PositonWeight score1,AddressWeight score2,
     DissaterWeight score3,MaritalStatusWeight score41,ChildrenWeight score42,RoomType,FormAcceptBy,FormStatus,
      NULL score1, NULL score2, NULL score3, NULL score41, NULL score42, NULL score5 ,NULL TotalScore ,NULL eval_status
      FROM v_request_form WHERE ";
    $sqlcheckscore.=(($RoomType>0)?" RoomType =$RoomType":" RoomType =0");
    $sqlcheckscore.=(($eval_quarter>0)?" AND RequestDate <'$eval_year-$mm-1'":" AND RequestDate <'0000-00-00' ");
    $sqlcheckscore.=" and FormStatus=2 ORDER BY RequestDate DESC";
}
    $rescheckscore=mysqli_query($condb,$sqlcheckscore);
    $checkfrm=mysqli_num_rows($rescheckscore);
    if(isset($result['eval_ID'])>0){
        echo "<input type=\"button\" id=\"cancelprocess\" class=\"btn-sm btn-sm-drag\" value=\"ยกเลิกประมวล\"
        onclick=\"cancelprocessform($result[eval_ID])\">";
    }else if($eval_quarter>0 && $RoomType>0){
        echo "<input type=\"button\" id=\"btnprocess\" class=\"btn-sm btn-sm-green\" value=\"ประมวลผลคะแนน\" onclick=\"odbprocessform(1)\">";
    }
     if ($StatusForm>0){ 
        echo "<input type=\"button\" id=\"savebtnprocess\" class=\"btn-sm btn-sm-info\" value=\"บันทึกการประมวล\" onclick=\"saveprocessform()\">";
    }
echo chr(5);  
    if(isset($result['eval_ID'])>0){
            echo "<label style=\"margin-right: 20px;color:green;\">ประมวลผลคะแนนโดย ".
            $result['UserPNameT'].$result['UserNameT']." ".$result['UserSNameT']."</label>";
            echo "<label style=\"margin-right: 20px;color:green;\">เมื่อวันที่ ".date2str($eval_Date,1)."</label>";
    }
echo chr(5);
?>
<form id="Processform">
    <table class="table table-sm">
        <thead>
            <tr>
                <th rowspan="2" width="5%" align="left">
                    <?php if($StatusForm>0){echo "<input type=\"checkbox\" name=\"chall\"
                        onclick=\"checkall(this.checked,document.getElementById('Processform'))\">"; } ?>
                    <label class="namecheckbox">#ที่</label>
                </th>
                <th rowspan="2" align="left">ชื่อ - นามสกุล</th>
                <th rowspan="2" align="left">ตำแหน่ง</th>
                <th rowspan="2" align="left">คณะ/หน่วยงาน</th>
                <th rowspan="2"align="left">วันที่ส่งเอกสาร</th>
                <th colspan="7">
                    คะแนนตามเกณฑ์การคิดคะแนน
                </th>
                <th rowspan="2" width="9%">จัดการ</th>
            </tr>
            <tr>
                <th width="45px">1</th>
                <th width="45px">2</th>
                <th width="45px">3</th>
                <th width="45px">4.1</th>
                <th width="45px">4.2</th>
                <th width="45px">5</th>
                <th>คะแนนรวม</th>
            </tr>
        </thead>
        <tbody id="myTable" name="table1">
            <?php
                $x = 0;
                while ($rowscore = mysqli_fetch_assoc($rescheckscore)) { $x++;
                    $co=($result['eval_ID']>0 && $rowscore['Sel']=='') ? 'style="color:#aaa8a8;"' : '';
                    $co=($rowscore['eval_status']==2)?'style="background-color:#e8cece;"':'';
            ?>
            <tr title="วันที่กรอกฟอร์ม <?=date2str($rowscore['RequestDate'])?>" <?=$co?>>
                <td align="left" width="5%">
                <?php if($result['eval_ID']>0 and $rowscore['Sel']>0){ ?>
                    <i class="icon checkP" style="position: absolute;" ></i>
                <?php
                }else if($StatusForm>0){ ?>
                    <input type="checkbox" name="no<?php echo $x;?>" value="<?=$rowscore['RequestID'];?>"
                        onclick="checkallun(this.checked,document.getElementById('Processform'))">
                    
                <?php 
                } 
                echo "<label class=\"namecheckbox\">$x</label>";
                 ?> 
                </td>
                <td align="left">
                    <?php echo $rowscore['PName'].$rowscore['Name']." ".$rowscore['Surname']; ?>
                </td>
                <td><?=$rowscore['PositionName'];?></td>
                <td><?=$rowscore['FacNameT'] ?></td>
                <td><?=date2str($rowscore['RequestDate'],1);?></td>
                <td title="สายงาน (วิชาการ/สนับสนุน)" align="center">
                    <?php if($result['eval_ID']>0 || $StatusForm>0){echo $rowscore['score1'];}?>
                </td>
                <td title="ที่อยู่ตามทะเบียนบ้าน" align="center">
                    <?php if($result['eval_ID']>0 || $StatusForm>0)echo $rowscore['score2'];?>
                </td>
                <td title="ประสบภัยธรรมชาติ" align="center">
                    <?php if($result['eval_ID']>0 || $StatusForm>0)echo $rowscore['score3'];?>
                </td>
                <td title="สถานภาพ (การสมรส)" align="center">
                    <?php if($result['eval_ID']>0 || $StatusForm>0)echo $rowscore['score41'];?>
                </td>
                <td title="บุตร/ธิดา" align="center">
                    <?php if($result['eval_ID']>0 || $StatusForm>0)echo $rowscore['score42'];?>
                </td>
                <td title="อายุราชการ" align="center">
                    <?php if($result['eval_ID']>0 || $StatusForm>0)echo $rowscore['score5'];?>
                </td>
                <td align="center">
                    <?php if($rowscore['TotalScore']!="")echo number_format($rowscore['TotalScore'],2); ?>
                </td>
                <td align="center">
                    <a href="#" onclick="FormAccept(<?=$rowscore['RequestID'];?>,0)" id="FormAccept"
                        class="tooltip acc"><i class="icons eye" aria-hidden="true"></i><lable
                            class="tooltiptext">ดูข้อมูล</lable></a>
                </td>
            </tr>
            <?php  } if($x<=0){//end while loop ?>
                <tr>
                    <td colspan="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    </form>