<?php include '../function/connectDB.php'; include '../function/date.php';
$sql="SELECT BuildingID,BuildingName,MonthlyPeriod,Yearly,SUM(RoomRate) RoomRate,SUM(e_price) e_price, SUM(w_price) w_price
FROM v_monthlycharge  GROUP BY BuildingID,MonthlyPeriod,Yearly HAVING MonthlyPeriod =6 AND Yearly=2020";
$query=mysqli_query($condb,$sql);
?>
<b style="color:rgb(117, 117, 117);">ข้อมูลรายงานสถานะห้อง</b> <br>
<label style="color:rgb(189, 189, 189;">อัพเดตข้อมูลเมื่อวันที่ <?=date2str(date("Y-m-d"),0,0);?></label>
<div class="flex-container">
    <?php
              while($row=mysqli_fetch_assoc($query)){
                $BID=$row['BuildingID'];
                echo "<div>";
                  echo "<dt><b>$row[BuildingName]</b></dt>";
                  echo "<div class='row'><div class='col-8 left'><label>มีผู้พักอาศัย </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,3)'> ".$row['AmountElec']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>ว่าง พร้อมใช้งาน </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,1)'> ".$row['AmountWater']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>ว่าง ไม่พร้อมใช้งาน </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,2)'> ".$row['ST2']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>ห้องรับรอง คณะ </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,4)'> ".$row['ST4']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><lable>จำนวนห้องทั้งหมด </lable></div>";
                  echo "<div class='col-4'><b> ".$row['Totol']."</b></div></div>";
                echo "</div>";
              } 
    ?>
</div>