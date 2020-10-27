<?php 
include('connectDB.php');
$Cur = $_POST['Cur'];
echo "<select name=\"$Cur"."DistrictID\" id=\"$Cur"."DistrictID\"  class=\"select-option\" onchange=\"savesVl(this.name, this.options[this.selectedIndex].value);\">";
echo "<option value=\"0\" >เลือกตำบล</option>";
$cid=$_POST['cid'];
	$sqlfa = "SELECT * FROM district WHERE CityID=".$cid." ORDER BY DistrictNameT ASC";
	$resfa = mysqli_query($condb,$sqlfa);
	while ($rowfa = mysqli_fetch_array($resfa)) { 
	echo '<option value="'.$rowfa['DistrictID'].'" ';
	// if($rowfa['DistrictID']==$roweRequest['CurDistrictID']){echo "selected";}
	echo '>'.$rowfa['DistrictNameT'].'</option>';
    }
echo '</select>';
    
?>