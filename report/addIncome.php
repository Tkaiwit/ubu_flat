<?php include '../function/connectDB.php';
$MonthR=$_POST['MonthR'];$YearR=$_POST['YearR'];$income=$_POST['income'];$expend=$_POST['expend'];$net=$_POST['net'];
$getBalance="SELECT SUM(balance) as balance FROM income ";
$gbalance=mysqli_fetch_assoc(mysqli_query($condb,$getBalance));
$balance=$gbalance['balance']+$net;
$sql="INSERT INTO income(monthly, yearly, income, expend, net, balance) VALUES ($MonthR,$YearR,$income,$expend,$net,$balance)";
if(mysqli_query($condb,$sql)){
    echo 1;
    echo chr(5);
    echo "ยอดเงินคงเหลือสุทธิ ".number_format($balance,2)." บาท";
}else{
    echo $getBalance.";".$sql;
}
?>
