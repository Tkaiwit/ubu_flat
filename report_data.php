<?php include './inc/toptitle.php';include './function/connectDB.php'; include './function/date.php'; $ReportData="ReD";
$room="SELECT B.BuildingName ,B.BuildingID, 
COUNT(CASE WHEN R.RoomType=1 THEN R.RoomType  END) AS RT1,
COUNT(CASE WHEN R.RoomStatus=1 AND R.RoomType=1 THEN R.RoomStatus END) AS RT1ST1 ,
COUNT(CASE WHEN R.RoomStatus=2 AND R.RoomType=1 THEN R.RoomStatus END) AS RT1ST2 , 
COUNT(CASE WHEN R.RoomStatus=3 AND R.RoomType=1 THEN R.RoomStatus END) AS RT1ST3 , 
COUNT(CASE WHEN R.RoomType=2 THEN R.RoomType  END) AS RT2,
COUNT(CASE WHEN R.RoomStatus=1 AND R.RoomType=2 THEN R.RoomStatus END) AS RT2ST1 ,
COUNT(CASE WHEN R.RoomStatus=2 AND R.RoomType=2 THEN R.RoomStatus END) AS RT2ST2 , 
COUNT(CASE WHEN R.RoomStatus=3 AND R.RoomType=2 THEN R.RoomStatus END) AS RT2ST3 , 
COUNT(CASE WHEN R.RoomType=3 THEN R.RoomType  END) AS RT3,
COUNT(CASE WHEN R.RoomStatus=1 AND R.RoomType=3 THEN R.RoomStatus END) AS RT3ST1 ,
COUNT(CASE WHEN R.RoomStatus=2 AND R.RoomType=3 THEN R.RoomStatus END) AS RT3ST2 , 
COUNT(CASE WHEN R.RoomStatus=3 AND R.RoomType=3 THEN R.RoomStatus END) AS RT3ST3 , 
COUNT(CASE WHEN R.RoomStatus=4 THEN R.RoomStatus END) AS ST4, 
COUNT(*)AS Totol FROM building B JOIN room R ON B.BuildingID=R.BuildingID GROUP BY B.BuildingID";
$getroom=mysqli_query($condb,$room);
$datenow=date2str(date("Y-m-d"),0,0);
?>

<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label style="color: #3f99e6;font-weight: 600;">รายงานข้อมูล</label>
    </div>
    <h3>รายงานข้อมูล</h3>
    <nav>
        <div class="tabs nav-tabs">
            <a class="nav-item nav-link active" id="tabChart" onclick="ShowChartReport()">รายงานความเคลื่อนไหวประจำเดือน</a>
            <a class="nav-item nav-link " id="tabData" onclick="ShowDataReport()">รายงานรายรับ/จ่ายประจำเดือน</a>
        </div>
    </nav>
    <div class="tab-content">
        <div class="tab-pane fade show " id="ShowChartReport">
            <div class="row">
            <div class="col-2">
                    <div class="mr-ml">
                        <label id="label-title">เดือน</label>
                        <?=monthselect(date("m"),'Month',100,'onchange="tableResident()"');?>  
                    </div>  
                </div>
                <div class="col-1">
                    <div class="mr-ml">
                        <label id="label-title">ปี</label>
                        <?php echo "<lable id=\"lableyearly\">".yearselect(date("Y"),'Year',2019,date("Y"),100,'onchange="tableResident()"')."</lable>"?>
                    </div>  
                </div>
            </div>
            <div id="DivTableResident">
            
            </div>
        </div>
        <div class="tab-pane fade" id="ShowDataReport" style="display:none;">
            <div class="row">
                <div class="col-2">
                    <div class="mr-ml">
                        <label id="label-title">เดือน</label>
                        <?=monthselect(date("m"),'MonthR',100,'onchange="tableRevenue()"');?>  
                    </div>  
                </div>
                <div class="col-1">
                    <div class="mr-ml">
                        <label id="label-title">ปี</label>
                        <?php echo "<lable id=\"lableyearly\">".yearselect(date("Y"),'YearR',2019,date("Y"),100,'onchange="tableRevenue()"')."</lable>"?>
                    </div>  
                </div>
                <div><div style="margin-top: 31px;font-weight: bold;color: #095c10;font-size: 1.2em;margin-left: 120px;" id="lableBalance"></div></div>
            </div>
            <div id="DivTableRevenue">
            
            </div>
            
        </div>
        <div>
        </div>
    </div>
</div>
<?php include './inc/footer.php';?>