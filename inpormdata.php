<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php include("./function/connectDB.php")?>
<body>
    <form method="post">
        <textarea name="dataflat" id="dataflat" cols="100" rows="10">
        <?php echo $_POST['dataflat'];?>
        </textarea>
        <input type="submit" name="save" value="save">
    </form>
    <?php

    function getroomId($bid,$rname,$room){
        $rID=0;
        for($i=0;$i<count($room);$i++){
            // echo $bid."=".$room[$i]['BuildingID']." ".$rname."==".$room['RoomName']."<br>";
            if($bid==$room[$i]['BuildingID'] && $rname==$room[$i]['RoomName']){
                $rID= $room[$i]['RoomID']; break;
            }
        }
        // print_r($room);
        return $rID;
    }
        
        if($_POST['save'] && $_POST['dataflat'] !=""){
            
            $data = trim($_POST['dataflat']);
            $rows = explode("\n",$data);
            $room="SELECT * FROM room";
            $getroom=mysqli_query($condb,$room);
            while($arr_room[]=mysqli_fetch_assoc($getroom));
            // var_dump($arr_room);
            for ($i=0; $i < count($rows); $i++) { 
                $rows[$i]=trim($rows[$i]);
                if($rows[$i]!=""){
                list($BuildingID, $RoomName ,$RoomTypeName,$UserPNameT,$UserNameT,$UserSNameT,$PositionName,$PersonnelTypeName,$FacName,$FacID,$DeptID,$PersonnelType,$PositionID)=explode("\t",$rows[$i]);
                // if($i!=0)$sqlmember.=",";
                $sqlmember="INSERT INTO members(BuildingID, UserPNameT, UserNameT, UserSNameT, PositionID, PersonnelType, FacID, DeptID) VALUES ";
                $sqlmember.="($BuildingID,'$UserPNameT','$UserNameT','$UserSNameT',$PositionID,$PersonnelType,$FacID,$DeptID)";
                mysqli_query($condb,$sqlmember);
                $UserID=mysqli_insert_id($condb);
                $RoomID=getroomId($BuildingID,$RoomName,$arr_room);
                //  echo $sqlmember."<br>";
                $residen="INSERT INTO resident( RoomID, UserID, StartDate) VALUES ($RoomID, $UserID,now()) ";
                //  echo $residen."<br>";
                mysqli_query($condb,$residen);
                
            }

            }
            echo "ok";
        }
    ?>
</body>
</html>