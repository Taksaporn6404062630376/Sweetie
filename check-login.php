<?php
include "connect.php";
session_start();

// Check if the user is an admin
$adminStmt = $pdo->prepare("SELECT * FROM admin WHERE adminuser = ? AND adminpass = ?");
$adminStmt->bindParam(1, $_POST["username"]);
$adminStmt->bindParam(2, $_POST["password"]);
$adminStmt->execute();
$adminRow = $adminStmt->fetch();

if (!empty($adminRow)) {
    // User is an admin
    echo "ยินดีต้อนรับ (Admin)<br>";
    echo "<a href='admin-home.php'>ดูรายการ Order ของลูกค้า</a>";
} 
else {
    $stmt = $pdo->prepare("SELECT * FROM members WHERE username = ? AND password = ?");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->bindParam(2, $_POST["password"]);
    $stmt->execute();
    $row = $stmt->fetch();

    // if username and password match
    if (!empty($row)) { 
        // Store user data in session
        $_SESSION["fullname"] = $row["name"];   
        $_SESSION["username"] = $row["username"];

        // success message and a link to the user home page
        echo "เข้าสู่ระบบสำเร็จ<br>";
        echo "<a href='user-home.php'>ไปยังหน้าหลักของผู้ใช้</a>"; 
    } else {
      
        echo "ไม่สำเร็จ ชื่อหรือรหัสผ่านไม่ถูกต้อง";
        echo "<a href='login.php'>เข้าสู่ระบบอีกครั้ง</a>"; 
    }
}
?>