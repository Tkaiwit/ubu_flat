<?php 
function dateselect($dt,$name,$w){
    $dtn = "<select name='$name' id='$name' style=\"width:".$w.'%'.";\">"; //22%
    $dtn .=" <option value=\"0\" > วัน </option>";
    
    for($i=1;$i<=31;$i++){
        $dtn.= "<option value=\"$i\"";if($i==$dt)$dtn.=' selected';
        $dtn.=" >$i</option>";
    }
    $dtn.= "</select>";
    return $dtn;
}
function monthselect($dt,$name,$w,$event=''){
    $dtn = "<select name='$name' id='$name' $event style=\"width:".$w.'%'.";\">"; //50%
    if($dt==0)$dtn .=" <option value=\"0\" selected> เดือน </option>";
    $m=array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
    for($i=0;$i<12;$i++){
        $dtn .="<option value=\"".($i+1)."\""; if($i+1==$dt)$dtn.=' selected';
        $dtn .=" >$m[$i]</option>";
    }
    $dtn.= "</select>";
    return $dtn;
}
function yearselect($dt,$name,$min,$max,$w,$event=''){
    $dtn = "<select name='$name' id='$name' $event style=\"width:".$w.'%'.";\">";
    if($dt==0)$dtn .=" <option value=\"0\" selected> ปี </option>";
    for($i=$min;$i<=$max;$i++){
        $dtn.= "<option value=\"$i\""; if($i==$dt)$dtn.=' selected';
        $dtn.=" >".($i+543)."</option>";
    }
    $dtn.= "</select>";
    return $dtn;
}
function date2str($dt,$sortdate=0,$txt=0){
    $dt=strtotime($dt);
    $m=($sortdate==0)?array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'):
    array('ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค','ก.ย.','ต.ค.','พ.ย.','ธ.ค.');
    $date=($txt==0)?date('j', $dt).' '.$m[date('n', $dt)-1].' '.(date('Y', $dt)+543):'วันที่ '.date('j', $dt).' เดือน '.$m[date('n', $dt)-1].' พ.ศ. '.(date('Y', $dt)+543);
    return $date;
}
function totolScore($S1,$S2,$S3,$S41,$S42,$S5){
   return number_format($S1+$S2+$S3+$S41+$S42+$S5,2);
}

?>