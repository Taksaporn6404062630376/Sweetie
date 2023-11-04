<?php
    include "../connect.php";
    session_start();
    $menuCountStmt = $pdo->prepare("SELECT m.menuname, COALESCE(SUM(COALESCE(od.quantity, 0)), 0) 
    AS total_quantity, COALESCE(SUM(COALESCE(od.sub_total, 0)), 0) 
    AS total_sales FROM menu m LEFT JOIN orderdetails od 
    ON m.menuID = od.menuID GROUP BY m.menuname;");
    $menuCountStmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>รายการ Order ของลูกค้า</title>
    <link href="../css/admin.css" rel="stylesheet">
</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
    <li><a class="active" href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>รายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</h2>

    <table>
        <tr>
            <th>Menuname</th>
            <th>Total Quantity</th>
            <th>Total Sales</th>
        </tr>
        <?php while ($menuCountRow = $menuCountStmt->fetch()) : ?>
            <tr>
                <td><?= $menuCountRow['menuname'] ?></td>
                <td><?= $menuCountRow['total_quantity'] ?></td>
                <td><?= $menuCountRow['total_sales'] ?></td>

            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
