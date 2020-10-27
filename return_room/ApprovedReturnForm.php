<?php session_start(); include '../function/connectDB.php';
$getresident="SELECT ResidentID, RoomID, EndDate FROM resident WHERE ResidentID=$_POST[ResidentID] AND EndDate IS NULL";
$gresident=mysqli_fetch_assoc(mysqli_query($condb,$getresident));
$ResidentID=$gresident['ResidentID'];$RoomID=$gresident['RoomID'];$DateNow=date("Y-m-d");
if($ResidentID>0){
    $v_returnForm="SELECT ResidentID, EvalExpense FROM v_return_form WHERE ResidentID=$_POST[ResidentID] ";
    $getvrft=mysqli_fetch_assoc(mysqli_query($condb,$v_returnForm)); $EvalExpense=$getvrft['EvalExpense'];
    $Returnform="UPDATE return_form SET 
	keycard=1,
	AcceptPayment=$EvalExpense,
	acceptby=$_SESSION[UserID]
    WHERE ResidentID=$ResidentID";
    (mysqli_query($condb,$Returnform))?$st=1:$st=2;
    $RooM="UPDATE room SET 
	RoomStatus=1
    WHERE RoomID=1";
    (mysqli_query($condb,$RooM))?$st=1:$st=2;
    $Resident="UPDATE resident SET
	EndDate='$DateNow',
	ActiveStatus=0 
    WHERE ResidentID=$ResidentID";
    (mysqli_query($condb,$Resident))?$st=1:$st=2;
    if($st==1){
        echo 1; 
        echo chr(5);
        echo 'ชำระเงินแล้ว';
    }else{
        echo $Resident.";".$v_returnForm.";".$Returnform.';'.$RooM;
    }
}else{
    echo chr(5);
    echo 3;
}
?>