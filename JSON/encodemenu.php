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
<?php

// โหลดข้อมูล JSON จาก URL
$json_data = file_get_contents('http://localhost/gitcake/json/menu.json');
$data = json_decode($json_data, true);

// สร้างอาร์เรย์เพื่อเก็บข้อมูลที่ไม่ซ้ำ
$uniqueItems = array();

// ใช้ foreach เพื่อวนลูปผ่านข้อมูลเมนูและกรองข้อมูลที่ไม่ซ้ำและขึ้นต้นด้วย "เค้ก" โดยใช้ strpos
foreach ($data as $menuItem) {
    $menuName = $menuItem['menuname'];

    if (strpos($menuName, 'เค้ก') === 0 && !in_array($menuName, $uniqueItems)) {
        $uniqueItems[] = $menuName;

        echo "<div class='menu-image' id='menu-image'><img src='img/menu-1/{$menuName}.png' width='350'>";
        echo "<div class='menu-details'>";
        echo '<div class="menu-name">' . $menuName . '</div>';
        echo '<div class="menu-name">' . $menuItem['menunameen'] . '</div>';
        // echo '<div class="menu-price">ราคา: ' . $menuItem['price'] . ' บาท</div>';
        echo "<div class='add-cart'><a href='selectsize.php?menuname=" . $menuItem['menuname'] ."'>view more</a></div>";
        echo '</div></div>';
    }
}

?>