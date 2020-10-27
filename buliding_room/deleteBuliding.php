<?php
if($_GET){
    require '../function/connectDB.php';
    $id=$_GET['id'];
    echo$sql="DELETE FROM `building` WHERE BuildingID=$id";
    if(mysqli_query($condb,$sql)){
        header('Location: ../manager_buliding-room.php');
    }
}

?>