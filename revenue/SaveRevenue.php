<?php session_start(); header('content-type:text/html;charset=utf-8');
set_time_limit(0);
// ob_start();

ob_implicit_flush(true);
// ob_end_flush();
include '../function/connectDB.php'; include '../revenue/functionarray.php';

$rowmax=80;
    $monthlycharge=$_POST['monthlycharge'];
    if($_SESSION['UserType']==6){
        $query = "SELECT MC.ChargeID, RS.ResidentID, R.BuildingID, R.RoomID, R.ElecRate, RS.RoomName, MC.e_prevUnit, MC.e_curUnit, MC.MonthlyPeriod, MC.Yearly 
        FROM	room R 
            LEFT JOIN v_monthlycharge MC ON MC.RoomID=R.RoomID  
            LEFT JOIN v_resident RS ON RS.ResidentID=MC.ResidentID WHERE MonthlyPeriod = $_POST[monthly] AND Yearly= $_POST[yearly]";
    }else if($_SESSION['UserType']==7){
        $query = "SELECT MC.ChargeID,RS.ResidentID,R.BuildingID,R.RoomID,R.WaterRate,RS.RoomName,Mc.w_prevUnit e_prevUnit, MC.w_curUnit e_curUnit, MC.MonthlyPeriod,MC.Yearly 
        FROM	room R 
            LEFT JOIN v_monthlycharge MC ON MC.RoomID=R.RoomID  
            LEFT JOIN v_resident RS ON RS.ResidentID=MC.ResidentID
            WHERE MonthlyPeriod = $_POST[monthly] AND Yearly= $_POST[yearly]";
    }
    $res=mysqli_query($condb,$query);
    $resident=array();
    while($getrs=mysqli_fetch_assoc($res)){
        $resident[]=$getrs;
    }
    $monthly=$_POST['monthly']; 
    $yearly=$_POST['yearly'];
    $date=date("Y-m-d H:i:s");
    
    $dt=compostarray($monthlycharge,$resident);
    // print_r($dt);
    $t1=time();
    if($_SESSION['UserType']==6){ //ไฟฟ้า
        $mysqli_statement=mysqli_prepare( $condb, 'UPDATE monthlycharge SET e_curUnit=?, e_price=?, e_service=?, e_FT=?, e_VAT=? WHERE ChargeID=?' );
        mysqli_stmt_bind_param( $mysqli_statement, 'iddidi', $e_curUnit, $e_price, $e_service, $e_FT, $e_VAT, $ChargeID );
    }else if($_SESSION['UserType']==7){//ประปา
        $mysqli_statement = mysqli_prepare( $condb, 'UPDATE monthlycharge SET w_curUnit=?, w_price=?, w_service=?, w_VAT=? WHERE ChargeID=?' );
        mysqli_stmt_bind_param( $mysqli_statement, 'iddii', $e_curUnit, $e_price, $e_service, $e_VAT, $ChargeID );
    
    }
    
    $max=count($dt);
    for($i=1;$i<=$max;$i++){ 
            $e_curUnit = $dt[$i]['e_curUnit'];
            $e_price = $dt[$i]['e_price'];
            if($_SESSION['UserType']==6){$e_FT = $dt[$i]['FT'];}
            $e_service = $dt[$i]['e_service'];
            $e_VAT = $dt[$i]['e_VAT'];
            $ChargeID = $dt[$i]['ChargeID'];
            mysqli_stmt_execute( $mysqli_statement );
            $persen=($i/$max)*100;
            ob_flush();
                echo "1:".number_format($persen,0);
        
    }
    $t2=time();
    // echo $t2-$t1;
    // ob_end_flush();
    exit;

?>