<?php include 'inc/toptitle.php'; include 'function/connectDB.php'; include './function/date.php'; include './function/iconshow.php';

$sqlRoomType="SELECT FieldName,FieldCode,ValueT,ValueE FROM allvars WHERE FieldName = 'RoomType' and FieldCode !=4 and FieldCode !=6 and FieldCode !=5 ORDER BY ValueE";
$resRoomType=mysqli_query($condb,$sqlRoomType); 

$sqlfaculty="SELECT * FROM faculty "; 
$resfaculty=mysqli_query($condb,$sqlfaculty); 

$sqlreq = "SELECT * FROM v_request_form WHERE FormStatus =1 AND FormAcceptBy IS NULL ORDER BY RequestDate DESC";
    $resureq = mysqli_query($condb,$sqlreq);
 ?>

<div class="container box" style="margin-top: 10px">
    <div>
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / 
        <label style="color: #3f99e6;font-weight: 600;">จัดการคำขอที่พักอาศัย</label>
    </div>
    <h2>จัดการคำขอที่พักอาศัย</h2>
    <div>
        <div class="box-menu row">
            <div class="col-4">
                <div class="mr-ml">
                    <label class="label-title" id="label-title">ประเภทห้อง</label><br>
                    <select name="residentlist" id="residentlist" onchange="odbresident()">
                        <option value="0">ประเภทห้องทั้งหมด</option>
                        <?php while($rowRoomType=mysqli_fetch_array($resRoomType)){?>
                        <option value="<?=$rowRoomType['FieldCode'];?>"><?=$rowRoomType['ValueT'];?></option>
                        <?php } ?>
                    </select>
                </div>

            </div>
            <div class="col-8" style="margin-top: 35px;">
                <input type="checkbox" onclick="odbresident()" name="FormStatus" id="FormStatus1" checked><label
                    class="namecheckbox">ยังไม่ได้ตรวจรับเอกสาร</label>
                <input type="checkbox" onclick="odbresident()" name="FormStatus" id="FormStatus2"><label
                    class="namecheckbox">ตรวจ/รับเอกสารแล้ว</label>
                <input type="checkbox" onclick="odbresident()" name="FormStatus" id="FormStatus3"><label
                    class="namecheckbox">ยกเลิกคำขอจัดสรรฯ</label>
            </div>
        </div>
        <br>
        <!-- <div>
            <input type="text" onkeyup="Searchreq()" placeholder="Search" style="width: 100%;padding: 5px 12px;">
        </div><br> -->
        <div style="min-height: 350px;">
        <lable id="lresident">
            <table class="table1 table-sm">
                <thead>
                    <th>#ที่</th>
                    <th align="left">ชื่อ - นามสกุล</th>
                    <th align="left">ตำแหน่ง</th>
                    <th align="left">คณะ/หน่วยงาน</th>
                    <th>วันที่บรรจุ</th>
                    <th>วันที่กรอกฟอร์ม</th>
                    <th align="left">ประเภทห้อง</th>
                    <th width="10%">จัดการ</th>
                </thead>
                <tbody id="myTable">
                    <?php $x = 0;
                while ($row = mysqli_fetch_array($resureq)) { $x++;
            ?>
                    <tr class="<?=($row['FormAcceptBy']==NULL)?'td-r':(($row['FormStatus']==1)?'td-y':'td-d'); ?>">
                        <td align="center">
                            <?php echo $x;?>
                        </td>
                        <td align="left">
                            <?php echo $row['PName'].$row['Name']." ".$row['Surname']; ?>
                        </td>
                        <td align="left">
                            <?=$row['PositionName'];?>
                        </td>
                        <td>
                            <?=$row['FacNameT'];?>
                        </td>
                        <td align="center">
                            <?=date2str($row['EmployDate']); ?>
                        </td>
                        <td align="center">
                            <?=date2str($row['RequestDate'],0); ?>
                        </td>
                        <td>
                            <?=nameRoomType($row['RoomType']);?>
                        </td>
                        <td align="center">
                            <?php if($row['FormAcceptBy']==NULL){ ?>
                            <i class="lds-dual-ring" style="color:#FFC300;" aria-hidden="true"></i>
                            </label>
                            <?php } else {?>
                            <i class="<?=iconFormStatus($row['FormStatus'])?>" aria-hidden="true"></i>
                            <?php } ?>
                            <label style="color: #a8a4a4;">|</label>
                            <a href="#" onclick="FormAccept(<?=$row['RequestID'];?>)" id="FormAccept"
                                class="tooltip acc"><i class="icons filesearch" aria-hidden="true"></i><lable
                                    class="tooltiptext">ดูข้อมูล</lable></a>
                        </td>
                    </tr>
                    <?php }if($x<=0){ ?>
                    <tr>
                        <td colspan="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </lable>
        </div>
        <div>
            <b>หมายเหตุ</b><br>
            <i class="lds-dual-ring" style="color:#FFC300;"></i> : รอตรวจสอบ
            <i class="<?=iconFormStatus(2)?>"></i> : ตรวจ/รับเอกสารแล้ว
            <i class="<?=iconFormStatus(1)?>"></i> : ยกเลิกคำขอจัดสรรฯ
            <i class="icons filesearch" style="color:#2f5ba8;"></i> : ดูข้อมูล
        </div>
    </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>