<?php include "connect.php";?>
<?php

session_start();

if ($_GET["action"]=="add") {

	$menuID = $_GET['menuID'];

	$cart_item = array(
 		'menuID' => $menuID,
		'menuname' => isset($_GET['menuname']) ? $_GET['menuname'] : "",
        'Size_Pound_or_Piece' => isset($_GET['Size_Pound_or_Piece']) ? $_GET['Size_Pound_or_Piece'] : "",
		'price' => $_GET['price'],
		'qty' => $_POST['qty']
	);

	if(empty($_SESSION['cart']))
    	$_SESSION['cart'] = array();
 
	if(array_key_exists($menuID, $_SESSION['cart']))
		$_SESSION['cart'][$menuID]['qty'] += $_POST['qty'];
 
	else
	    $_SESSION['cart'][$menuID] = $cart_item;

    } else if ($_GET["action"]=="update") {
        $menuID = $_GET["menuID"];     
        $qty = $_GET["qty"];
        $_SESSION['cart'][$menuID]['qty'] = $qty;

    } else if ($_GET["action"]=="delete") {
        
        $menuID = $_GET['menuID'];
        unset($_SESSION['cart'][$menuID]);
    }
?>
<html>
    <head>
        <title>ชื่อร้านยังไม่คิด</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home2.css" rel="stylesheet">
        <link href="css/cart.css" rel="stylesheet">
        <script>
            function update(menuID) {
                var qty = document.getElementById(menuID).value;
                document.location = "Cart.php?action=update&menuID=" + menuID + "&qty=" + qty; 
            }

            function redirectToPayment(sum){
                // header("Location: Promptpay/payment.php)
                window.location.assign("paymentQR.php");
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
                <a href="index.php" class="active">Home</a>
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
                    <div class="shop-bag"><a href="#"></a></div>
            </div>
            
        </header>
       
        <br><br>
        <section class="cartPage">
            <div class="order">
                
                <h1>YOUR CART</h1> 
            </div>
            <form>
                <table border="1">
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
                        <td><?=$item["Size_Pound_or_Piece"]?></td>
                        <td><?=$item["price"]?></td>
                        <td>
                            <input type="number" id="<?=$item["menuID"]?>" value="<?=$item["qty"]?>" min="1" max="9" >
                            <a href="#" onclick="update(<?=$item["menuID"]?>)">แก้ไข</a>
                            <a href="?action=delete&menuID=<?=$item["menuID"]?>">ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr><td colspan="4" align="right">รวม <?=$sum?> บาท</td></tr>
                </table>
            </form>
            <button onclick="redirectToPayment(<?=$sum?>)">next</button>
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