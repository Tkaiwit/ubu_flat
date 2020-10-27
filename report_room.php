<?php include './inc/toptitle.php';include './function/connectDB.php'; include './function/date.php'; $reportroom="reportroom";
$BuildingID="SELECT B.BuildingName ,B.BuildingID, COUNT(CASE WHEN R.RoomStatus=1 THEN R.RoomStatus END) AS ST1 , COUNT(CASE WHEN R.RoomStatus=2 THEN R.RoomStatus END) AS ST2 , COUNT(CASE WHEN R.RoomStatus=3 THEN R.RoomStatus END) AS ST3 , COUNT(CASE WHEN R.RoomStatus=4 THEN R.RoomStatus END) AS ST4, COUNT(*)AS Totol FROM building B JOIN room R ON B.BuildingID=R.BuildingID GROUP BY B.BuildingID";
$getBuilding=mysqli_query($condb,$BuildingID);
$room="SELECT B.BuildingName ,B.BuildingID, COUNT(CASE WHEN R.RoomStatus=1 THEN R.RoomStatus END) AS ST1 , COUNT(CASE WHEN R.RoomStatus=2 THEN R.RoomStatus END) AS ST2 , COUNT(CASE WHEN R.RoomStatus=3 THEN R.RoomStatus END) AS ST3 , COUNT(CASE WHEN R.RoomStatus=4 THEN R.RoomStatus END) AS ST4, COUNT(*)AS Totol FROM building B JOIN room R ON B.BuildingID=R.BuildingID GROUP BY B.BuildingID";
$getroom=mysqli_query($condb,$room);
// $getBuilding=$getroom;
// print_r($getroom);

$data="['แฟลตกันเกลา', 'ทั้งหมด', 'มีผู้พักอาศัย', 'ว่าง พร้อมใช้งาน','ว่าง ไม่พร้อมใช้งาน','ห้องรับรอง คณะ'],";

while($Gbuilding=mysqli_fetch_assoc($getBuilding)){
  $data.="[ ";
  $data.="'$Gbuilding[BuildingName]'".','.$Gbuilding['Totol'].','.$Gbuilding['ST3'].','.$Gbuilding['ST1'].','.$Gbuilding['ST2'].','.$Gbuilding['ST4'];
  $data.=" ],";
}


$datenow=date2str(date("Y-m-d"),0,0);
?>
<script type="text/javascript">
function drawChart() {
    var data = google.visualization.arrayToDataTable([<?=$data?>]);
    var options = {
        chart: {
            title: 'Chart Room Status',
            subtitle: 'ทั้งหมด, UpDate :<?=$datenow?> ',
        },
        colors: ['#4285f4', '#db4437', '#0f9d58','#f3b200','#0099c6']
    };
    var chart = new google.charts.Bar(document.getElementById('columnchart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
}
</script>
<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label style="color: #3f99e6;font-weight: 600;">รายงานสถานะห้อง</label>
    </div>
    <h3>รายงานสถานะห้อง</h3>
    <nav>
        <div class="tabs nav-tabs">
            <a class="nav-item nav-link active" id="tabChart" onclick="ShowChartReport()">รูปแบบกราฟ</a>
            <a class="nav-item nav-link " id="tabData" onclick="ShowDataReport()">รูปแบบข้อมูล</a>
        </div>
    </nav>
    <div class="tab-content">
        <div class="tab-pane fade show " id="ShowChartReport">
            <div id="columnchart" style="width: 1098px; height: 500px;"></div>
        </div>
        <div class="tab-pane fade" id="ShowDataReport" style="display:none;">
        
            <b style="color:rgb(117, 117, 117);">ข้อมูลรายงานสถานะห้อง</b> <br>
            <label style="color:rgb(189, 189, 189;">อัพเดตข้อมูลเมื่อวันที่ <?=date2str(date("Y-m-d"),0,0);?></label>
            <div class="flex-container">
              <?php
              while($groom=mysqli_fetch_assoc($getroom)){
                $BID=$groom['BuildingID'];
                echo "<div>";
                  echo "<dt><b>$groom[BuildingName]</b></dt>";
                  echo "<div class='row'><div class='col-8 left'><label>มีผู้พักอาศัย </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,3)'> ".$groom['ST3']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>ว่าง พร้อมใช้งาน </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,1)'> ".$groom['ST1']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>ว่าง ไม่พร้อมใช้งาน </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,2)'> ".$groom['ST2']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><label>ห้องรับรอง คณะ </label></div>";
                  echo "<div class='col-4'><b><a onclick='listRoom($BID,4)'> ".$groom['ST4']."</a></b></div></div>";
                  echo "<div class='row'><div class='col-8 left'><lable>จำนวนห้องทั้งหมด </lable></div>";
                  echo "<div class='col-4'><b> ".$groom['Totol']."</b></div></div>";
                echo "</div>";
                
              } ?>
            </div>
        </div>
    </div>
</div>
<?php include './inc/footer.php';?>