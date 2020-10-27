<?php include '../function/connectDB.php'; include '../function/config.php';
function getERate($rid){
    global $condb;
    $getRate=mysqli_fetch_assoc(mysqli_query($condb, 'SELECT Rate1 "0", Rate2 "1", Rate3 "2", FT "3", VAT "4", Rateprice "5", RatepriceMeter "6", RatepriceShop "7" FROM elec_rate WHERE RateID='.$rid));
    return $getRate;
}
function getWater($rid){
    global $condb;
    $getWRate=mysqli_fetch_assoc(mysqli_query($condb,'SELECT w_rate1 "0", w_rate2 "1", w_rate3 "2", w_rate4 "3", w_rate5 "4", w_rate6 "5", w_rate7 "6", w_rate8 "7", w_rate9 "8", w_rate10 "9", w_rate11 "10", w_VAT "11" FROM warter_rate WHERE WaterRateID ='.$rid));
    return $getWRate;
}
if($_SESSION['UserType']==6){
    $elecRate=getERate(1);
    list($R1, $R2, $R3, $eFT, $eVAT, $eRP, $RPeMeter, $RPShop ) = $elecRate;
    // list($R1=$elecRate['Rate1'], $R2=$elecRate['Rate2'], $R3=$elecRate['Rate3'], $eFT=$elecRate['FT'], $eVAT=$elecRate['VAT'], $eRP=$elecRate['Rateprice'], $RPeMeter=$elecRate['RatepriceMeter'], $RPShop=$elecRate['RatepriceShop'] ) = $elecRate;

}else if($_SESSION['UserType']==7){
    $waterRate=getWater(1);
    list($W1, $W2, $W3, $W4, $W5, $W6, $W7, $W8, $W9, $W10, $W11, $wVAT) = $waterRate;
}
function getResidentID($bID,$rN,$Rarr){
    $rID=0;
    for($i=0;$i<count($Rarr);$i++){
        if($bID==$Rarr[$i]['BuildingID'] && $rN==$Rarr[$i]['RoomName']){
            $rID=$Rarr[$i]['ResidentID'];
            break;   
        }
    }
    if($rID>0){
        return($rID);
    }else{
        return 0;
    }
}
function gete_prevUnit($CID,$resident){
    $ePU=0;
    for($i=0;$i<count($resident);$i++){
        if($CID==$resident[$i]['ChargeID']){
            $ePU=$resident[$i]['e_prevUnit'];
            break;   
        }
    }
    return($ePU);
}


function calElec($u,$i=0){
    if($_SESSION['UserType']==6){
        global $R1, $R2, $R3;
        $a=[$R1, $R2, $R3];
        // $b=[150, 250,0];
        global $be;
        $b=$be;
        $p=9.35;
    }else if($_SESSION['UserType']==7){
        global $W1,$W2, $W3, $W4, $W5, $W6, $W7, $W8, $W9, $W10, $W11; 
        $a=[$W1,$W2, $W3, $W4, $W5, $W6, $W7, $W8, $W9, $W10, $W11];
        global $bw;
        $b=$bw;
        // $b=[15, 15, 15, 15, 15, 15, 200, 700, 1000, 1000, 0];
        $p=3.50;
    }

    if ($u<1){ 
        if ($i==0) return $p;
        else return 0;
    }else {
        if($u>$b[$i] && $i<2) return $a[$i]*$b[$i]+calElec($u-$b[$i], $i+1);
        else {
            //if ($i==0) return ($a[$i]*$u<$p) ? $p : $a[$i]*$u;
            //else 
            return $a[$i]*$u;
        }
    }
}
function calUnit($Ep,$Ec){
    return $Ec-$Ep;
}
function getChargeID($rID,$m,$y,$Carr){
    $cID=0;
    for($i=0;$i<count($Carr);$i++){
        if($rID==$Carr[$i]['ResidentID'] && $m==$Carr[$i]['MonthlyPeriod'] && $y==$Carr[$i]['Yearly']){
            $cID=$Carr[$i]['ChargeID'];
            break;   
        }
    }
    return($cID);
}
function calFT($uAll){
    global $eFT;
    return $uAll*$eFT;
}
function calVAT($pri,$ftm,$sv){
    global $eVAT,$wVAT;
    if($_SESSION['UserType']==6){
        return ($pri+$ftm+$sv)*$eVAT/100;
    }else if($_SESSION['UserType']==11){
        return $pri*$wVAT/100;
    }
}
function compostarray($dataFile,$resident){
    global $eRP;
    $dt=[];
    $data=explode("\n",$dataFile);
    for($x=1;$x<count($data);$x++){
       list($dt[$x]['no'],$dt[$x]['BuildingID'],$dt[$x]['Roomname'],$dt[$x]['UserName'],$dt[$x]['MonthlyPeriod'],$dt[$x]['Yearly'],$dt[$x]['e_curUnit'])=explode(",",$data[$x]);
            $dt[$x]['ResidentID']=getResidentID($dt[$x]['BuildingID'],$dt[$x]['Roomname'],$resident);
            $dt[$x]['ChargeID']=getChargeID($dt[$x]['ResidentID'],$dt[$x]['MonthlyPeriod'],$dt[$x]['Yearly'],$resident);
            $dt[$x]['e_prevUnit']=gete_prevUnit($dt[$x]['ChargeID'],$resident);
            // $dt[$x]['e_prevUnit']=gete_prevUnit($dt[$x]['ResidentID'],$dt[$x]['MonthlyPeriod'],$dt[$x]['Yearly'],$resident);
            $dt[$x]['e_UnitAll']=($dt[$x]['e_curUnit']*1)-($dt[$x]['e_prevUnit']*1);
            $dt[$x]['e_price']=calElec($dt[$x]['e_UnitAll']);
            if($_SESSION['UserType']==6){
                $dt[$x]['FT']=($dt[$x]['ResidentID']>0)?calFT($dt[$x]['e_UnitAll']):'0';
            }
            $dt[$x]['e_service']=($dt[$x]['ResidentID']>0)?$eRP:'0';
            if($_SESSION['UserType']==6){
                $dt[$x]['e_VAT']=calVAT($dt[$x]['e_price'],$dt[$x]['FT'],$dt[$x]['e_service']);
            }else if($_SESSION['UserType']==7){
                $dt[$x]['e_VAT']=($dt[$x]['ResidentID']>0)?calVAT($dt[$x]['e_price'],'0',$dt[$x]['e_service']):'0';
            }
    }
    return $dt;
}

?>