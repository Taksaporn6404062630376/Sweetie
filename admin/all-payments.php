<?php
    include "../connect.php";
    session_start();
    $paymentStmt = $pdo->prepare("SELECT * FROM payment");
    $paymentStmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<script>
    function confirmUpdate(paymentid) { 
    var ans = confirm("ยืนยันสถานะการจ่าย "); 
    if (ans == true) 
        document.location = "paymentstatus.php?paymentID=" + paymentid; 
    }
</script>
<body>

<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a class="active" href="all-payments.php">ดูการจ่ายเงิน payment ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
    <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
    <li><a href='menu.php'>จัดการเมนู</a></li>
    <li class="logout"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>การจ่ายเงิน payment ของลูกค้าทั้งหมด</h2>

    <table>
        <tr>
            <th>Paymentid</th>
            <th>Orderid</th>
            <th>Payment Status</th>
            <th>Payment date</th>
            <th>Update Payment Status</th>
        </tr>
        <?php while ($paymentCountRow = $paymentStmt->fetch()) : ?>
            <tr>
                <td><?= $paymentCountRow['paymentID'] ?></td>
                <td><?= $paymentCountRow['orderID'] ?></td>
                <td><?= $paymentCountRow['paymentStatus'] ?></td>
                <td><?= $paymentCountRow['paymentDate'] ?></td>
                <td ><a href="#" onclick="confirmUpdate('<?= $paymentCountRow['paymentID'] ?>')">อัปเดต </a></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
