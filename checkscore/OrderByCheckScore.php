<?php session_start(); include '../function/date.php'; include '../function/connectDB.php';
$RoomType=$_POST['RoomType'];
$eval_quarter=$_POST['eval_quarter'];
$eval_year=$_POST['eval_year'];
$sqlVcheckscore="SELECT *,score1+score2+score3+score41+score42+score5 as Totols FROM v_eval_form ";
$sqlVcheckscore.=(($RoomType>0)?" WHERE RoomType =$RoomType":" WHERE RoomType=0 ");
$sqlVcheckscore.=(($eval_quarter>0)?" AND eval_quarter=$eval_quarter":" AND eval_quarter=0");
$sqlVcheckscore.=" AND eval_year=$eval_year Order BY Totols DESC";
$result=mysqli_query($condb,$sqlVcheckscore);
?>
<table class="table1 table-sm">
    <thead>
        <tr>
            <th width="5%" align="left">
                <label class="namecheckbox">#ที่</label>
            </th>
            <th align="left">ชื่อ - นามสกุล</th>
            <th align="left">ตำแหน่ง</th>
            <th align="left">คณะ/หน่วยงาน</th>
            <th>คะแนนรวม</th>
            <th align="center">อาคาร</th>
            <th align="center">หมายเลขห้อง</th>
            <th>สถานะ</th>
            <?php if($_SESSION['UserType']==9){
                echo"<th width=\"10%\">จัดการ</th>";
            } ?>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php $x = 0;
                while ($row = mysqli_fetch_array($result)) {$x++;
                    if($_SESSION['UserType']==8){
                        $btn="AllocateForm(".$row['RequestID'].','.$row['StaffID'].")";
                    }else{
                        $btn="AllocateForm(".$row['RequestID'].','.$row['StaffID'].','.$row['eval_status'].")";
                    }
            ?>
        <tr title="วันที่กรอกฟอร์ม <?=date2str($row['RequestDate'])?>">
            <td align="left" width="5%">
                <label class="namecheckbox"><?php echo $x;?></label>
            </td>
            <td align="left">
                <?php echo $row['PName'].$row['Name']." ".$row['Surname']; ?>
            </td>
            <td>
                <?=$row['PositionName'];?>
            </td>
            <td>
                <?=$row['FacNameT'] ?>
            </td>
            <td align="center">
                <?=totolScore($row['score1'],$row['score2'],$row['score3'],$row['score41'],$row['score42'],$row['score5']);?>
            </td>
            <td align="center"><?=$row['BuildingName'];?></td>
            <td align="center"><?=$row['RoomName'];?></td>
            <td id="stname<?php echo $row['RequestID'];?>" align="center">
                <?=($row['eval_status']==1)?"ยังไม่ได้จัดสรร":"จัดสรรแล้ว";?>
            </td>
            <?php if($_SESSION['UserType']==9){ ?>
            <td align="center">
                <a href="#" onclick="FormAccept(<?=$row['RequestID'];?>,0)" id="FormAccept" class="tooltip acc"><i
                        class="icons eye" aria-hidden="true"></i><lable class="tooltiptext">ดูข้อมูล</lable></a>
                <label style="color: #a8a4a4;">|</label>
                <a href="#" onclick="<?=$btn;?>">
                    <i class="icons setting"></i>
                </a>
            </td>
            <?php } ?>
        </tr>
        <?php } if($x<=0){ ?>
        <tr>
            <td colspan="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
        <?php } ?>
    </tbody>
</table>