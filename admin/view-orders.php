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

    echo "<a href='all-orders.php'>กลับสู่หน้า ALL Orders</a>";
    echo "<h3>รายการคำสั่งซื้อของลูกค้า: {$username}</h3>";
    echo "<ul>";

    $currentOrderID = null;
    $totalAmount = 0;

    while ($orderRow = $orderQuery->fetch()) {
        if ($currentOrderID !== $orderRow["orderID"]) {
            if ($currentOrderID !== null) {
                echo "<hr>";
                echo "<li>Total amount: {$totalAmount}</li>";
                $totalAmount = 0;
            }
            echo "<li>Order ID: {$orderRow['orderID']}</li>";
            echo "<li>Order Date: {$orderRow['orderdate']}</li>";
            $currentOrderID = $orderRow['orderID'];
        }
        
        echo "<ul>";
        echo "<li>Product ID: {$orderRow['menuID']}";
        echo "  Quantity: {$orderRow['quantity']}";
        echo "  Price: {$orderRow['sub_total']}</li>";
        echo "</ul>";
        
        
        // Calculate the total amount for the order
        $totalAmount += ($orderRow['quantity'] * $orderRow['price']);
    }

    // Calculate and display the total amount for the last order
    if ($currentOrderID !== null) {
        echo "<li>Total amount: {$totalAmount}</li>";
    }

    echo "</ul>";
}
echo "<hr>";
?>
