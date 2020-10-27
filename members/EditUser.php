<?php include_once '../function/connectDB.php';
$member="SELECT * FROM members WHERE UserID = $_POST[UserID]";
$ggetmember=mysqli_fetch_assoc(mysqli_query($condb,$member));
?>
<div class="container">
    <div>
        
    </div>
</div>