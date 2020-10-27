<?php
if ($_POST) {
	include('../function/connectDB.php');
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

	$sqlInSocial = "SELECT StaffID,SocialID FROM staff  WHERE SocialID = $SocialID";

	$sqlrowStaffID="SELECT StaffID FROM staff";
	$resrowStaffID=mysqli_query($condb,$sqlrowStaffID);
	$NumrowStaffID=mysqli_num_rows($resrowStaffID);
	$NumrowStaffID=$NumrowStaffID+1;
	$sqlRequest="SELECT RequestID FROM request_form ";
	$resrequest=mysqli_query($condb,$sqlRequest);
	$numrowrequest=mysqli_num_rows($resrequest);
	$numrowrequest=$numrowrequest+1;
	if($rowStaffID=mysqli_fetch_array(mysqli_query($condb,$sqlInSocial))){
		$rowStaffID=$rowStaffID['StaffID'];
		$sqlfq = "INSERT INTO request_form(RequestID,StaffID,RoomType,SpouseWorkforUBU,RoomAllocated, KeyAccept,InsurantPayed,FormStatus,DissaterEffect) ";
		$sqlfq .= " VALUES ($numrowrequest,$rowStaffID,$RoomtypeID,'$stnm','0','0','0','1','$DissaterEffect')";
		if(mysqli_query($condb,$sqlfq)){
			echo 1;
		}else{
			echo $sqlfq;
		}
	}else{
		$sql = "INSERT INTO staff(StaffID,SocialID,PositionID,PersonnelType,MaritalStatus,PName,`Name`,Surname,EmployDate,BirthDate,RightClaim,RepaymentRight,ChildrenCount,DistrictID, CurDistrictID, CityID, CurCityID, ProvinceID, CurProvinceID,StayStatus,FacID,DeptID,Address) ";
		$sql .= " VALUES ($NumrowStaffID,$SocialID,$PositionID,$PersonnelType,$MaritalStatus,'$PName','$Name','$Surname','$EmployDate','$BirthDate','$RightClaim','$RepaymentRight',$ChildrenCount,$DistrictID,$CurDistrictID,$CityID,$CurCityID,$ProvinceID,$CurProvinceID,2,$FacID,'$DeptID','$Address')";

		$sqlfq = "INSERT INTO request_form(RequestID,StaffID,RoomType,SpouseWorkforUBU,RoomAllocated, KeyAccept,InsurantPayed,FormStatus,Notics,DissaterEffect) ";
		$sqlfq .= " VALUES ($numrowrequest,$NumrowStaffID,$RoomtypeID,'$stnm','0','0','0','1',$Notics,'$DissaterEffect')";

		if(mysqli_query($condb,$sql) && mysqli_query($condb,$sqlfq)){
			echo 1;
		}else{
			echo $sql;
			echo $sqlfq;
		}
	}
}

?>