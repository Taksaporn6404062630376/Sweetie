<?php
    include "../connect.php";
    session_start();
?>

<?php
    $stmt = $pdo->prepare("UPDATE menu SET menuname=?, menunameen=? , Size_Pound_or_Piece=?, detail=?, price=? WHERE menuID=?");
    $stmt->bindParam(1, $_POST["menuname"]);
    $stmt->bindParam(2, $_POST["menunameen"]);
    $stmt->bindParam(3, $_POST["Size_Pound_or_Piece"]);
    $stmt->bindParam(4, $_POST["detail"]);
    $stmt->bindParam(5, $_POST["price"]);
    $stmt->bindParam(6, $_POST["menuID"]);
    if ($stmt->execute()) {
        $value = 'แก้ไขสำเร็จ';
    }
    else{
        $value = 'แก้ไขไม่สำเร็จ';
    }
    
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">

</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2 class="alert"><?=$value?></h2>
    <a class="backtopage"href="menu.php">กลับสู่หน้าเมนู</a>
</body>
</html>