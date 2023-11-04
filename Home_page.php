<?php include "connect.php"?>
<?php session_start(); ?>

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
                <!-- <input type="search" placeholder="search..." id="search" onkeyup="send()"> -->
                <input type="text" id="search"  placeholder="search.." onkeyup="send()">
            </div>

            <div class="icon-user-cart">
                    <div class="user-icon"><a href="userhome.php"></a></div>
                    <div class="shop-bag"><a href="Cart.php"></a></div>
            </div>
            
        </header>

        <section class="home" id="home">
            <div class="homeContent">
                <h1>Sweetie<br> Pre - Ordering</h1>              
            </div>            
        </section>

        <section class="menu-recommand">
            <div class="head-menu">
                <h1>3 menu recommand</h1>
            </div>
            
            <div class="top-menu">
                
                <div class="imgTop">
                    <?php
                        $stmt = $pdo->prepare("SELECT m.menuID, m.menuname, SUM(od.quantity) AS total_quantity FROM menu m 
                        LEFT JOIN orderdetails od ON m.menuID = od.menuID GROUP BY m.menuname 
                        ORDER BY total_quantity DESC LIMIT 3;");

                        $stmt->execute();
                        while($row = $stmt->fetch()){
                            // echo "<div class='menu-item'>";
                            
                            if($row["menuname"] == 'เค้ก%' ){
                                echo "<div class='menu-image'><a href='selectsize_pound.php?menuname=".$row["menuname"]."'><img src='img/menu-1/{$row['menuname']}.png' width='350'></a>";                               
                            }
                            else {
                                echo "<div class='menu-image'><a href='selectsize_piece.php?menuname=".$row["menuname"]."'><img src='img/menu-1/{$row['menuname']}.png' width='350'></a>";
                            }
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
            <div id="result"></div>
        </section>
        
       
        <!-- <mian>
            <br><br>
            <div class="menu-recommend">
                <hr><h1>3 MENU RECOMMEND</h1> <hr><br><br>
                <?php
                    $stmt = $pdo->prepare("SELECT m.menuID, m.menuname, SUM(od.quantity) AS total_quantity FROM menu m 
                    LEFT JOIN orderdetails od ON m.menuID = od.menuID GROUP BY m.menuname 
                    ORDER BY total_quantity DESC LIMIT 3;");
                    $stmt->execute();

                    while($row = $stmt->fetch()){
                        echo"<span class='menu-name'>{$row['menuname']}</span><br>";
                        if($row["menuname"] == 'เค้ก%' ){
                            echo"<div class='menu-image'><a href='selectsize_pound.php?menuname=".$row["menuname"]."'><img src='img/menu/{$row['menuname']}.jpg'width='400'></a></div><br><br><br>";
                        } else {
                            echo"<div class='menu-image'><a href='selectsize_piece.php?menuname=".$row["menuname"]."'><img src='img/menu/{$row['menuname']}.jpg'width='400'></a></div><br><br><br>";
                        }
                        
                    }
                ?>
            </div>
            <div id="result"></div>
        </main> -->

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
            function send() {
                request = new XMLHttpRequest();
                request.onreadystatechange = showResult;
                var keyword = document.getElementById("search").value;
                    var url= "Searchmenu.php?keyword=" + keyword;
                request.open("GET", url, true);
                request.send(null);
                }
                function showResult() {
                if (request.readyState == 4) {
                if (request.status == 200)
                    document.getElementById("result").innerHTML = request.responseText;
                
                }
            }
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