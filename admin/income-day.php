<?php
    include "../connect.php";
    session_start();
    $income = $pdo->prepare("SELECT CONCAT(DAY(orderdate), '-', MONTH(orderdate), '-', YEAR(orderdate)+543) AS orderdate, SUM(total_amount) AS daily_revenue 
    FROM orders INNER JOIN payment ON orders.orderID = payment.orderID 
    GROUP BY paymentDate HAVING SUM(CASE WHEN paymentStatus = 'wait' 
    THEN 1 ELSE 0 END) = 0 ORDER BY orderdate;");
    $income->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/admin.css" rel="stylesheet">
</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a class="active" href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
    <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>ยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</h2>

    <table>
        <tr>
            <th>Orderdate</th>
            <th>Daily revenue</th>
        </tr>
        <?php while ($orderCountRow = $income->fetch()) : ?>
            <tr>
                <td><?= $orderCountRow['orderdate'] ?></td>
                <td><?= $orderCountRow['daily_revenue'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
