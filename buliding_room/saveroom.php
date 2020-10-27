<?php 
if($_POST){
	require '../function/connectDB.php';
    $rid = $_POST['roomid'];
    $rname = $_POST['roomnaem'];
    $radderss = $_POST['roomaddress'];
    $rfloor = $_POST['roomfloor'];
    $rstatus = $_POST['roomstatus'];
    $rtype = $_POST['roomtype'];
    $rrate = $_POST['roomprice']; 
    $rpay = $_POST['roompay'];
    $Notics = $_POST['Notics']; 

    $sql="UPDATE room SET RoomName='$rname' , RoomAddress='$radderss', Floor=$rfloor , RoomStatus =$rstatus , ";
    $sql .=" RoomType=$rtype , RoomRate=$rrate,InsurantRate=$rpay,Notics='$Notics' WHERE RoomID= $rid";
    if(mysqli_query($condb,$sql)){
        echo 1;
    }else{
        echo $sql;
    }
}

?>