<?php include "connect.php";?>
<html>
    <head>
    <title>Whisk & Roll Bakery</title>
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
            <div class="topnav" id="top-nav">
                <a href="Home_page.php">Home</a>
                <a href="Cake.php" >Cake</a>
                <a href="Cupcake.php">Cupcake</a>
                <a href="Other.php">Other</a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                
            </div>
        <nav>
           
        <!-- <div class="icon-nav">
            <input type="text" id="search" size="30%" placeholder="search menu">
            <div class="button"></div>
            <div class="user-icon"></div>
            <div class="shop-bag"></div>
        </div> -->
       
        <br><br>
        <hr><h1>SELECT SIZE</h1> <hr><br><br>
            <?php
                $stmt = $pdo->prepare("SELECT * FROM menu WHERE menuname = ?;");
                $stmt->bindParam(1, $_GET["menuname"]);
                $stmt->execute();

                while($row = $stmt->fetch()){
                    echo "<br>{$row['Size_Pound_or_Piece']} Pound<br>";
                    echo "<a href='detailcake.php?menuID=" . $row["menuID"] ."'><img src='img/menu/{$row['menuname']}.jpg'width='300'></a><br><br><br><br>";
                }
            ?>

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