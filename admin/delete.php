
<?php
    include "../connect.php";
    session_start();
?>
<?php
    $stmt = $pdo->prepare("DELETE FROM menu WHERE menuID=?");
    $stmt->bindParam(1, $_GET["menuID"]); 
    if ($stmt->execute()) 
        header("location:menu.php"); 
?>