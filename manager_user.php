<?php include 'inc/toptitle.php'; require 'function/connectDB.php'; include './function/date.php'; $M=1;
$sqlb = "SELECT * FROM building WHERE BuildingType!=0";
$resultb = mysqli_query($condb,$sqlb);
$sqlusertype="SELECT * FROM allvars WHERE TableName='members' AND FieldName='UserType'";
$resusertype=mysqli_query($condb,$sqlusertype);
?>


<div class="container box" style="margin-top: 10px;height:auto;">
    <div class="border-box">
        <i class="icon homes"></i> หน้าหลัก / <label style="color: #3f99e6;font-weight: 600;">การจัดการผู้ใช้งาน</label>
    </div>
    <h3>การจัดการผู้ใช้งาน</h3>
    <nav>
        <div class="tabs nav-tabs">
        <?php $disp=''; if($_SESSION['UserType']==5 || $_SESSION['UserType']==6 || $_SESSION['UserType']==7){
            $disp="style=\"display:none;\"";
        }
        ?>
            <a class="nav-item nav-link active" id="tabUserType" <?=$disp;?> onclick="ShowUserType()">ผู้ใช้งานทั่วไป</a>
            <a class="nav-item nav-link " id="tabResidnet" onclick="ShowResidnet()">ผู้พักอาศัย</a>
        </div>
    </nav>
    <div class="tab-content">
        <div class="tab-pane fade show " id="ShowUserType">
            <div class="row mb10">
                <div class="col-10">
                <?php if($_SESSION['UserType']!=5 && $_SESSION['UserType']!=6 && $_SESSION['UserType']!=7){ ?>
                    <button onclick="addUserOther()" class="btn-add">
                    <i class="icon plus nameicon"></i>เพิ่มผู้ใช้งานทั่วไป</button>
                <?php } ?>
                </div>
            </div>
            <lable id="lableUser">
            </lable>
        </div>
        <div class="tab-pane fade" id="ShowResidnet" style="display:none;">
            <div class="row mb10">
                <div cla="2">
                    <div class="mr-ml">
                        <label id="label-title">เดือน</label>
                        <?=monthselect(date("m"),'monthly',100,'onchange="tableMember()"');?>  
                    </div>  
                </div>
                <div cla="1">
                    <div class="mr-ml">
                        <label id="label-title">ปี</label>
                        <?php echo "<lable id=\"lableyearly\">".yearselect(date("Y"),'yearly',2019,date("Y"),100,'onchange="tableMember()"')."</lable>"?>
                    </div>  
                </div>
                <div class="col-2">
                    <div class="mr-ml">
                    <label id="label-title">อาคาร</label>
                    <select name="BuildingID" id="BuildingID" onchange="tableMember()">
                        <option value="0">ทุกอาคาร</option>
                        <?php while ($rowb = mysqli_fetch_assoc($resultb)) { ?>
                        <option value="<?=$rowb['BuildingID'];?>"><?=$rowb['BuildingName'];?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <div class="col-7 right">
                    <div style="margin-top: 29px;">
                    <lable id="lableSeveRoomRate"></lable>
                    
                    <button onclick="exportfile()" class="btn-exportexcle">
                    <i class="icon fileexcle nameicon"></i>Export to Excel</button>
                    </div>
                </div>
            </div>
            <lable id="lablemembers">
            </lable>
        </div>
    </div>
</div>

<?php include 'inc/footer.php'; ?>
<?php if($_SESSION['UserType'] ==5 || $_SESSION['UserType'] ==6 || $_SESSION['UserType'] ==7){ ?>
    <script type="text/javascript">tableMember();ShowResidnet();</script>
<?php } else { ?>
    <script type="text/javascript">tableUser();ShowUserType();</script>
<?php } ?>