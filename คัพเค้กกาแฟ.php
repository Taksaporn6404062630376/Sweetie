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
    <style>
        .cakecontent{
            background-color:#f4f4f4;
            margin: 20px 50px;
            border-radius:15px;
            -webkit-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            -moz-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            position: relative;
        }
        .cakecontent a{
            text-decoration: none;
            color:#d2d3d2;
            background-color: #573822;
            padding:10px;
            border-radius:15px;
        }
        .cakecontent a:hover{
            color:#d2d3d2;
            background-color: saddlebrown;     
        }

        
    </style>
    <body>
        <!-- !!!!!!! shop name not has been entered !!!!! -->
        
        <nav>
            <div class="topnav" id="top-nav">
                <a href="Home_page.php">Home</a>
                <a href="Cake.php" >Cake</a>
                <a href="Cupcake.php" class="active">Cupcake</a>
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
        <hr><h1>คัพเค้กกาแฟ</h1> <hr>
        <div class="cakecontent"><br><br>
        <?php
        $stmt = $pdo->prepare("SELECT menuID, menuname, Size_Pound_or_Piece, detail, price FROM menu WHERE menuname LIKE 'คัพเค้กกาแฟ' AND menuID = 10;");
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $product_name = $row['menuname'];
            $detail = $row['detail'];
            $price = $row['price'];
            $menu_image = "img/menu/" . $product_name . ".jpg";

            include("detail_template.php");
        }
        ?><br>
        <!-- <tocart> -->
        <a href="addtocart.php"><i class="fa-solid fa-plus"></i> หยิบใส่ตะกร้า</a><br><br>
        </div>
        

            <!-- <img src=""> -->

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