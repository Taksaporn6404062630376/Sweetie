<?php
    include "../connect.php";
    session_start();
    $stmt = $pdo->prepare("SELECT * FROM menu WHERE menuID = ?");
    $stmt->bindParam(1, $_GET["menuID"]);
    $stmt->execute(); 
    $row = $stmt->fetch(); 
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">

</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href="all-payments.php">ดูการจ่ายเงิน payment ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li style="float:righst"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>แก้ไขเมนู</h2>
    
<form action="edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="menuID" value="<?=$row["menuID"]?>"><br>
    ชื่อเมนู : <input class="iptext" type="text" name="menuname" value="<?=$row["menuname"]?>" required><br>
    menuname : <input class="iptext" type="text" name="menunameen" value="<?=$row["menunameen"]?>" required><br>
    ขนาดสินค้า: <input class="iptext" type="number" name="Size_Pound_or_Piece" value="<?=$row["Size_Pound_or_Piece"]?>" required> ชิ้น/ปอนด์<br>
    รายละเอียด: <br><textarea class="iptext" name="detail" rows="5" cols="50"  required><?= $row["detail"] ?></textarea><br>
    ราคา: <input type="number" name="price" value="<?=$row["price"]?>" required><br><br>
    <input type="submit" value="แก้ไขเมนู">
</form>
</body>
</html>
