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
            <!-- 
            <div class="icon">
                <i id="icon-search" class="fas fa-search" id="search"></i>
                <a href="javascript:void(0);" id="menu-bar" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
            </div>

            <form action="menu.php" method="get" class="search-form">
                <div class="search">
                    <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                    <input type="search" placeholder="Search..." name="search" id="search-input">
                </div>
            </form> -->
            <form action="menu.php" method="get" class="search-form">
                <div class="search">
                    <button class="search-button" type="submit"><i class="fas fa-search"></i></button>
                    <input type="search" placeholder="Search..." name="search" id="search-input">
                </div>
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