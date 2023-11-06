
<?php
    include "../connect.php";
    session_start();

?>
<?php
if (isset($_GET["orderID"])) {
    $status = "send";
    $stmt = $pdo->prepare("UPDATE orders SET deliverystatus=? WHERE orderID=?");
    $stmt->bindParam(1, $status);
    $stmt->bindParam(2, $_GET["orderID"]);
    if ($stmt->execute()) 
        header("location:all-orders.php"); 
    } else {
        echo "No orderID provided.";
    }
    ?>

