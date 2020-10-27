<?php
if($_GET){
    require '../function/connectDB.php';
    $rid=$_GET['rid'];
    $id=$_GET['id'];
    $sql="DELETE FROM `room` WHERE RoomID=$rid";
    if(mysqli_query($condb,$sql)){
        header('Location: ../manager_buliding-room.php?id=$id');
    }
}

?>