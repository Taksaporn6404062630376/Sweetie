<?php
    include "../connect.php";
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">
    </head>

<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href="all-payments.php">ดูการจ่ายเงิน payment ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li class="logout"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2 align="center">เพิ่มเมนูใหม่</h2>
    
<form action="insert-menu.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menuID"><br>
    ชื่อเมนู : <input class="iptext" type="text" name="menuname" required><br>
    menuname : <input class="iptext" type="text" name="menunameen" required><br>
    ขนาดสินค้า ( ชิ้น/ปอนด์ ): <input class="iptext" type="number" name="Size_Pound_or_Piece" required><br>
    รายละเอียด: <br><textarea class="iptext" name="detail" rows="5" cols="50" required></textarea><br>
    ราคา: <input class="iptext" type="number" name="price" required><br>
    รูปภาพ: <input type="file" name="image" id="image" required><br><br>
    <input type="submit" value="เพิ่มเมนู">
</form>
</body>
</html>