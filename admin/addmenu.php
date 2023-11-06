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
</head>
<style>
form {
    max-width: 500px;
    margin: auto;
}

.iptext {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

input[type="file"] {
    margin-bottom: 10px;
}

input[type="submit"] {
    padding: 10px 20px;
    background-color: #4caf50;
    color: #ffffff;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
} 
</style>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>เพิ่มเมนูใหม่</h2>
    
<form action="insert-menu.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menuID"><br>
    ชื่อเมนู : <input class="iptext" type="text" name="menuname"><br>
    menuname : <input class="iptext" type="text" name="menunameen"><br>
    ขนาดสินค้า ( ชิ้น/ปอนด์ ): <input class="iptext" type="number" name="Size_Pound_or_Piece"><br>
    รายละเอียด: <br><textarea class="iptext" name="detail" rows="5" cols="50"></textarea><br>
    ราคา: <input class="iptext" type="number" name="price"><br>
    รูปภาพ: <input type="file" name="image" id="image"><br><br>
    <input type="submit" value="เพิ่มเมนู">
</form>
</body>
</html>
