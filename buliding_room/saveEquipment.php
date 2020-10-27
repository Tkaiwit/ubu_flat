<?php 
require '../function/connectDB.php';
$status=$_POST['status']*1;


if ($status==1){
    $chEQ="SELECT * FROM equipment WHERE EQID='$_POST[FValue]' AND RoomID=$_POST[RoomID]";
    $getEQ=mysqli_fetch_assoc(mysqli_query($condb,$chEQ));
    if ($getEQ['RoomID']>0){ echo 3; exit;}
}



    if($status==1){
        $equipment="INSERT INTO equipment( EQID, RoomID) VALUES ('$_POST[FValue]',$_POST[RoomID])";
    }else{  
        $equipment="DELETE FROM equipment WHERE EQID='$_POST[FValue]' AND RoomID=$_POST[RoomID]";
    }
    if(mysqli_query($condb, $equipment)){
        echo 1;
    }else{
        echo 2;
    }


?>