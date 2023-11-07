<?php include "connect.php";?>
<?php

session_start();
if(!isset($_SESSION['username'])) {
    header("Location: login.php"); // ให้รีไดเร็คไปยังหน้า login.php
    exit(); // ใส่ exit() เพื่อให้โปรแกรมหยุดทำงานทันทีหลังจาก redirect
 }
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = array();
}
if (isset($_GET["action"])) {
    $action = $_GET["action"];

    if ($action == "add") {
        $menuID = $_GET['menuID'];      

        $cart_item = array(
            'menuID' => $menuID,
            'menuname' => isset($_GET['menuname']) ? $_GET['menuname'] : "",
            'Size_Pound_or_Piece' => isset($_GET['Size_Pound_or_Piece']) ? $_GET['Size_Pound_or_Piece'] : "",
            'price' => $_GET['price'],
            'qty' => $_POST['qty']
        );

        if(empty($_SESSION['cart'])){
            $_SESSION['cart'] = array();
        }
        if (array_key_exists($menuID, $_SESSION['cart'])) {
            $_SESSION['cart'][$menuID]['qty'] += $cart_item['qty'];

        } else {
            $_SESSION['cart'][$menuID] = $cart_item;
        }
    } elseif ($action == "update") {
        if (isset($_GET["menuID"]) && isset($_GET["qty"])) {
            $menuID = $_GET["menuID"];
            $qty = $_GET["qty"];
            $_SESSION['cart'][$menuID]['qty'] = $qty;
        }
    } elseif ($action == "delete") {
        if (isset($_GET["menuID"])) {
            $menuID = $_GET['menuID'];
            unset($_SESSION['cart'][$menuID]);
        }
    }
}
?>
<html lang="en">
    <head>
        <title>Whisk & Roll Bakery</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home2.css" rel="stylesheet">
        <link href="css/cart.css" rel="stylesheet">
        <script src="JSON/location.js"></script>
        <script>
            function updateQuantity(menuID) {
                var qty = document.getElementById(menuID).value;
                
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "updateQty.php?menuID=" + menuID + "&qty=" + qty, true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        document.getElementById("total-price").innerText = "รวม " + xhr.responseText + " บาท";
                    }
                };

                xhr.send();
            }

            function redirectToPayment(sum){
                // header("Location: Promptpay/payment.php)
                window.location.assign("payment.php");
            }
        </script>

    </head>
    <body>
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
       
        <br><br>
        <section class="cartPage">
            <div class="order">
                <h1>YOUR CART <hr></h1> 
            </div>
            <form>
                <table border="1" class='tab'>
                    <tr>
                        <th>เมนู</th>
                        <th>ขนาด</th>
                        <th>ราคา</th>
                        <th>จำนวน</th>
                    </tr>
                <?php
                    $sum = 0;
                    foreach ($_SESSION["cart"] as $item) {
                        $sum += $item["price"] * $item["qty"];
                        $_SESSION['sum'] = $sum;
                ?>
                    <tr>
                        <td><?=$item["menuname"]?></td>
                        <td>
                            <?php
                                if (strpos($item['menuname'], 'เค้ก') === 0) {
                                    echo $item["Size_Pound_or_Piece"] . " ปอนด์";
                                } elseif (strpos($item['menuname'], 'คัพเค้ก') === 0) {
                                    echo $item["Size_Pound_or_Piece"] . " ชิ้น";
                                } else {
                                    echo $item["Size_Pound_or_Piece"] . " กล่อง";
                                }
                            ?>
                        </td>
                        <td><?=$item["price"]?></td>
                        <td>
                            <input type="number" id="<?=$item["menuID"]?>" value="<?=$item["qty"]?>" min="1" max="9" size="10" onchange="updateQuantity(<?=$item["menuID"]?>)">
                            <!--<a href="#" onclick="update(<?=$item["menuID"]?>)">แก้ไข</a>-->
                            <a href="?action=delete&menuID=<?=$item["menuID"]?>"><i class="fa-solid fa-trash" style="color: #000000;"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                <tr><td colspan="4" align="right" id="total-price">รวม <?=$sum?> บาท</td></tr>
                </table>
            </form>
            <button onclick="redirectToPayment(<?=$sum?>)">next</button>
        </section>
           
            
        
        <!-- <footer>
            <div class="footer-content">
                
                <h3>Our Store Locations</h3>
                <ul id="footer-result"></ul>
                
            </div>
        </footer> -->

        <script>
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