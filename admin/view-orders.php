<?php
include "../connect.php";
session_start();

if (!isset($_GET["username"])) {
    echo "ไม่มีข้อมูลผู้ใช้ที่ระบุ";
} else {
    $username = $_GET["username"];
    $orderQuery = $pdo->prepare("SELECT * FROM menu
    JOIN orderdetails ON orderdetails.menuID = menu.menuID
    JOIN orders ON orderdetails.orderID = orders.orderID
    JOIN members ON orders.username = members.username WHERE members.username = ?");
    $orderQuery->bindParam(1, $username);
    $orderQuery->execute();

    
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">
</head>
<body>
<ul class="nav">
      <li><a class="active" href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href="all-payments.php">ดูการจ่ายเงิน payment ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a href='menu.php'>จัดการเมนู</a></li>
    <li class="logout"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h3>รายการคำสั่งซื้อของลูกค้า: <?=$username ?></h3>
    <?php
    echo "<div class='order-detail'>";

    $currentOrderID = null;
    $totalAmount = 0;

    while ($orderRow = $orderQuery->fetch()) {
        if ($currentOrderID !== $orderRow["orderID"]) {
            if ($currentOrderID !== null) {
                echo "ราคารวม : {$totalAmount}";
                echo "<hr>"; 
                $totalAmount = 0;
            }
            echo "Order ID: {$orderRow['orderID']} <br>";
            echo "วันที่สั่ง : {$orderRow['orderdate']}<br>";
            $currentOrderID = $orderRow['orderID'];
        }
        
        echo "<div class='order-detail' >";
        echo "Menu ID: {$orderRow['menuID']} | ";
        echo "จำนวน: {$orderRow['quantity']} | ";
        echo "ราคา: {$orderRow['sub_total']}<br>";
        echo "</div>";
        
        
        // Calculate the total amount for the order
        $totalAmount += ($orderRow['quantity'] * $orderRow['price']);
    }

    // Calculate and display the total amount for the last order
    if ($currentOrderID !== null) {
        echo "ราคารวม: {$totalAmount}<br>";
    }

    echo "</div>";
    }
    
        ?>
        <br><br><a class="backtopage"href='all-orders.php'>กลับสู่หน้า ALL Orders</a>
    
</body>
</html>
