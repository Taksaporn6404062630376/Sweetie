<?php include "connect.php";
$itemPerPage = 9; // จำนวนรายการที่ต้องการแสดงในหนึ่งหน้า
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemPerPage;

// ตรวจสอบว่ามีคำค้นหาที่ส่งมาผ่าน URL
if (isset($_GET['search']) && !empty($_GET['search'])) {
    // มีคำค้นหาส่งมาและมันไม่ใช่ค่าว่าง
    $search = '%' . $_GET['search'] . '%'; // Add wildcards for partial matching

    $stmt = $pdo->prepare("SELECT DISTINCT menuname, menunameen FROM menu WHERE menuname LIKE :search OR menunameen LIKE :search LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $totalProducts = $stmt->rowCount(); // นับจำนวนรายการที่ค้นหาได้
    $totalPages = ceil($totalProducts / $itemPerPage);
} else {
    // ถ้าไม่มีคำค้นหาส่งมา ให้แสดงรายการทั้งหมด
    $stmt = $pdo->prepare("SELECT DISTINCT menuname, menunameen FROM menu LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $totalProducts = $pdo->query("SELECT DISTINCT COUNT(menuname) FROM menu")->fetchColumn();
    $totalPages = ceil($totalProducts / $itemPerPage);
}

?>
<html>

<head>
    <title>Whisk & Roll Bakery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home2.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="logo">
            <div class="logoBakery"></div>
            <h1 class="logoName">Whisk & Roll Bakery</h1>
        </div>

        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="Cake.php">Cake</a>
            <a href="Cupcake.php">Cupcake</a>
            <a href="Other.php">Other</a>
        </nav>

        <!-- <div class="search">
            <input type="search" placeholder="search..." id="search" onkeyup="send()">
            <input type="text" id="search" placeholder="search.." onkeyup="send()">
            <form action="menu.php" method="get">
                <input type="search" placeholder="search..." name="search" id="search" style="display: inline;">
                <button class="search" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div> -->

        <!-- จัดไอคอนค้นหาไม่ได้  -->
        <form action="menu.php" method="get" class="search-form">
            <div class="search">
                <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                <input type="search" placeholder="Search..." name="search" id="search-input">
            </div>
        </form>
        <div class="icon-user-cart">
            <div class="user-icon"><a href="userhome.php"></a></div>
            <div class="shop-bag"><a href="#"></a></div>
        </div>

    </header>
    <br><br><br>

    <?php if (isset($_GET['search'])) : ?>
        <section class="menu-recommand">
            <div class="head-menu">
                <h1>Result Search</h1>
            </div>

            <?php
            $rowCount = $stmt->rowCount(); // นับจำนวนแถวที่ค้นหาได้
            if ($rowCount > 0) {
            ?>

                <div class="top-menu">
                    <div class="imgTop">
                        <?php
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<div class='menu-image'><a href='selectsize_pound.php?menuname=" . $row["menuname"] . "'><img src='img/menu-1/{$row['menuname']}.png' width='350'></a>";
                            echo "<div class='menu-details'>";
                            echo "<div class='menu-name'>{$row['menuname']}</div>";
                            echo "<div class='menu-name'>{$row['menunameen']}</div>";
                            echo "<div class='cart'>";
                            echo "<div class='add-cart'><a href='#'>add cart</a></div>";
                            echo "</div>";
                            echo "</div>"; // menu-details
                            echo "</div>"; // menu-image
                        }
                        ?>
                    </div>
                </div>
            <?php
            } else {
                echo "<p>No results found.</p>";
            }
            ?>
        </section>


    <!-- แสดงเมนูทั้งหมดถ้าไม่มี search แต่ยังจัดการหน้าไม่ได้ -->
    <?php elseif (!isset($__GET['search'])) : ?>
        <section class="menu-recommand">
            <div class="head-menu">
                <h1>Menu</h1>
            </div>
            <div class="top-menu">
                <div class="imgTop">
                    <?php
                    $stmt = $pdo->prepare("SELECT DISTINCT menuname FROM menu LIMIT :limit OFFSET :offset");
                    $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);
                    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        // echo "<div class='menu-item'>";
                        echo "<div class='menu-image'><a href='selectsize_pound.php?menuname=" . $row["menuname"] . "'><img src='img/menu-1/{$row['menuname']}.png' width='350'></a>";
                        echo "<div class='menu-details'>";
                        echo "<div class='menu-name'>{$row['menuname']}</div>";
                        echo "<div class='menu-name'>{$row['menunameen']}</div>";
                        echo "<div class='cart'>";
                        echo "<div class='add-cart'><a href='#'>add cart</a></div>";
                        echo "</div>";
                        echo "</div>"; // menu-details
                        echo "</div>"; // menu-item
                    }
                    ?>
                </div>
            </div>
        </section>

        <div class="pagecustom">
            <?php
            if ($page > 1) {
                echo '<a href="menu.php?page=' . ($page - 1) . '" class="page-link">Previous</a>';
            }
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="menu.php?page=' . $i . '" class="page-link';
                if ($i == $page) {
                    echo ' active';
                }
                echo '">' . $i . '</a>';
            }
            if ($page < $totalPages) {
                echo '<a href="menu.php?page=' . ($page + 1) . '" class="page-link">Next</a>';
            }
            ?>
        </div>
    <?php endif; ?>
    <br><br><br>
    <footer>
        <div class="footer-content">

            <h3>Our Store Locations</h3>
            <ul>
                <li>1.CentralPlaza Lardprao Store: 1697 Central Plaza Ladprao, 1st Floor, Room No. 126-129 Phaholyothin Road, Chatuchak, ChatuChak, Bangkok 10900</li>
                <li>2.ICONSIAM: 299 ICONSIAM Shopping Center, 2nd Floor, Room No.201-202, Charoennakorn Rd., Klongtonsai, Klongsan, Bangkok 10600</li>
                <li>3.Siam Paragon Store: 991 Siam Paragon, 1st Floor, Rama I Rd., Pathumwan, Pathumwan, Bangkok 10330</li>
            </ul>

        </div>
    </footer>

    <script>
        function myFunction() {
            var x = document.getElementById("top-nav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>
</body>

</html>