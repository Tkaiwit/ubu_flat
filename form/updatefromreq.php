<?php
if($_POST){
    include '../function/connectDB.php';
    $RequestID=$_POST['RequestID'];
	$RoomtypeID = $_POST["RoomtypeID"]; 
	$SocialID = $_POST['SocialID'];
	$PName = $_POST['PName'];
	$Name = $_POST['Name'];
	$Surname = $_POST['Surname'];
	$PositionID = $_POST['PositionID'];
	$FacID = $_POST['FacID'];
	$DeptID = $_POST['DeptID'];
	$PersonnelType = $_POST['PersonnelType'];
	$RightClaim= $_POST['RightClaim'];
	$RepaymentRight= $_POST['RepaymentRight'];
	$MaritalStatus = $_POST['MaritalStatus'];
	$DissaterEffect=$_POST['DissaterEffect'];
	$Notics = (empty($_POST['Notics']))? 'NULL': $_POST['Notics'];
	
	if($MaritalStatus==4){
		$stnm = 1;
	} else { $stnm = 0;}
	$CurProvinceID = $_POST['CurProvinceID'];
	$CurCityID = $_POST['CurCityID'];
	$CurDistrictID=$_POST['CurDistrictID'];

	$Address = $_POST['Address'];
	$ProvinceID = $_POST['ProvinceID'];
	$CityID = $_POST['CityID'];
	$DistrictID=$_POST['DistrictID'];;
	$BirthDate = $_POST['BirthDate'];
	$EmployDate = $_POST['EmployDate'];
    $ChildrenCount = $_POST['ChildrenCount'];

    $sql = "UPDATE staff SET BirthDate='$BirthDate',PName='$PName',Name='$Name',Surname='$Surname', ";
    $sql .= " PositionID='$PositionID',PersonnelType='$PersonnelType',RepaymentRight='$RepaymentRight',RightClaim='$RightClaim', ";
    $sql .= " MaritalStatus='$MaritalStatus',ChildrenCount='$ChildrenCount',EmployDate='$EmployDate',Address='$Address', ";
    $sql .= " FacID='$FacID',DeptID='$DeptID',DistrictID='$DistrictID',CurDistrictID='$CurDistrictID',CityID='$CityID', ";
    $sql .= " CurCityID='$CurCityID',ProvinceID='$ProvinceID',CurProvinceID='$CurProvinceID' ";
    $sql .= " WHERE SocialID='$SocialID' ";
	

    $sqlfq = "UPDATE request_form SET RoomType='$RoomtypeID',SpouseWorkforUBU='$stnm', ";
    $sqlfq .= " RoomAllocated='0',KeyAccept='0',InsurantPayed='0', ";
    $sqlfq .= " FormStatus='1',Notics='$Notics',DissaterEffect='$DissaterEffect' WHERE RequestID='$RequestID' ";

	if(mysqli_query($condb,$sql) && mysqli_query($condb,$sqlfq)){
		echo 1;
	}else{
		echo $sql;
		echo $sqlfq;
	}
}
?>