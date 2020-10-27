<?php session_start(); require '../function/connectDB.php';
$room="SELECT * FROM v_room WHERE RoomID=$_POST[RoomID]";
$getroom=mysqli_fetch_assoc(mysqli_query($condb,$room));
?>
<form id="FormEquipment" class="FormEquipment">
    <div class=container>
        <div class=row>
            <h3>ข้อมูลครุภัณฑ์</h3>
        </div>
        <div class="row">
            <div class="col-6">
                <label><b>หมายเลขห้อง :</b> <?=$getroom['RoomName'];?></label>
                <input type="hidden" id="RoomIDEQ" value="<?=$_POST['RoomID'];?>">
            </div>
            <div class="col-6">
                <label><b>อาคาร :</b> <?=$getroom['BuildingName'];?></label>
            </div>
        </div>
        <div class="mb10 mt10">
            <b>รายการครุภัณฑ์มีดังนี้</b>
        </div>
    <?php $EQ="SELECT A.*,V1.sel 
            FROM allvars A LEFT JOIN (select EQID , IF(EQID>0,1,0) sel FROM equipment WHERE RoomID=$_POST[RoomID] ) V1 ON A.FieldCode=V1.EQID  
            WHERE TableName='equipment' AND FieldName='EQID' Order BY FieldCode";
            $getEQ=mysqli_query($condb,$EQ);
            while($row=mysqli_fetch_assoc($getEQ)){
        ?>
        <div style="width:48% ;display:inline-block">
            <input <?=($_SESSION['UserType']!=9)?'disabled="disabled"':"";?> type="checkbox" style="margin-top: 4px;" <?php if($row['sel']==1){echo "checked";} ?> value="<?=$row['FieldCode']?>">
            <label class="namecheckbox"><?=$row['ValueT']?></label>
        </div>
    <?php }?>
    </div>
</form>