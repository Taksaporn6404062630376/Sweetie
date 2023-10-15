<?php
    include 'connect.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
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
      <div class="btn"><a href="Home_page.php">Home page</a></div>
   </footer>
</body>
</html>

 
           