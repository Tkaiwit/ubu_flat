<?php 
include('connectDB.php');
$Cur=$_POST['Cur'];
echo "<select name=\"$Cur"."CityID\" id=\"$Cur"."CityID\" class=\"select-option\" onchange=\"city(this.options[this.selectedIndex].value,'$Cur');savesVl(this.name, this.options[this.selectedIndex].value);\">";
echo "<option value=\"0\">เลือกอำเภอ</option>";
$pid=$_POST['pid'];
	 $sqlfa = "SELECT * FROM city where ProvinceID=".$pid." ORDER BY CityNameT ASC";
	$resfa = mysqli_query($condb,$sqlfa);
	while ($rowfa = mysqli_fetch_array($resfa)) { 
	echo "<option value=\"".$rowfa['CityID']."\" ";
	// if($rowfa['CityID']==$roweRequest['CurCityID']){echo "selected";}
	echo ">".$rowfa['CityNameT']."</option>";
    }
echo '</select>';
    
?>