<?php
include 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <title>Whisk & Roll Bakery</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <link rel="stylesheet" href="css/register.css" />
   <link rel="stylesheet" href="css/home2.css" />
   <script src="JSON/location.js"></script>
</head>

<body style="margin: 0;">
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
    <br><br><br><br><br>


   <section class="form-container">

      <h1>username: <?= $_SESSION["username"] ?></h1>
      <p style="display: inline;">email: </p>
      <h3 style="display: inline;"><?= $_SESSION["useremail"] ?></h3>
      <?php

      $username = $_SESSION["username"];
      $stmt = $pdo->prepare("SELECT
            orders.orderID, orders.orderdate, menuname, orderdetails.quantity, price*quantity as price FROM menu
            JOIN orderdetails ON orderdetails.menuID=menu.menuID
            JOIN orders ON orderdetails.orderID=orders.orderID
            JOIN members ON orders.username=members.username
            WHERE members.username = '$username'");
      $stmt->execute();

      $currentOrderID = null;
      while ($row = $stmt->fetch()) {

         if ($currentOrderID !== $row["orderID"]) {
            // order info if it's a new order
            if ($currentOrderID !== null) {
               echo "<hr>\n";
            }
            echo "<h2>หมายเลขคำสั่งซื้อ: " . $row["orderID"] . "<br></h2>";
            echo "<h2>วันที่สั่งซื้อ: " . $row["orderdate"] . "<br></h2>";

            $currentOrderID = $row["orderID"];
         }
         // product info
         if ($row["menuname"]) {
            echo "<li>" . $row["menuname"] . " จำนวน: " . $row["quantity"] . " ชิ้น  ราคา: " . $row["price"] . " บาท </li>";
         }
      }

      echo "</ul>";
      echo "<hr>\n";
      if (!$currentOrderID) {
         echo "<h1>ไม่มีข้อมูลคำสั่งซื้อ</h1>";
      }

      ?>

   </section>
   <h3 style="float: right; ">
    <a href="#" style="font-size: 2rem;" onclick="confirmLogout()">Log out</a>
   </h3>
   <script>
      function confirmLogout() {
         Swal.fire({
               title: 'Are you sure?',
               text: "You will be logged out.",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: '#3085d6',
               cancelButtonColor: '#d33',
               confirmButtonText: 'Yes, log out'
         }).then((result) => {
               if (result.isConfirmed) {
                  // Redirect to the logout script or page
                  window.location.href = 'logout.php'; // Change 'logout.php' to your actual logout script or page
               }
         });
      }
   </script>
   </section>

   
   <footer>
      <div class="footer-content">
         <h3>Our Store Locations</h3>
         <ul id="footer-result"></ul>

      </div>
   </footer>

   <script>
        function send() {
            request = new XMLHttpRequest();
            request.onreadystatechange = showResult;
            var keyword = document.getElementById("search").value;
            var url = "Searchmenu.php?keyword=" + keyword;
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