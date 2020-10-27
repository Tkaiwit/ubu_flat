<?php 
include('../function/connectDB.php');
$BuildingID=$_POST['BuildingID']; $RoomID=$_POST['RoomID'];  $StaffID=$_POST['StaffID']; $RoomType=$_POST['RoomType'];
echo "<select name=\"RoomID\" id=\"RoomID\" class=\"select-option\" onchange=\"buildingbyroom($BuildingID,this.options[this.selectedIndex].value)\"> ";
	$sqlde="SELECT RoomID, RoomName, RoomStatus, RoomStatusName,RoomRate,RoomType,RoomTypeName FROM v_room  WHERE BuildingID=$BuildingID ORDER BY RoomStatus, RoomName";
	$quede=mysqli_query($condb, $sqlde);
	$num=mysqli_fetch_row($quede);
	if($num>0){
		echo "<option value=\"0\" disabled selected>เลือกหมายเลขห้องที่พักอาศัย</option>";
	} 
	while ($getRoom=mysqli_fetch_assoc($quede)){
	echo '<option value="'.$getRoom['RoomID'].'" ';
	if($getRoom['RoomStatus']==3){echo"disabled";}
	if($getRoom['RoomType']!=$RoomType){echo" disabled";}
	if($RoomID==$getRoom['RoomID']){echo "selected";};
	echo'>'.$getRoom['RoomName'].' -'.$getRoom['RoomStatusName'].'-'.$getRoom['RoomTypeName'].'</option>';
	
	}
echo '</select>';
echo chr(5);
echo"<div class=\"row\">
		<div class=\"col-9\">
			<label>ค่าประกันความเสียหายต่อห้อง(เฉพาะแรกเข้า) </label>
		</div>
		<div class=\"col-3 right\">
			1,000.00 บาท
		</div>
	</div>
	<div class=\"row\">
		<div class=\"col-10\">
			<label>ค่ามัดจําสาธารณูปโภคล่วงหน้าต่อห้อง(เฉพาะแรกเข้า) </label>
		</div>
		<div class=\"col-2 right\">
			500.00 บาท
		</div>
	</div>
	<div class=\"row\">
		<div class=\"col-10\">
			<label>ค่าประกันลูกกุญแจและคีย์การ์ดต่อห้อง </label>
		</div>
		<div class=\"col-2 right\">
			200.00 บาท
		</div>
	</div>";
echo chr(5);
$sqlrate="SELECT RoomID, RoomName, RoomStatus, RoomStatusName,RoomRate FROM v_room WHERE BuildingID=$BuildingID and RoomID=$RoomID";
$rate=mysqli_fetch_assoc(mysqli_query($condb, $sqlrate));
$RoomRate=$rate['RoomRate']; $price=$RoomRate+1500+200;
echo "<div class=\"row\">
		<div class=\"col-10\">
			<label>อัตราค่าบำรุงห้อง(ต่อเดือน)</label>
		</div>
		<div class=\"col-2 right\">
		".number_format($RoomRate,2)." บาท 
		</div>
		</div>";
echo "
<div class=\"row\">
	<div class=\"col-9\">
		<label>รวมทั้งหมด </label>
	</div>
	<div class=\"col-3 right\">
		".number_format($price,2)." บาท
	</div>
</div>";
echo chr(5);
echo "<div class=\"row\">
<div class=\"col-10\"><label>อัตราค่าบำรุงห้อง(ต่อเดือน)</label>
</div>
	<div class=\"col-2 right\">
	00.00 บาท 
	</div>
</div>";
echo "<div class=\"row\">
<div class=\"col-9\"><label>รวมทั้งหมด </label></div>
<div class=\"col-3 right\">
".number_format($price,2)." บาท</div>
</div>";
?>