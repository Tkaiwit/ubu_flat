<?php include '../function/connectDB.php';
$eval_ID=$_POST['eval_ID'];
$sql="SELECT COUNT(*) rec FROM eval_form WHERE eval_ID=$eval_ID AND eval_status=2";
$getF=mysqli_fetch_assoc(mysqli_query($condb,$sql));
if($getF['rec']<=0){
    $slqevalscore ="DELETE FROM eval_score WHERE eval_ID=$eval_ID ";
    if(mysqli_query($condb,$slqevalscore)){
        echo 1;
    }else{
        echo 3;
    }
}else{
    echo 2;
}




?>
