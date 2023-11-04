<?php include "connect.php";
$itemPerPage = 9; // จำนวนรายการที่ต้องการแสดงในหนึ่งหน้า
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemPerPage;

$totalProducts = $pdo->query("SELECT DISTINCT COUNT(menuname) FROM menu WHERE menuname NOT LIKE 'เค้ก%' AND menuname NOT LIKE 'คัพเค้ก%'")->fetchColumn();
$totalPages = ceil($totalProducts / $itemPerPage);
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
    <!-- <style>
            .menu-container {
                max-width: 1200px;
                height: auto; 
                margin: 0 auto; 
                padding: 20px; 
                display: flex;
                flex-wrap: wrap;
                
                
            }

            .menu-item {
                width: calc(33.33% - 5px); 
                margin-bottom: -7%;
                position: relative;
            }

            .menu-image img {
                width: 100%;  
            }
            .menu-image {
                width: 100%;
                margin-bottom:0;
            }
        </style> -->
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
        
        <form class="example" action="menu.php" method="get">
                <input type="search" placeholder="Search..." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
        </form>

        <div class="icon-user-cart">
        <div class="user-icon">
                <?php if (!empty($_SESSION["username"])) { ?>
                    <a href="userhome.php"></a>
                <?php } else { ?>
                    <a href="login.php"></a>
                <?php } ?>
            </div>
            <div class="shop-bag"><a href="#"></a></div>
        </div>

    </header>

    <section class="home" id="home">
        <div class="homeContent">
            <h1>other bakery<br> menu</h1>
        </div>
    </section>


    </div>
    <section class="menu-recommand">

        <div class="top-menu">

            <div class="imgTop">
                <?php
                $stmt = $pdo->prepare("SELECT DISTINCT menuname,menunameen FROM menu WHERE menuname NOT LIKE 'เค้ก%' AND menuname NOT LIKE 'คัพเค้ก%' LIMIT :limit OFFSET :offset");
                $stmt->bindParam(':limit', $itemPerPage, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    // echo "<div class='menu-item'>";
                    echo "<div class='menu-image'><img src='img/menu-1/{$row['menuname']}.png' width='350'>";
                    echo "<div class='menu-details'>";
                    echo "<div class='menu-name'>{$row['menuname']}</div>";
                    echo "<div class='menu-name'>{$row['menunameen']}</div>";
                    echo "<div class='cart'>";
                    echo "<div class='add-cart'><a href='selectsize.php?menuname=" . $row["menuname"] . "'>view more</a></div>";
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
                echo '<a href="other.php?page=' . ($page - 1) . '" class="page-link">Previous</a>';
            }

            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="other.php?page=' . $i . '" class="page-link';
                if ($i == $page) {
                    echo ' active';
                }
                echo '">' . $i . '</a>';
            }

            if ($page < $totalPages) {
                echo '<a href="other.php?page=' . ($page + 1) . '" class="page-link">Next</a>';
            }
            ?>
        </div>
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