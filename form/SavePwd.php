<?php include '../function/connectDB.php';
$US=$_POST['Uid']; $P=md5($_POST['Pwd']);
$sql="UPDATE members SET Passwd='$P' WHERE SocialID='$US' OR UserLogin='$US' ";
if(mysqli_query($condb,$sql)){
    echo 1;
}else{
    echo 2;
}
?>