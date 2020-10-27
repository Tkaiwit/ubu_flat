<?php session_start(); include '../function/connectDB.php'; include '../function/date.php';$UserID=$_SESSION["UserID"];
$RequestID= $_POST['RequestID'];
$RoomType = $_POST['RoomType'];
$eval_quarter=$_POST['eval_quarter'];
$eval_year=$_POST['eval_year'];
$eval_condition=$_POST['eval_condition'];
$eval_Date=date("Y-m-d");
if($eval_quarter==1){$mm="4";}elseif($eval_quarter==2){$mm="8";}elseif($eval_quarter==3){$mm="12";}else{$mm='0';};
$sqlevalscore="SELECT eval_ID,eval_Date FROM eval_score WHERE RoomType=$RoomType AND eval_quarter=$eval_quarter AND eval_year=$eval_year AND eval_condition='$eval_condition' ";
$row=mysqli_fetch_assoc(mysqli_query($condb,$sqlevalscore));
if($row['eval_ID']<1){
    $slqevalscore ="INSERT INTO eval_score ( eval_quarter, eval_year, UserID, RoomType,eval_condition) ";
    $slqevalscore .=" VALUES ($eval_quarter,$eval_year,$UserID,$RoomType,'$eval_condition')";
    mysqli_query($condb,$slqevalscore);
    $eval_ID=mysqli_insert_id($condb);
    $sqleval_from="INSERT INTO eval_form(eval_ID, RequestID, score1, score2, score3, score41, score42, score5) ";
    $sqleval_from.="SELECT $eval_ID evl_ID, RequestID, PositonWeight score1,AddressWeight score2, DissaterWeight score3,MaritalStatusWeight score41, ChildrenWeight score42, 
    cal_workyear2Score('$eval_Date',EmployDate) score5 FROM v_request_form WHERE RequestID IN ($RequestID)";
    mysqli_query($condb,$sqleval_from);
}else{
}

// echo "<input type=\"button\" id=\"cancelprocess\" class=\"btn-sm btn-sm-drag\" value=\"ยกเลิกประมวล\"
// onclick=\"cancelprocessform()\">";
?>
