<?php session_start();
echo $_SESSION['sum'];
$sum = $_SESSION['sum'];?>
<html>
<input type="text" placeholder="amount" value="<?= $sum?>" style="border:1px solid black">
<input type="text" placeholder="amount" value="2" style="border:1px solid black">
</html>