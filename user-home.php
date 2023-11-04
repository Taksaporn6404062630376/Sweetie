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
    <link rel="stylesheet" href="css/style.css" />
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
    <!-- !!!!!!! shop name not has been entered !!!!! -->
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

    <section class="home" id="home">
        <div class="homeContent">
            <h1>Sweetie<br> Pre - Ordering</h1>
        </div>
    </section>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>User Home</title>

   <!-- font awesome cdn link  -->
   <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
   />
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css" />
  
</head>
<body>
   <section class="form-container">
      <h1>User Home</h1>
      <h3>Hello! <?=$_SESSION["fullname"]?></h3>
      <h3>username: <?=$_SESSION["username"]?></h3>
      <p style="display: inline;">Login by </p><h3 style="display: inline;"><?=$_SESSION["useremail"]?></h3>
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
               echo "<h3>หมายเลขคำสั่งซื้อ: " . $row["orderID"] . "<br></h3>";
               echo "<h3>วันที่สั่งซื้อ: " . $row["orderdate"] . "<br></h3>";
               
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
   <footer>
      <p><a href="logout.php">Log out</a></p>
   </footer>
</body>
</html>

 
           