<?php require '../function/connectDB.php';
$sqlchbuilding="SELECT * FROM building WHERE BuildingName='$_POST[BulidingName]' AND FloorCount=$_POST[BulidingFrool] 
AND RoomCount='$_POST[BulidingCountR]' AND CompensationRate=$_POST[BulidingPrice] AND CommitteeRate=$_POST[BulidingPrices];";
$res=mysqli_fetch_assoc(mysqli_query($condb,$sqlchbuilding));
$BuildingID=$res['BuildingID'];
if($BuildingID<=0){
    $BName = $_POST['BulidingName'];
    $BCountR = $_POST['BulidingCountR'];
    $BFrool = $_POST['BulidingFrool'];
    $BPrice = $_POST['BulidingPrice'];
    $BPrices = $_POST['BulidingPrices'];
    
    $sql = "INSERT INTO `building`( `BuildingName`, `RoomCount`, `FloorCount`, `CompensationRate`, `CommitteeRate`) 
     VALUES ('$BName',$BCountR,$BFrool,$BPrice,$BPrices)";
    if(mysqli_query($condb,$sql)){
        echo 1;
    }else{
        echo 2;
    }
}else{
    echo 3;
}
    

?>