<?php
    include "../connect.php";
    session_start();
?>
<?php
if (isset($_GET["paymentID"])) {
    $status = "pay";
    $stmt = $pdo->prepare("UPDATE payment SET paymentstatus=? WHERE paymentID=?");
    $stmt->bindParam(1, $status);
    $stmt->bindParam(2, $_GET["paymentID"]);
    if ($stmt->execute())
        header("location:all-payments.php"); 
    } else {
        echo "No paymentID provided.";
    }
?>