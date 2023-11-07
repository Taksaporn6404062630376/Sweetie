<?php
include "connect.php";
$itemPerPage = 9; // จำนวนรายการที่ต้องการแสดงในหนึ่งหน้า
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemPerPage;
// รับค่า filterPrice จาก URL
$filterPrice = isset($_GET["filterPrice"]) ? $_GET["filterPrice"] : "asc"; // ราคาต่ำไปสูงเป็นค่าเริ่มต้น

// สร้าง SQL สำหรับนับรายการทั้งหมด
$countSQL = "SELECT DISTINCT COUNT(menuname) FROM menu WHERE menuname LIKE 'เค้ก%';";

// สร้าง SQL สำหรับเรียงลำดับผลลัพธ์
$sql = "SELECT DISTINCT * FROM `menu` WHERE menuname LIKE 'เค้ก%'";

if ($filterPrice === "asc") {
    $sql .= " ORDER BY price ASC;";
} else if ($filterPrice === "desc") {
    $sql .= " ORDER BY price DESC;";
}

// นับรายการทั้งหมด
$totalProducts = $pdo->query($countSQL)->fetchColumn();

// คำนวณจำนวนหน้าทั้งหมด
$totalPages = ceil($totalProducts / $itemPerPage);

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<section class='menu-recommand' style='display: block; max-width: 100%;'>";
echo "<div class='top-menu'>";
echo "<div class='imgTop' style='display: block; max-width: 100%;'>";

foreach ($result as $row) {
    echo "<div class='menu-item'>";
    echo "<div class='menu-image ' id='menu-image' style='display: flex; justify-content: space-evenly; align-items: center;'><img src='img/menu-1/{$row['menuname']}.png' width='350'>";
    echo "<div class='menu-details'>";
    echo "<h2>".$row['menuname']."</h2><br>";
    echo "<h2>&emsp;".$row['menunameen'] ."&emsp;</h2><br>";
    echo "<h1> ราคา ".$row['price'] ." บาท </h1><br>";

    echo "<div class='cart'>";
    echo "<div class='add-cart' style='width: 200px;'><a href='detailcake.php?menuID=" . $row["menuID"] ."'>{$row['Size_Pound_or_Piece']} Pound</a></div>";
    echo "</div>";
    echo "</div>"; // menu-details
    echo "</div>"; // menu-item
}

echo "</div>"; // ปิด div ของ imgTop
echo "</div>";
echo "</section>";
?>

<!-- in Cake.php -->
<script>
        // สร้างฟังก์ชันเมื่อผู้ใช้เลือกเรียงลำดับใหม่
        function updateResults() {
            var filterPrice = document.getElementById("sort").value;

            // สร้าง XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // กำหนด URL ของเซิร์ฟเวอร์ที่รับค่าเรียงลำดับ
            var url = "sortmenu.php?filterPrice=" + filterPrice; // แทน server.php ด้วย URL ของเซิร์ฟเวอร์ของคุณ

            xhr.open("GET", url, true);

            // กำหนด callback function เมื่อรับข้อมูลจากเซิร์ฟเวอร์
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var resultArea = document.getElementById("resultArea");
                    resultArea.innerHTML = xhr.responseText; // อัพเดตผลลัพธ์การค้นหา
                }
            };

            xhr.send();
        }
    </script>


            <!-- <label for="sort" >เรียงลำดับตาม:</label> -->
            <select id="sort" name="filterPrice" onchange="updateResults()">
                <option value="">เลือกการค้นหา</option>
                <option value="asc">ราคาต่ำไปสูง</option>
                <option value="desc">ราคาสูงไปต่ำ</option>
            </select>

            <div id="resultArea">
            </div>