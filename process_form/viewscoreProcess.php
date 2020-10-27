<?php include '../function/connectDB.php'; include '../function/date.php';
$RoomType=$_POST['RoomType'];
$eval_quarter=$_POST['eval_quarter'];
$eval_year=$_POST['eval_year'];

$sqlVcheckscore="SELECT *,score1+score2+score3+score41+score42+score5 as Totols FROM v_eval_form WHERE RoomType=$RoomType AND eval_quarter=$eval_quarter AND eval_year=$eval_year Order BY Totols DESC";
$result=mysqli_query($condb,$sqlVcheckscore);
?>
<div class="container">
    <div class="row mt5 ">
        <h1> ประกาศรายชื่อผู้ผ่านเข้ารอบรอจัดสรรที่พักอาศัย </h1>
    </div>
    <div>ผู้มีรายชื่อดังต่อไปนี้ กรุณาติดต่อผู้จัดการที่พักอาศัย</div>
    <div class="row mt10">
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
                </tr>
            </thead>
            <tbody id="myTable">
                <?php $x = 0;
                while ($row = mysqli_fetch_array($result)) {$x++;
            ?>
                <tr title="วันที่กรอกฟอร์ม <?=date2str($row['RequestDate'])?>"
                    <?=($row['eval_status']==2)?'style="color: #007100;"':"";?>>
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
                </tr>
                <?php } ?>
                

            </tbody>
        </table>
    </div>
</div>