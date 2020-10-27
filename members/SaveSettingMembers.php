<?php include '../function/connectDB.php';
$members="UPDATE members SET UserType=$_POST[UserType] WHERE UserID=$_POST[UserID] ";
if(mysqli_query($condb,$members)){
    echo 1;
}else{
    echo 2;
}

?>