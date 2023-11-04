<?php
include "../connect.php";
session_start();

$orderCountStmt = $pdo->prepare("SELECT username, COUNT(*) AS order_count FROM orders GROUP BY username");
$orderCountStmt->execute();

echo "<h2>รายชื่อผู้ใช้ทั้งหมด:</h2>";
echo "<ol>";

while ($orderCountRow = $orderCountStmt->fetch()) {
    $username = $orderCountRow['username'];
    $orderCount = $orderCountRow['order_count'];
    
    echo "<li>{$username}: <a href='view-orders.php?username={$username}'>ดู {$orderCount} คำสั่งซื้อ</a></li>";
}

echo "</ol>";

// update the stock based on orders
// $updateStockQuery = $pdo->prepare("UPDATE product
//     JOIN item ON item.pid = product.pid
//     SET product.stock = product.stock - item.quantity");
// $updateStockQuery->execute();

$stockQuery = $pdo->prepare("SELECT * FROM menu");
$stockQuery->execute();

// echo "<h2>สินค้าคงเหลือ</h2>";

// while ($stockRow = $stockQuery->fetch()) {
//     // $productid = $stockRow['menuID'];
//     // $productName = $stockRow['menuname'];
//     // $stock = $stockRow['stock'];
//     // echo "ID{$stockRow['menuID']}: {$stockRow['pname']} {$stockRow['stock']} ชิ้น<br>";
// }

?>