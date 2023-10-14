<?php include "connect.php" ?>
<?php
session_start();

    $stmt = $pdo->prepare("DELETE FROM members WHERE username= ? ");
    $stmt->bindParam(1, $_GET["username"]);
    if ($stmt->execute())
    // echo "delete complete";
    header("location: register.php");
?>
