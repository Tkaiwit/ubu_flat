<?php include '../function/connectDB.php'; include '../function/date.php';
$monthly=$_POST['monthly']; 
$yearly=$_POST['yearly'];
$date=date("Y-m-d H:i:s");
if(isset($_FILES['file'])){
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $f=fopen($file_tmp,'r');
    $d=trim(fread($f,$file_size));
    echo'<button onclick="saveRevenue()" class="btn-add"><i class="icons save nameicon"></i>บันทึกข้อมูลไฟฟ้าประปา</button>';
    echo chr(5);
    $data=explode("\n",$d);
    echo "<table class='table1 table-sm'>";
    echo "<thead>";
    echo "<tr>";
        echo "<th style=\"width: 5%;\" align='left'>#ที่</th>";
        echo "<th style=\"width: 5%;\" align='left'>อาคาร</th>";
        echo "<th style=\"width: 4%;\" align='left'>ห้อง</th>";
        echo "<th style=\"width: 57%;\" align='left'>ชื่อ-สกุล</th>";
        echo "<th style=\"width: 7%;\" align='left'>เดือน</th>";
        echo "<th style=\"width: 9%;\" align='left'>ปี</th>";
        echo "<th align='left'>หน่วยเดือนนี้</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    for($x=1;$x<count($data);$x++){
        trim($data[$x]);
        if($data[$x]!=''){
            $dt=explode(",",$data[$x]);
            if($dt[4]!=$monthly || $dt[5]!=$yearly){
                echo  "<tr> <td collable=\"7\"><lable style=\"color:red; font-size:1.5em;\">ข้อมูลเดือนปีไม่ถูกต้อง กรุณาตรวจสอบไฟล์ข้อมูล</lable></td></tr>";
                break;
            }
            echo "<tr>";
            for($y=0;$y<count($dt);$y++){
                
                echo" <td>";
                    echo $dt[$y];
                echo"</td>";
            }
            echo "</tr>";
        }
    }
    echo "</tbody>";
    echo "</table>";
}
echo "<div class='row'>
        <input type='hidden' id='data_monthlycharge' value=\"$d\" />
      </div>";
?>