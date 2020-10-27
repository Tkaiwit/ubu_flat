<?php
include("../function/connectDB.php");
//$one = explode(",",$_POST['data']);
$socialId=$_POST['SocialID'];

function sortarr2d(&$arr, $col, $dir = SORT_ASC) {
    $sort_col = array();
    foreach ($arr as $key=> $row) {
        $sort_col[$key] = $row[$col];
    }
    array_multisort($sort_col, $dir, $arr);
}
$sqls ="SELECT allvars.ValueT,allvars.ValueE,allvars.FieldCode,ck
FROM allvars LEFT JOIN (
    SELECT RoomType, 1 ck FROM request_form WHERE StaffID IN (SELECT StaffID FROM staff WHERE SocialID ='$socialId' )
    ) as V1
on allvars.FieldCode = V1.RoomType
WHERE `TableName`= 'room' and `FieldName` = 'RoomType' and FieldCode !=4 and FieldCode !=5 and FieldCode !=6 ";
$resq = mysqli_query($condb,$sqls);

unset($row);
while($row[]=mysqli_fetch_assoc($resq)){
    
}
sortarr2d($row, 'ValueE');
    echo "<div class=\"row f-right\">";
for($i=1;$i<count($row);$i++){
    echo "<input type=\"radio\" name=\"RoomtypeID\" ";
    if($row[$i]['ck']==1)echo 'disabled';
    echo " value=\"".$row[$i]['FieldCode']."\">";
    echo "<label class=\"nameradio\">".$row[$i]['ValueT']."</label>";
    if($i==2){
        echo "</div>";
        echo "<div class=\"row f-right\">";
    }
}
    echo "</div>"; 
echo chr(5);
$sql="SELECT 
PName,Name,Surname,PositionID,
FacID,DeptID,PersonnelType,
RightClaim,RepaymentRight,MaritalStatus,
ProvinceID, CityID, DistrictID, CurProvinceID, CurCityID, CurDistrictID,
DATE_FORMAT(BirthDate, '%Y') as bi_y ,DATE_FORMAT(BirthDate, '%c') as bi_m,DATE_FORMAT(BirthDate, '%e') as bi_d,
DATE_FORMAT(EmployDate, '%Y') as st_y,DATE_FORMAT(EmployDate, '%c') as st_m,DATE_FORMAT(EmployDate, '%e') as st_d,
ChildrenCount, SocialID
FROM `staff` 
WHERE SocialID=$socialId";
$rows = mysqli_fetch_assoc(mysqli_query($condb,$sql));
if($rows){
    echo json_encode($rows,JSON_UNESCAPED_UNICODE);
} else {
    echo '{"PName":"","Name":"","Surname":"","PositionID":"0","FacID":"0","DeptID":"0","PersonnelType":"","RightClaim":"","RepaymentRight":"",';
    echo '"MaritalStatus":"","ProvinceID":"0","CityID":"0","DistrictID":"0","CurProvinceID":"0","CurCityID":"0","CurDistrictID":"0",';
    echo '"bi_y":"0","bi_m":"0","bi_d":"0","st_y":"0","st_m":"0","st_d":"0","ChildrenCount":""}';
}




?>