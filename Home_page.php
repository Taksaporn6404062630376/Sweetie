<?php include "connect.php";?>
<html>
    <head>
        <title>ชื่อร้านยังไม่คิด</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    </head>
    <body>
        <!-- !!!!!!! shop name not has been entered !!!!! -->
        
        <nav>
            <ul class="nav-container">
                <li class="navlist"><a href="#">Home</a></li>
                <li class="navlist"><a href="#">Cake</a></li>
                <li class="navlist"><a href="#">Cupcake</a></li>
                <li class="navlist"><a href="#">Other</a></li>
                <!-- <li class="navlist"><a href="#">Other</a></li>
                <li class="navlist"><a href="#">Other</a></li> -->
            </ul>
            
            <div class="icon-nav">
                <input type="text" id="search" size="30%" placeholder="search menu">
                <div class="button"></div>
                <div class="user-icon"></div>
                <div class="shop-bag"></div>
            </div>
        </nav>
        
        <div class="header">
            <img src="img/home/cake_head.jpg" alt="cake_head" width="100%" >
            <!-- <h1>SWEETIE</h1> -->
        </div>

       
        <br><br>
        <div class="menu-recommend">
            <hr><h1>3 MENU RECOMMEND</h1> <hr><br><br>
            <?php
                $stmt = $pdo->prepare("SELECT m.menuname, SUM(od.quantity) AS total_quantity FROM menu m 
                LEFT JOIN orderdetails od ON m.menuID = od.menuID GROUP BY m.menuname 
                ORDER BY total_quantity DESC LIMIT 3;");

                $stmt->execute();
                while($row = $stmt->fetch()){
                    echo"<span class='menu-name'>{$row['menuname']}</span><br>";
                    echo "<div class='menu-image'><a href='#'><img src='img/menu/{$row['menuname']}.jpg' width='500'></a></div><br><br><br>";

                }
            

                
             ?>

            <!-- <img src=""> -->
            
        </div>

        <footer>
            <div class="footer-content">
                
                <h3>Our Store Locations</h3>
                <ul>
                    <li>CentralPlaza Lardprao Store: 1697 Central Plaza Ladprao, 1st Floor, Room No. 126-129 Phaholyothin Road, Chatuchak, ChatuChak, Bangkok 10900</li>
                    <li>ICONSIAM: 299 ICONSIAM Shopping Center, 2nd Floor, Room No.201-202, Charoennakorn Rd., Klongtonsai, Klongsan, Bangkok 10600</li>
                    <li>Siam Paragon Store: 991 Siam Paragon, 1st Floor, Rama I Rd., Pathumwan, Pathumwan, Bangkok 10330</li>
                </ul>
                
            </div>
        </footer>

       
    </body>
</html>