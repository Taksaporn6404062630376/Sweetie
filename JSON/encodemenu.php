<?php
$mysqli = new mysqli("localhost", "root", "", "sweetie");

if ($mysqli->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $mysqli->connect_error);
}

$sql = "SELECT * FROM menu";

$result = $mysqli->query($sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);
$file_path = 'D:\xampp\htdocs\gitcake\jsontry\menu.json';
file_put_contents($file_path, $json_data);

// echo $json_data;
?>
