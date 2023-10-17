<?php include "connect.php";?>
<html>
<head>
        <title>Sweetie</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home2.css" rel="stylesheet">
    </head>
    <body>
        <!-- !!!!!!! shop name not has been entered !!!!! -->
        <header class="header">
            <div class="logo">
                <div class="logoBakery"></div>
                <h1 class="logoName">Whisk & Roll Bakery</h1>
            </div>

            <nav class="navbar">
                <a href="Home_page.php" class="active">Home</a>
                <a href="Cake.php">Cake</a>
                <a href="Cupcake.php">Cupcake</a>
                <a href="Other.php">Other</a>
            </nav>

            <div class="icon">
                <i id ="icon-search"class="fas fa-search" id="search"></i>
                <a href="javascript:void(0);" id="menu-bar" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>    
            </div>

            <div class="search">
                <input type="search" placeholder="search...">
            </div>

            <div class="icon-user-cart">
                    <div class="user-icon"><a href="userhome.php"></a></div>
                    <div class="shop-bag"><a href="#"></a></div>
            </div>
            
        </header>

        <section class="home" id="home">
            <div class="homeContent">
                <h1>cake<br> menu</h1>              
            </div>            
        </section>

       
        <br><br>
        <!-- <div class="menu-recommend">
            <hr><h1>CAKE</h1> <hr><br><br>
            <?php
                $stmt = $pdo->prepare("SELECT DISTINCT menuname FROM `menu` WHERE menuname LIKE 'เค้ก%';");

                $stmt->execute();
                while($row = $stmt->fetch()){
                    echo"<span class='menu-name'>{$row['menuname']}</span><br>";
                    echo"<div class='menu-image'><a href='selectsize_pound.php?menuname=".$row["menuname"]."'><img src='img/menu-1/{$row['menuname']}.png'width='400'></a></div><br><br><br>";
                }
                
            ?>
        </div> -->

        <section class="menu-recommand">
            
            <div class="top-menu">
                <div class="imgTop">
                    <?php
                        $stmt = $pdo->prepare("SELECT DISTINCT menuname FROM `menu` WHERE menuname LIKE 'เค้ก%';");


                        $stmt->execute();
                        while($row = $stmt->fetch()){
                            // echo "<div class='menu-item'>";
                            echo "<div class='menu-image' id='menu-image'><a href='selectsize_pound.php?menuname=".$row["menuname"]."'><img src='img/menu-1/{$row['menuname']}.png' width='350'></a>";
                            echo "<div class='menu-details'>";
                            echo "<div class='menu-name'>{$row['menuname']}</div>";
                            echo "<div class='cart'>";
                            echo "<div class='add-cart'><a href='#'>add cart</a></div>";
                            echo "</div>";
                            echo "</div>"; // menu-details
                            echo "</div>"; // menu-item
                        }
                                        
                    ?>
                </div>
                
                </div>
            </div>
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
            // sticky navbar
            var navbar = document.getElementById("top-nav");
            var sticky = navbar.offsetTop;

            function handleScroll() {
                if (window.pageYOffset >= sticky) {
                    navbar.classList.add("sticky");
                } else {
                    navbar.classList.remove("sticky");
                }
            }
            window.onscroll = handleScroll;
        </script>
    </body>
</html>