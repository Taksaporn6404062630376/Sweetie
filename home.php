
<?php session_start(); ?>
<html>
<body>
<h1>สวัสดี <?=$_SESSION["fullname"]?></h1>
<h3><a href ="product-list.php">ตรวจสอบคำสั่งซื้อของคุณ</a></h3>
หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
</body>
</html>