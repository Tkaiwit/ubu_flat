<?php include '../function/connectDB.php'; include '../function/date.php'; 
$BuildingID = $_POST['BuildingID'];
$sqlexpedntype="SELECT * FROM expensetype ";

$resexpedntype=mysqli_query($condb,$sqlexpedntype);
echo "<select name=\"ExpTypeIDs\" id=\"ExpTypeIDs\" onchange=\"selectorinput(document.getElementById('BuildingIDs').value,this.options[this.selectedIndex].value)\">";
    echo "<option value=\"0\" selected disabled>เลือกประเภทรายจ่าย</option>";
    while($rowet=mysqli_fetch_assoc($resexpedntype)){
        echo "<option value=\"$rowet[ExpTypeID]\">$rowet[ExpenseName]</option>";
    }
echo "</select>";
?>