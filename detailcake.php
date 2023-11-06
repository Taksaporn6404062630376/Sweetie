<?php include "connect.php";?>
<html lang = "en">
    <head>
    <title>Whisk & Roll Bakery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home2.css" rel="stylesheet">
        <link href="css/details.css" rel="stylesheet">
        <script src="JSON/location.js"></script>
    </head>
    <body>

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
       
        <section class="detail">
            <div class="headDe">
                <h1>DETAILS<hr></h1>
            </div>
        <?php
            $stmt = $pdo->prepare("SELECT * FROM menu WHERE menuID = ?;");
            $stmt->bindParam(1, $_GET["menuID"]);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $product_name = $row['menuname'];
                $product_nameen = $row['menunameen'];
                $detail = $row['detail'];
                $price = $row['price'];
                $menu_image = "img/menu-1/" . $product_name . ".png";

                include("detail_template.php");
            }
        ?>
        <br><br><br>
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