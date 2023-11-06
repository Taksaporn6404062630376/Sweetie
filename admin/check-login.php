<?php
include "../connect.php";
session_start();
?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php

$username = $_POST['username'];
$password = $_POST['password'];

try {
    // Check if the user is an admin
    $adminStmt = $pdo->prepare("SELECT * FROM admin WHERE adminuser = ? AND adminpass = ?");
    $adminStmt->bindParam(1, $_POST["username"]);
    $adminStmt->bindParam(2, $_POST["password"]);
    $adminStmt->execute();
    $adminRow = $adminStmt->fetch();

    if (!empty($adminRow)) {
        header("Location: all-orders.php");
    } else {
        $stmt = $pdo->prepare("SELECT * FROM members WHERE username = ? AND password = ?");
        $stmt->bindParam(1, $_POST["username"]);
        $stmt->bindParam(2, $_POST["password"]);
        $stmt->execute();
        $row = $stmt->fetch();

        if (!empty($row)) {
            // Store user data in session
            $_SESSION["fullname"] = $row["name"];
            $_SESSION["username"] = $row["username"];
            $_SESSION['useremail'] = $row['email'];
            setcookie("user", $username, time() + 3600, "/"); // Cookie  1 ชม
            header("Location: ../index.php");
            exit();
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Please try again',
                text: 'Incorrect username or password!',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Okay'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = '../login.php';
                    }
                });
            </script>";
        }
    }
} catch (PDOException $e) {
    die("เกิดข้อผิดพลาดในการดำเนินการ: " . $e->getMessage());
    header("Location: login.php");
}
?>