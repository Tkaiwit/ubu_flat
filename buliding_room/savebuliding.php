<?php 
require '../function/connectDB.php';

$BuildingID=$_POST['BulidingID'];
$FName=$_POST['FName'];
$FValue=$_POST['FValue'];
if ($BuildingID>0) {
    $sql="UPDATE building SET  $FName='$FValue' WHERE BuildingID=$BuildingID ";
    if(mysqli_query($condb, $sql)){
        echo 1;
    }else{
        echo 2;
    }
}else{
    echo 3;
}
?>