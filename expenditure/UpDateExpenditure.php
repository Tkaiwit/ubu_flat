<?php session_start(); include '../function/connectDB.php'; include '../function/date.php'; 
if($_POST){
    $sql="UPDATE expense SET ExpTypeID=$_POST[ExpTypeIDs], ";
    if($_POST['ExpTypeIDs']!=1){
        $sql.=" NamePayfor='$_POST[lablePayFor]', ";
    }else{
        $sql.=" PayFor=$_POST[PayFor], ";
    }
    $sql.=" BuildingID=$_POST[BuildingIDs],
    MonthlyPeriod=$_POST[MonthlyPeriod],Yearly=$_POST[Yearly],Amount=$_POST[Amount],Notics='$_POST[Notics]',
    PayBy=$_SESSION[UserID]
     WHERE ExpID=$_POST[ExpID]";
     if(mysqli_query($condb,$sql)){
        echo 1;
     }else{
         echo 2;
     }
}
?>