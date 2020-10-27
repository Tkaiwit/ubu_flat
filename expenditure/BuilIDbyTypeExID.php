<?php include '../function/connectDB.php'; include '../function/date.php'; 
$sqlex="SELECT * FROM v_expense WHERE ";
if($_POST['BulidingID']==0){
    $sqlex.="BuildingID IS NULL ";
}else{
    $sqlex.="BuildingID=$_POST[BulidingID] ";
}
$sqlex.="AND ExpTypeID=$_POST[ExpTypeID] ORDER BY ExpDate DESC";
$getex=mysqli_query($condb,$sqlex);
?>
<form method="post">
    <table class="table1 table-sm">
        <thead>
            <tr>
                <th>ที่</th>
                <th>เดือน</th>
                <th>ปี</th>
                <th align="left">จ่ายวันที่</th>
                <th align="left">จ่ายให้</th>
                <th align="right">จำนวนเงินที่จ่าย</th>
                <th>จ่ายเงินโดย</th>
                <th rowspan="2" width="10%">จัดการ</th>
            </tr>
        </thead>
        <tbody id="myTable">
            <?php $i=0; while($rowex=mysqli_fetch_assoc($getex)){$i++; 
                echo "<tr>";
                    echo "<td class=\"center\">$i</td>";
                    echo "<td class=\"center\">$rowex[MonthlyPeriod]</td>";
                    echo "<td class=\"center\">$rowex[Yearly]</td>";
                    echo "<td class=\"left\">".date2str($rowex['ExpDate'],0,0)."</td>";
                    echo "<td class=\"left\">";
                    if($rowex['PfPName']){
                        echo $rowex['PfPName'].$rowex['PfName']." ".$rowex['PfSName'];
                    }else{
                        echo $rowex['NamePayfor'];
                    }    
                    echo "</td>";
                    echo "<td class=\"right\">".number_format($rowex['Amount'],2)."</td>";
                    echo "<td class=\"center\">".$rowex['PbPName'].$rowex['PbName']." ".$rowex['PbSName']."</td>";
                    echo "<td class=\"center\"><a onclick=\"return addExpenditure($rowex[ExpID],2)\"><i class=\"icon cog\"></i></a></td>";
                echo "</tr>";
             } if($i<=0){?>
            <tr>
                <td colspan="8" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</form>