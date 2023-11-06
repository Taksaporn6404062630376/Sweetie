<?php
    include "../connect.php";
    session_start();
    $orderCountStmt = $pdo->prepare("SELECT deliverystatus,orderid, username, COUNT(*) AS order_count FROM orders GROUP BY orderid");
    $orderCountStmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/admin.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
    function confirmUpdate(orderid) { 
    var ans = confirm("ยืนยันสถานะการส่ง "); 
    if (ans == true) 
        document.location = "updatestatus.php?orderID=" + orderid; 
    }
</script>
<body>

<ul class="nav">
      <li><a class="active" href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
    <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
    <li><a href='menu.php'>จัดการเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>รายการ Order ของลูกค้าทั้งหมด</h2>

    <table>
        <tr>
            <th>Orderid</th>
            <th>Username</th>
            <th>Delivery Status</th>
            <th>Update Delivery Status</th>
            <th>View Orders Details</th>
        </tr>
        <?php while ($orderCountRow = $orderCountStmt->fetch()) : ?>
            <tr>
                <td><?= $orderCountRow['orderid'] ?></td>
                <td><?= $orderCountRow['username'] ?></td>
                <td><?= $orderCountRow['deliverystatus'] ?></td>
                <td ><a href="#" onclick="confirmUpdate('<?= $orderCountRow['orderid'] ?>')">อัปเดต </a></td>
                <td><a href='view-orders.php?username=<?= $orderCountRow['username'] ?>'>ดู <?= $orderCountRow['order_count'] ?> คำสั่งซื้อ</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
