<?php 
include('connectDB.php');
echo "<select name=\"DeptID\" id=\"DeptID\" class=\"select-option\" onchange=\"savesVl(this.name, this.options[this.selectedIndex].value)\">";
	$fid=$_POST['fid'];
	$sqlde="SELECT * from department WHERE FacID=".$fid.' ORDER BY DeptID';
	$quede=mysqli_query($condb, $sqlde);
	$num= mysqli_fetch_row($quede);
	if($num>0){
		echo "<option value=\"0\">เลือกรหัสภาควิชา...</option>";
	} 
	while ($getDept=mysqli_fetch_assoc($quede)){
		echo '<option value="'.$getDept['DeptID'].'">'.$getDept['DeptNameT'].'</option>';
	}
echo '</select>';
?>