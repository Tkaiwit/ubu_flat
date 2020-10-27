<?php 
require '../function/connectDB.php';
    echo$equipment="DELETE FROM equipment WHERE EQName='$_POST[FValue]' AND RoomID=$_POST[RoomID]";
    if(mysqli_query($condb, $equipment)){
        echo 1;
    }else{
        echo 2;
    }
?>