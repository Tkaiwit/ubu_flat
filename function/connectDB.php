<?php 
error_reporting(E_ALL & ~E_NOTICE);
// $condb=mysqli_connect("localhost","root","12345678","ubu_flat");
// $condb=mysqli_connect("localhost","root","","ubu_flat");
// $condb=mysqli_connect("10.80.49.8","ubu_flat","flat2020","ubu_flat");
$condb=mysqli_connect("202.28.50.19","usr_flat","Kankrao#ubu2020","flat_db");
mysqli_set_charset($condb,"utf8");
if(mysqli_connect_errno()){
	echo "เกิดช้อผิดพลาด".mysqli_connect_error($condb);
}
 ?>
