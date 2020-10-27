<div id="myModals" class="modals">
    <div class="modals-content " id="modals-content">
        <div class="modals-header">
            <lable class="close">&times;</lable>
            <lable id="window-titles">Modal Header</lable>
        </div>
        <div class="modals-body scrollbar" id="modals-body">
            <p>Some text in the Modal Body</p>
            <p>Some other text...</p>
        </div>
        <div class="modals-footer" id="modals-footer"></div>
    </div>
</div>
<div id="alertboxstatus1" style="display:none;">
    <div class="alert " id="alert1">
        <lable class="alertclose" onclick="alertclose()">×</lable>
        <strong><i class="icons " aria-hidden="true" id="icon"></i> <lable id="msgt">..!</lable> </strong> <lable
            id="msgd">...</lable>
    </div>
</div>
<footer class="mt10">
    <div class="container">
        <div class="footer-box center">
            <label>มหาวิทยาลัยอุบลราชธนี © 2020</label>
        </div>
    </div>
</footer>
<script type="text/javascript" src="./assets/js/checkID.js"></script>
<?php if(isset($ediformRq)){?>
<script type="text/javascript" src="./assets/js/ediformRq.js"></script>
<?php } if(isset($formRq)){?>
<script type="text/javascript" src="./assets/js/formRq.js"></script>
<?php } if(empty($_SESSION["UserID"])){ ?>
<script type="text/javascript" src="./assets/js/login.js"></script>
<?php }?>
<script type="text/javascript" src="./assets/js/formRqSave.js"></script>
<script type="text/javascript" src="./assets/js/moals.js"></script>
<script type="text/javascript" src="./assets/js/menudropdown.js"></script>
<script type="text/javascript" src="./assets/js/orderby.js"></script>
<?php if(isset($formreturn)){ ?>
<script type="text/javascript" src="./assets/js/formreturn.js"></script>
<?php } if(isset($M)){ ?>
<script type="text/javascript" src="./assets/js/members.js"></script>
<?php } if(isset($RTM)){ ?>
<script type="text/javascript" src="./assets/js/manager_return-room.js"></script>
<?php } if(isset($CS)){?>
<script type="text/javascript" src="./assets/js/checkscore.js"></script>
<?php } if(isset($MPSF)){ ?>
<script type="text/javascript" src="./assets/js/manager_proress_form.js"></script>
<?php } if(isset($RePRevenue)){ ?>
<script type="text/javascript" src="./assets/js/report_revenue.js"></script>
<?php } if(isset($MR)){?>
<script type="text/javascript" src="./assets/js/manager_revenue.js"></script>
<?php } if(isset($RSCs)){?>
<script type="text/javascript" src="./assets/js/checkscoreresult.js"></script>
<?php } if(isset($SM)){ ?>
<script type="text/javascript" src="./assets/js/searchmember.js"></script>
<?php }?>
<script type="text/javascript" src="./assets/js/manager_expenditure.js"></script>
<script type="text/javascript" src="./assets/js/selectoption.js"></script>
<?php if(isset($BR)){ ?>
<script type="text/javascript" src="./assets/js/manager_building-room.js"></script>
<?php } if(isset($ReportData)){ ?>
<!-- <script type="text/javascript" src="./assets/js/loader.js"></script> -->
<script type="text/javascript" src="./assets/js/report_Data.js"></script>
<?php } if(isset($sw_f)){?>
    <script type="text/javascript" src="./assets/js/managerswapform.js"></script>
<?php }?>
</body>

</html>