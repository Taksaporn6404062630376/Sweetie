
<?php include "connect.php" ?>

<?php
    session_start();

    $date = new DateTime();
    $date ->setTimezone(new DateTimeZone('Asia/Bangkok'));
    $formattedDate = $date->format("Y-m-d");
    $date2 = date("Y-m-d");
    $status="wait";

    $stmt = $pdo->prepare("INSERT INTO orders VALUES ('', ?, ?, ?, ?, ?, ?)");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $formattedDate);
    $stmt->bindParam(3, $_POST["deriverydate"]);
    $stmt->bindParam(4, $_POST["total_amount"]); 
    $stmt->bindParam(5, $status);
    $stmt->bindParam(6, $_POST["address"]);
    $stmt->execute();
    $value = '' . $_POST["username"] . '';
    $orderID = $pdo->lastInsertId();   

?>
<html>
    <head><meta charset="UTF-8"></head>
    <body>
        เพิ่มออเดอร์ของ <?=$value?> แล้ว
    </body>
</html>
