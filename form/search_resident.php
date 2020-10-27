<?php include '../function/date.php'; include '../function/connectDB.php';
$BuildingID=$_POST['BuildingID'];
$connecter="";
$searchmember="SELECT * FROM v_resident ";
if($_POST['RoomName']!='' || $_POST['UserNameT']!='' || $BuildingID>0){
    $searchmember.=" WHERE ";
}


if($_POST['RoomName']!='' || $_POST['UserNameT']!=''){
    
    if($_POST['RoomName']!=''){
        $connecter.=" RoomName=$_POST[RoomName] ";
    }
    if($_POST['UserNameT']!=''){
        if($connecter!="")$connecter.=" OR";
        $connecter.=" UserNameT LIKE '%$_POST[UserNameT]%' OR UserSNameT LIKE '%$_POST[UserNameT]%' ";
    }
    $connecter="(".$connecter.")";
}
if($BuildingID>0){
    if($connecter!=""){$connecter.=" AND ";}
    $connecter.=" BuildingID=$BuildingID";
}
$searchmember.="$connecter ORDER BY BuildingID";
$rssearchmember=mysqli_query($condb,$searchmember);
$stylecontent="margin: auto;"
?>
<div>
    <h3>รายชื่อผู้พักอาศัย ทั้งหมด</h3>
    <div align="center" class="req-edit" style="width: 100%;">
    <table class="table1 table-sm">
        <thead>
            <tr>
                <th style="width: 6%;">#ลำดับ</th>
                <th style="width: 10%;" align="left">อาคาร</th>
                <th style="width: 6%;" align="left">ห้อง</th>
                <th align="left">ชื่อ-นามสกุล</th>
                <th align="left">ตำแหน่ง</th>
                <th align="left">สังกัด/คณะ</th>
                <th align="left">ภาควิชา</th>
            </tr>
        </thead>
        <tbody id="myTable">
        <?php 
        $x = 0; 
        while ($row = mysqli_fetch_array($rssearchmember)) { $x++;
        ?>
            <tr>
                <td align="center"><?php echo $x;?></td>
                <td align="left"><?=$row['BuildingName'];?></td>
                <td align="left"><?=$row['RoomName']?></td>
                <td align="left"><?=$row['UserPNameT'].$row['UserNameT']." ".$row['UserSNameT'];?></td>
                <td align="left"><?=$row['PositionName'];?></td>
                <td align="left" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;"><?=$row['FacNameT'];?></td>
                <td align="left"><?=$row['DeptNameT'];?></td>
            </tr>
        <?php  } ?>
        </tbody>
    </table>
    </div>
</div>
<?php if($x<=0){
    echo "<div style=\"color:red;text-align:center;\">ไม่พบข้อมูล</div>";  
    exit;
}
?>