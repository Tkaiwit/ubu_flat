<?php include '../function/connectDB.php';
$SemiCommitee=$_POST['SemiCommitee'];
$LT=$_POST['LT'];
$LeaderType="UPDATE members SET LeaderType=$LT ,SemiCommitee=$SemiCommitee WHERE UserID=$_POST[UserID] ";
if(mysqli_query($condb,$LeaderType)){
    echo 1;
}else{
    echo $LeaderType;
}
?>