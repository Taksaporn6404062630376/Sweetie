<?php
session_start();

if (isset($_GET["menuID"]) && isset($_GET["qty"])) {
    $menuID = $_GET["menuID"];
    $qty = $_GET["qty"];

    if (isset($_SESSION['cart'][$menuID])) {
        $_SESSION['cart'][$menuID]['qty'] = $qty;
    }

    $sum = 0;
    foreach ($_SESSION["cart"] as $item) {
        $sum += $item["price"] * $item["qty"];
    }

    echo $sum;
}
?>