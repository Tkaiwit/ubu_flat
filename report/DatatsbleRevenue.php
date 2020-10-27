<?php session_start(); include '../function/connectDB.php';
$getExpend="SELECT VM.BuildingID,VM.BuildingType,VM.BuildingName,VM.MonthlyPeriod,VM.Yearly,SUM(VM.RoomRate) RoomRate,SUM(VM.e_price) e_price, SUM(VM.w_price) w_price,
Ex.Amount ExAmount
FROM v_monthlycharge VM LEFT JOIN ( SELECT BuildingID,MonthlyPeriod,Yearly,SUM(Amount) Amount FROM expense GROUP BY BuildingID,MonthlyPeriod,Yearly) Ex ON VM.BuildingID=Ex.BuildingID AND VM.MonthlyPeriod=Ex.MonthlyPeriod AND VM.Yearly=Ex.Yearly
GROUP BY VM.BuildingID,VM.MonthlyPeriod,VM.Yearly HAVING VM.MonthlyPeriod =$_POST[MonthR] AND VM.Yearly=$_POST[YearR] AND VM.BuildingType=1
 
 UNION 
 SELECT 0 BuildingID,1 BuildingType, 'รายจ่ายอื่นๆ' BuildingName,MonthlyPeriod, Yearly,0 RoomRate,0 e_price,0 w_price,
SUM(Amount) ExAmount 
FROM expense GROUP BY BuildingID, MonthlyPeriod, Yearly  HAVING MonthlyPeriod =$_POST[MonthR] AND $_POST[YearR] AND BuildingID=0 ";
$reuslt=mysqli_query($condb,$getExpend);
$monthly=$_POST['MonthR'];$yearly=$_POST['YearR'];
if($_POST['MonthR']==12){$monthly=1;$yearly=$_POST['YearR']-1;}else{$monthly=$monthly-1;$yearly=$_POST['YearR'];}

$getincome="SELECT SUM(balance) as balance FROM income ";
$gincome=mysqli_fetch_assoc(mysqli_query($condb,$getincome));
echo "ยอดเงินคงเหลือสุทธิ ".number_format($gincome['balance'],2)." บาท";
echo chr(5);
echo '<form method="POST">';
?>
<table class="table1 table-sm mt10">
    <thead>
        <tr>
            <th width="17%">แฟลต</th>
            <th width="20%">รายรับ</th>
            <th width="20%">รายจ่าย</th>
            <th width="10%">คงเหลือสุทธิ</th>
            <?php if($_SESSION['UserType']==9){ ?>
            <th width="3%"></th>
            <?php } ?>
        </tr>
    </thead>
    <tbody id="myTable" name="table1">
    <?php
    $x=0;
    $PriceAll=array(0,0,0);
    while($gExpend=mysqli_fetch_assoc($reuslt)){ $x++;
        echo '<tr>';
            echo "<td align='center'>$gExpend[BuildingName]</td>";
            echo "<td align='center'>".number_format($gExpend['RoomRate'],2)."</td>";
            echo "<td align='center'>".number_format($gExpend['ExAmount'],2)."</td>";
            echo "<td align='center'>";
            $net=$gExpend['RoomRate']-$gExpend['ExAmount'];
            $PriceAll[0]+=$gExpend['RoomRate'];
            $PriceAll[1]+=$gExpend['ExAmount'];
                echo number_format($net,2);
                        echo "</td>";
                        $PriceAll[2]+=$net;
    if($_SESSION['UserType']==9){ 
                        echo'<td></td>';
    }
        echo '</tr>';
    }
    if($x>0){
    echo "<tr><td align='center'><b>รวมทั้งสิ้น</b></td>";
    for($i=0;$i<count($PriceAll);$i++){
        echo "<td align='center'><b>".number_format($PriceAll[$i],2)."</b>";
        "</td>";
        echo '<input type="hidden" id="in'.$i.'" value="'.$PriceAll[$i].'">';
    }
    if($_SESSION['UserType']==9){ 
        echo '<td><a onclick="SaveDataIncome()" class="tooltip acc" for="saveincome"><i class="icons sack-dollar"></i> <lable class="tooltiptext">ยกยอดไปเดือนถัดไป</lable></a></td>';
    }
    echo "</tr>";}
    if($x<=0){
    ?>
        <tr>
            <td colspan="20" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<?php echo '</form>'; ?>
<div class="mt10 mb10">
<label for=""><b>หมายเหตุ</b></label><br>
<label for=""><i class="icons sack-dollar"></i>  : ยกยอดไปเดือนถัดไป</label>
</div>
