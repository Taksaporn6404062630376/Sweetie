<?php
include 'connect.php';
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <title>ชื่อร้านยังไม่คิด</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    <script>
        function confirmDelete(username) {
            var ans = window.confirm("ต้องการลบผู้ใช้ " + username);
            if (ans) {
                document.location = "deleteaccount.php?username=" + username;
            }
        }
    </script>
</head>
<body>

<body>
        <!-- !!!!!!! shop name not has been entered !!!!! -->
        
        <nav>
            <div class="topnav" id="top-nav">
                <a href="home2.php" class="active">Home</a>
                <a href="product-list.php">Orders</a>
                <a href="logout.php">Log-out</a>
                <?php
                    $stmt = $pdo->prepare("SELECT * FROM members");
                    $stmt->execute();
                    echo "<a href='#' onclick='confirmDelete(\"" . $_SESSION["username"] . "\")'>Delete My Account</a>";
                ?>
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
        <div class="hname">
            <hr><h1><h1>Hello <?=$_SESSION["username"]?></h1></h1> <hr><br><br>
        </div>
       
        <br>
        <div class="topage">
            <img src="img/home/cake_head.jpg" alt="cake_head" width="100%" >
            <a href="Home_page.php">Go to Homepage</a>

            <!-- <h1>SWEETIE</h1> -->
        </div>
     
        

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