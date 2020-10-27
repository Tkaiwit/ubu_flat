<?php session_start(); include '../function/connectDB.php';
$Swapform=$_POST['SwapID'];
$AcceptDate= date("Y-m-d");
$UserID=$_SESSION['UserID'];

$vSwapform="SELECT * FROM `v_z_swaproom` WHERE `SwapID`=$Swapform";
$getvSwapform=mysqli_fetch_assoc(mysqli_query($condb,$vSwapform));
$resident1=$getvSwapform['ResidentID1'];
$resident2=$getvSwapform['ResidentID2'];
$updateSwapform="UPDATE `z_swaproom` SET `AcceptBy`=$UserID,`AcceptDate`='$AcceptDate',`Status`=1 WHERE `SwapID`=$Swapform";

$acceptSwapformR1="UPDATE resident SET EndDate='$AcceptDate',ActiveStatus='0',asses=0,assesskey=0,Notics='สลับห้องพัก' WHERE ResidentID=$resident1";

if(mysqli_query($condb,$updateSwapform)){
    if(isset($resident2)){
        if(mysqli_query($condb,$acceptSwapformR1)){
            $acceptSwapformR2="UPDATE resident SET EndDate='$AcceptDate',ActiveStatus='0',asses=0,assesskey=0,Notics='สลับห้องพัก' WHERE ResidentID=$resident2";
            if(mysqli_query($condb,$acceptSwapformR2)){
                $insertR1="INSERT INTO `resident`(`RoomID`, `UserID`, `StartDate`, `asses`, `assesskey`) VALUES ($getvSwapform[RoomID2],$getvSwapform[UserID],'$AcceptDate','1','1')";
                if(mysqli_query($condb,$insertR1)){
                    $insertR2="INSERT INTO `resident`(`RoomID`, `UserID`, `StartDate`, `asses`, `assesskey`) VALUES ($getvSwapform[RoomID],$getvSwapform[UserID2],'$AcceptDate','1','1')";
                    if(mysqli_query($condb,$insertR2)){
                        echo 1;
                    }else{
                        echo $insertR2;
                    }
                }else{
                    echo $insertR1;
                }
            }else{
                echo $acceptSwapformR2;
            }
        }else{
            echo $acceptSwapformR1;
        }
    }else{
        if(mysqli_query($condb,$acceptSwapformR1)){
            $insertR1="INSERT INTO `resident`(`RoomID2`, `UserID`, `StartDate`, `asses`, `assesskey`) VALUES ($getvSwapform[RoomID],$getvSwapform[UserID],'$AcceptDate',1,1)";
            if(mysqli_query($condb,$insertR1)){
                echo 1;
            }else{
                echo $insertR1;
            }
        }else{
            echo $acceptSwapformR1;
        }
    }
}else{
    echo "$updateSwapform";
}

?>