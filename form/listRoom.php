<?php include '../function/connectDB.php';
$room="SELECT * FROM v_room WHERE BuildingID=$_POST[Building] AND RoomStatus=$_POST[Status]";
$groom=mysqli_query($condb,$room);
?>
<div class="container mt10"style="background-color: #83bcf62e;">
    <!-- <div class="flex-container"> -->
        <?php
        $x=0; 
        while($getroom=mysqli_fetch_assoc($groom)){$x++;
        echo"<div class=\"room\">
        <i class=\"icons door\"></i><label> $getroom[RoomName] -$getroom[RoomTypeName2]</label>
        </div>";
        }
        if($x<=0){
            echo "<div class=\"center\"><label>ไม่มีห้อง</label></div>";
        }
        ?>
    <!-- </div> -->
</div>