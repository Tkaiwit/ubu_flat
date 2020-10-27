<?php include '../function/connectDB.php'; include '../function/date.php';
$ResidentID=$_POST['ResidentID'];
$return_d=$_POST['return_d'];
$Cause=$_POST['Cause'];
$DateNow=date("Y-m-d");
$sqlrtfrm="SELECT ResidentID FROM return_form WHERE ResidentID=$ResidentID";
$row=mysqli_fetch_assoc(mysqli_query($condb,$sqlrtfrm));
if($row<1){
    $return_form="INSERT INTO return_form( ResidentID, CreateDate, ReturnDate, Cause)
    VALUES ($ResidentID,'$DateNow','$return_d','$Cause')";
    if(mysqli_query($condb,$return_form)){
        echo 1;
    }else{
        echo $return_form;
    }
    
}
?>

