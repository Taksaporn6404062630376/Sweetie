<?php
include 'connect.php';
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <script>
        function confirmDelete(username) {
            var ans = window.confirm("ต้องการลบผู้ใช้ " + username);
            if (ans) {
                document.location = "deleteaccount.php?username=" + username;
            }
        }
    </script>
</head>
<body>
<h1>สวัสดี <?=$_SESSION["fullname"]?></h1>

<h3><a href="product-list.php">ตรวจสอบคำสั่งซื้อของคุณ</a></h3>
หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>
<?php
$stmt = $pdo->prepare("SELECT * FROM members");
$stmt->execute();
echo "<a href='#' onclick='confirmDelete(\"" . $_SESSION["username"] . "\")'>ลบบัญชีของฉัน</a>";

?>
</body>
</html>