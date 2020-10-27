<div id="id" class="modal"> 
  <div class="modal-content animate">
    <div class="imgcontainer">
      <h2 align="center" style="font-size:1.2em;">เข้าสู่ระบบ</h2>
    </div>
    <div class="container">
      <form name="LoginForm" id="LoginForm" method="POST">
        <div id="f1" class="f1">
          <label for="uname"><b>รหัสผู้ใช้</b></label>
          <input type="text" placeholder="กรุณากรอกรหัสผู้ใช้" id="Username" name="Username" autofocus>
        </div>
        <div id="f1" class="f1">
          <label for="psw"><b>รหัสผ่าน</b></label>
          <input type="password" placeholder="กรุณากรอกรหัสผ่าน"  id="Password" name="Password" >
        </div>
        <div id="f1" class="f1"> 
          <button type="submit">Login</button>
          <label>
            <div id="logins"  style="text-align: center;">
              <a href="./forgotPwd.php">ลืมรหัสผ่านใช่หรือไม่</a>
            </div>      
          </label>
          <div id="logins" style="text-align: center;">
            <lable id="ErrMsg" style="color:red;padding: 5px 15px;"></lable>
          </div>
          <button type="button" onclick="document.getElementById('id').style.display='none'" class="cancelbtn">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>