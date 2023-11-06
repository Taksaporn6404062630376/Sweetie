<?php
    include "../connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/admin.css" rel="stylesheet">
<style>

</style>
</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>เพิ่มรายการสินค้า</h2>
    
<form action="insert-menu.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menuID"><br>
    ชื่อเมนู : <input type="text" name="menuname"><br>
    menuname : <input type="text" name="menunameen"><br>
    ขนาดสินค้า: <input type="number" name="Size_Pound_or_Piece"> ชิ้น/ปอนด์<br>
    รายละเอียด: <br><textarea name="detail" rows="5" cols="50"></textarea><br>
    ราคา: <input type="number" name="price"><br>
    รูปภาพ: <input type="file" name="image" id="image"><br><br>
    <input type="submit" value="เพิ่มเมนู">
</form>
</body>
</html>
