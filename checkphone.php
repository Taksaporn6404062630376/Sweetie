<?php
// Replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "sweetie";

$tel = $_GET["tel"];

// Query the database to check if the phone number exists
$sql = "SELECT * FROM members WHERE tel = :tel";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "Phone number exists in the database: denied";
} else {
    echo "Phone number does not exist in the database: okay";
}
