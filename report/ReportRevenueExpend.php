<?php include '../function/connectDB.php'; include '../function/date.php'; 
$getExpend="SELECT VM.BuildingID,VM.BuildingName,VM.MonthlyPeriod,VM.Yearly,SUM(VM.RoomRate) RoomRate,SUM(VM.e_price) e_price, SUM(VM.w_price) w_price,
Ex.Amount ExAmount
FROM v_monthlycharge VM LEFT JOIN ( SELECT BuildingID,MonthlyPeriod,Yearly,SUM(Amount) Amount FROM expense GROUP BY BuildingID,MonthlyPeriod,Yearly) Ex ON VM.BuildingID=Ex.BuildingID AND VM.MonthlyPeriod=Ex.MonthlyPeriod AND VM.Yearly=Ex.Yearly
GROUP BY VM.BuildingID,VM.MonthlyPeriod,VM.Yearly HAVING VM.MonthlyPeriod =$_POST[monthly] AND VM.Yearly=$_POST[yearly]
 
 UNION 
 SELECT 0 BuildingID, 'ไม่ระบุแฟลต' BuildingName,MonthlyPeriod, Yearly,0 RoomRate,0 e_price,0 w_price,
SUM(Amount) ExAmount 
FROM expense GROUP BY BuildingID, MonthlyPeriod, Yearly  HAVING MonthlyPeriod =$_POST[monthly] AND $_POST[yearly] AND BuildingID=0";
$reuslt=mysqli_query($condb,$getExpend);
?>

<div class="flex-container">
    <?php $x=0;
              while($gExpend=mysqli_fetch_assoc($reuslt)){ $x++;
                $BID=$gExpend['BuildingID'];
                echo "<div>";
                  echo "<dt><b>$gExpend[BuildingName]</b></dt>";
                  echo "<dt>".date2str($_POST['yearly']."-".$_POST['monthly']."-01")."</dt>";
                  echo "<div class='row'><div class='col-8 left'><label>รายรับ ค่าบำรุง </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,3)'> ".number_format($gExpend['RoomRate'],2)."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>รายจ่าย </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,1)'> ".number_format($gExpend['ExAmount'],2)."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><lable>จำนวนห้องทั้งหมด </lable></div>";
                  echo "<div class='col-4'><b> ".number_format($gExpend['RoomRate']+$gExpend['ExAmount'],2)."</b></div></div>";
                echo "</div>";
                
              }
              if($x<=0){
                echo '<div style="
                width: 100%;
                height: 544px;
            ">ไม่พบข้อมูล</div>';
              } ?>
</div>