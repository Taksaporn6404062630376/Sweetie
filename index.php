<?php include "connect.php" ?>
<?php session_start();

?>

<html lang="en">

<head>
    <title>Whisk & Roll Bakery</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home2.css" rel="stylesheet">
    <script src="JSON/location.js"></script>
</head>

<body>
    <!-- !!!!!!! shop name not has been entered !!!!! -->
    <header class="header" id="head">
        <div class="logo">
            <div class="logoBakery"></div>
            <h1 class="logoName">Whisk & Roll Bakery</h1>
        </div>

        <div id="mytopnav" class="nav">
            <nav>
                <a href="index.php">Home</a>
                <a href="Cake.php">Cake</a>
                <a href="Cupcake.php">Cupcake</a>
                <a href="Other.php">Other</a>
            </nav>
        </div>
        
        
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
            <div class="shop-bag">
                <a href="Cart.php"></a>
            </div>
        </div>

        <div class="icon">
            <a href="javascript:void(0);" id="menu-bar" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>

    </header>

    <section class="home" id="home">
        <div class="homeContent">
            <h1>Sweetie<br> Pre - Ordering</h1>
        </div>
    </section>

    <section class="menu-recommand">
        <div class="head-menu">
            <h1>3 menu recommend</h1>
        </div>

        <div class="top-menu">

            <div class="imgTop">
                <?php
                $stmt = $pdo->prepare("SELECT m.menuID, m.menuname, SUM(od.quantity) AS total_quantity FROM menu m 
                        LEFT JOIN orderdetails od ON m.menuID = od.menuID GROUP BY m.menuname 
                        ORDER BY total_quantity DESC LIMIT 3;");

                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    // echo "<div class='menu-item'>";

                    echo "<div class='menu-image'><img src='img/menu-1/{$row['menuname']}.png' width='350'>";
                    echo "<div class='menu-details'>";
                    echo "<div class='menu-name'>{$row['menuname']}</div>";
                    echo "<div class='cart'>";
                    echo "<div class='add-cart'><a href='selectsize.php?menuname=" . $row["menuname"] . "'>view more</a></div>";
                    echo "</div>";
                    echo "</div>"; // menu-details
                    echo "</div>"; // menu-item
                }

                ?>
            </div>
        </div>
        <div id="result"></div>
    </section>

    <footer>
        <div class="footer-content">

            <h3>Our Store Locations</h3>
            <ul id="footer-result"></ul>

        </div>
    </footer>



    <script>
        function myFunction() {
            var x = document.getElementById("mytopnav");
            var y = document.getElementById("head");
            if (x.className === "nav" && y.className === "header") {
                x.className += " responsive";
                y.className += " responsive";
            } else {
                x.className = "nav";
                y.className = "header";
            }
        }
    </script>
</body>

</html>