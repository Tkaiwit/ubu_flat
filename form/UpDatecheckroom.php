<?php session_start(); include '../function/connectDB.php';
$updateRET="UPDATE return_form SET $_POST[VName]='$_POST[Value]',processby=$_POST[processby] WHERE ReturnID=$_POST[ReturnID]";
if(mysqli_query($condb,$updateRET)){
    echo 1;
}else{
    echo 2;
}
?>