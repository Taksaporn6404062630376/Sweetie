<?php 
    include "connect.php";
    session_start();
    if (!isset($_SESSION['username'])) {
        header("location:login.php");
    }
    if(isset($_SESSION["cart"])) {
        // เคลียร์ข้อมูลในตะกร้าสินค้า
        unset($_SESSION["cart"]);
    }

    echo "<script>alert('สั่งซื้อสินค้าเรียบร้อย');window.location.href = 'index.php';</script>";
?>