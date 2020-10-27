<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css?Vs=8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
</head>

<body marginwidth="0" marginheight="0" style="padding: 0px;">
    <div class="container boxs">
        <div class="row">
            <div class="col-6 text-block">
                <img width="40" height="50" src="assets/img/head_text_index.png" alt="">
                <div class="name-title">
                    ระบบจัดการอาคารที่พักอาศัยบุคลากร มหาวิทยาลัยอุบลราชธานี <br>
                    UBU Residential Management System
                </div>
            </div>

            <div class="col-6">
                <input type="checkbox" id="chk">
                <label for="chk" class="show-menu-btn">
                    <i class="icon menus"></i>
                </label>
                <div class="menu">
                    <div class="right nonuser mr4">
                        &nbsp;
                        <?php $styles=0; if (array_key_exists('UserName', $_SESSION) && !empty($_SESSION["UserID"])){ $styles=1; ?>
                        <a style="font-weight: bold;" href="./Profile.php">
                            <?php echo $_SESSION['UserName'] ?>
                        </a>
                        <?php }?>
                    </div>

                    <div class="<?=($styles==1)?"menusafter":"menus"; ?>">
                        <div class="dropdown mr1">
                            <a class="dropbtn" style="font-weight: bold;" id="dropbtn2" onclick="myDropdown(event, 2)"
                                <?php if (empty($_SESSION['UserID'])){ echo 'href="./"';} ?>>หน้าหลัก
                                <?php if (isset($_SESSION['UserID']) AND $_SESSION['UserID'] > 0){ echo "<i class=\"icon angle-down\"></i>";} ?></a>
                            <?php if(isset($_SESSION['UserType'])){ ?>
                            <div class="dropdown-content" id="myDropdown2">
                                <?php if($_SESSION['UserType'] >= 2 || $_SESSION['LeaderType']>0 || $_SESSION['SemiCommitee']>0){?>
                                    <?php if($_SESSION['UserType'] != 6 || $_SESSION['UserType'] != 7){ ?>
                                <a href="search_resident.php">ค้นหาข้อมูลผู้พักอาศัย</a>
                                <hr>
                                        <?php if($_SESSION['UserType'] == 9 ){ ?>
                                <a href="manager_resident.php">จัดการคำร้องขอที่พักอาศัย</a>
                                <a href="manager_prosess_form.php">ประมวลผลข้อมูลคำร้อง(ตามรอบ)</a>
                                        <?php } ?>  
                                            <?php if($_SESSION['UserType']==3 || $_SESSION['UserType']==9 || $_SESSION['LeaderType']>0 || $_SESSION['SemiCommitee']>0){ ?>
                                <a href="check_score.php">ตรวจสอบผลคะแนน</a>
                                <?=($_SESSION['LeaderType']>0 || $_SESSION['SemiCommitee']>0)?"<hr>":'';?>
                                            <?php } ?>
                                                <?php if($_SESSION['UserType']==3 || $_SESSION['UserType']==5 || $_SESSION['UserType']==9){ ?>
                                <a href="report_data.php">รายงานข้อมูล</a>
                                <?=($_SESSION['UserType']!=5)?"<hr>":"";?> 
                                                <?php } ?>
                                        <?php if($_SESSION['UserType'] == 9 ){ ?>
                                <a href="manager_user.php">การจัดการผู้ใช้งาน</a>
                                        <?php }?>
                                        <?php if($_SESSION['UserType'] == 9){?>
                                <a href="manager_return-room.php">การจัดการคำร้องขอคืนห้อง</a>
                                <a href="manager_swap_room.php">การจัดการคำร้องขอสลับห้อง</a>
                                <?=($_SESSION['LeaderType']>0 || $_SESSION['SemiCommitee']>0)?"<hr>":'';?>
                                        <?php }?>
                                        <?php if($_SESSION['UserType'] == 9 ){ ?>
                                <a href="manager_buliding-room.php">การจัดการอาคาร/ห้อง</a>
                                <hr>
                                        <?php }?>
                                    <?php }?>
                                    <?php if($_SESSION['UserType'] >= 6 && $_SESSION['UserType'] <=7 ){ ?>
                                <a href="manager_user.php">ดึงรายชื่อผู้พักอาศัย</a>
                                        <?php if($_SESSION['UserType']==6){ ?>
                                <a href="manager_electrnic.php">การจัดการข้อมูลไฟฟ้า</a>
                                <hr>
                                        <?php } ?>
                                        <?php if($_SESSION['UserType']==7){ ?>
                                <a href="manager_water.php">การจัดการข้อมูลประปา</a>
                                <hr>
                                        <?php } ?>
                                    <?php }?>
                                    <?php if($_SESSION['UserType']==5){ ?>
                                <a href="manager_expenditure.php">การจัดการรายจ่าย</a>
                                <hr>
                                    <?php } ?>
                                <?php } ?>
                                <a href="./">ประกาศข่าว</a>
                            <?php } ?>
                            </div>
                        </div>
                        <div class="dropdown mr2">
                            <a style="font-weight: bold;" class="dropbtn caret" id="dropbtn1"
                                onclick="myDropdown(event, 1);">ฟอร์มคำร้อง <i class="icon angle-down"></i></a>
                            <!-- <i class="arrows"></i> -->
                            <div class="dropdown-content" id="myDropdown1">
                                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType'] !=1 || empty($_SESSION['UserID'])){ ?>
                                <a href="request_form.php">ฟอร์มคำร้องขอเข้าพัก</a>
                                <a href="request_form_search.php">แก้ไขคำร้องขอเข้าพัก</a>
                                <hr>
                                <?php } ?>
                                <?php if(isset($_SESSION['UserType']) && $_SESSION['UserType']==1){?>
                                <a href="return_form.php">ฟอร์มคำร้องขอคืนห้องพัก</a>
                                <a href="swap_form.php">ฟอร์มคำขอสลับห้องพัก</a>
                                <hr>
                                <?php } ?>
                                <a href="checkresultProcess.php">ตรวจสอบผลการประมาณคะแนน(ตามรอบ)</a>

                            </div>
                        </div>

                        <?php if (array_key_exists('UserName', $_SESSION) AND !empty($_SESSION["UserID"])){ ?>
                        <div class="dropdown mr3 exitlogin" id="logins" style="">
                            <a style="font-weight: bold;" href="function/logout.php" style="width:auto;">ออกจากระบบ</a>
                        </div>
                        <?php } else { ?>
                        <div class="dropdown mr3 exitlogin" id="logins">
                            <a style="font-weight: bold;" onclick="document.getElementById('id').style.display='block'"
                                style="width:auto;">เข้าสู่ระบบ</a>
                        </div>
                        <?php } ?>

                        <label for="chk" class="hide-menu-btn">
                            <i class="icon times"></i>
                        </label>
                </div>

            </div>
        </div>
    </div>
    </div>


    <?php if(!isset($_SESSION['UserID'])){ include './function/loginform.php';} ?>
    