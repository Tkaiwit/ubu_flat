<?php session_start(); include '../function/connectDB.php'; include '../function/date.php'; 
$ExpDate=date("Y-m-d");
$sqlex="SELECT ExpID, ExpTypeID, PayFor, NamePayfor, BuildingID, MonthlyPeriod, Yearly FROM expense 
WHERE ExpTypeID=$_POST[ExpTypeIDs] ";
if($_POST['ExpTypeIDs']!=1){
    $sqlex.="AND NamePayfor='$_POST[lablePayFor]' ";
}else{
    $sqlex.="AND PayFor=$_POST[PayFor] ";
}
$sqlex.=" AND BuildingID=$_POST[BuildingIDs] AND
MonthlyPeriod='$_POST[MonthlyPeriod]' AND Yearly='$_POST[Yearly]'";
$getex=mysqli_fetch_assoc(mysqli_query($condb,$sqlex));
$NamePayFor=(isset($_POST['NamePayFor']))?$_POST['NamePayFor']:"NULL";
if($getex['ExpID']<1){
    $ex="INSERT INTO expense( ExpDate, ExpTypeID, ";
    if($_POST['ExpTypeIDs']!=1){
        $ex.=" NamePayfor, ";
    }else{
        $ex.=" PayFor, ";
    }
    $ex.="  BuildingID, MonthlyPeriod, Yearly, Amount, Notics, PayBy) 
    VALUES ('$ExpDate',$_POST[ExpTypeIDs], ";
    if($_POST['ExpTypeIDs']!=1){
        $ex.=" '$_POST[lablePayFor]', ";
    }else{
        $ex.=" '$_POST[PayFor]', ";
    }
    $ex.=" $_POST[BuildingIDs],'$_POST[MonthlyPeriod]','$_POST[Yearly]',$_POST[Amount],'$_POST[Notics]',$_SESSION[UserID])";
    if(mysqli_query($condb,$ex)){
        echo 1;
    }else{
        echo 3;
    }
}else{
    echo 2;
}

?>