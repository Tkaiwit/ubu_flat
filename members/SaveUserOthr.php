<?php include '../function/connectDB.php';  include '../function/date.php';
$Passwd=$_POST['Password']; $Email=$_POST['Email'];
$chmember="SELECT UserID,UserLogin FROM members WHERE UserLogin='$_POST[UserLogin]' ";
$chmemberrow=mysqli_fetch_assoc(mysqli_query($condb,$chmember));
$SocialID=($_POST['SocialID']!="")?$_POST['SocialID']:NULL;
$UserID=$chmemberrow['UserID'];
$valid_tru=date("Y-m-d",strtotime('+2 year'));
if($UserID<=0){
    $memberUserType="INSERT INTO members(UserLogin,Passwd,SocialID,Email,UserPNameT,UserNameT,UserSNameT,FacID,DeptID,UserType,PositionID,valid_tru) 
    VALUES('$_POST[UserLogin]',MD5('".$Passwd."'),'$SocialID','$Email','$_POST[UserPNameT]','$_POST[UserNameT]','$_POST[UserSNameT]',
    $_POST[FacID],'$_POST[DeptID]',$_POST[UserType],$_POST[PositionID],'$valid_tru')";
    if(mysqli_query($condb,$memberUserType)){
        echo 1;
    }else{
        echo $memberUserType;
    }        
}else{
    echo 3;
}
?>