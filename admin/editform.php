<?php
    include "../connect.php";
    session_start();
    $stmt = $pdo->prepare("SELECT * FROM menu WHERE menuname = ?");
    $stmt->bindParam(1, $_GET["menuname"]);
    $stmt->execute(); 
    $row = $stmt->fetch(); 
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
    <h2>แก้ไขเมนู</h2>
    
<form action="edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menuID" value="<?=$row["menuID"]?>"><br>
    ชื่อเมนู : <input type="text" name="menuname" value="<?=$row["menuname"]?>"><br>
    menuname : <input type="text" name="menunameen" value="<?=$row["menunameen"]?>"><br>
    ขนาดสินค้า: <input type="number" name="Size_Pound_or_Piece" value="<?=$row["Size_Pound_or_Piece"]?>"> ชิ้น/ปอนด์<br>
    รายละเอียด: <br><textarea name="detail" rows="5" cols="50" ><?= $row["detail"] ?></textarea><br>
    ราคา: <input type="number" name="price" value="<?=$row["price"]?>"><br>
    <input type="submit" value="แก้ไขเมนู">
</form>
</body>
</html>
