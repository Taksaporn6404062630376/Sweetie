<?php include "connect.php";?>
<?php

session_start();

if ($_GET["action"]=="add") {

	$menuID = $_GET['menuID'];

	$cart_item = array(
 		'menuID' => $menuID,
		'menuname' => isset($_GET['menuname']) ? $_GET['menuname'] : "",
        'detail' => isset($_GET['detail']) ? $_GET['detail'] : "",
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
        <link href="css/home.css" rel="stylesheet">
        <script>
            function update(menuID) {
                var qty = document.getElementById(menuID).value;
                document.location = "Cart.php?action=update&menuID=" + menuID + "&qty=" + qty; 
            }
        </script>
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
           
        <!-- ยังไม่ได้ใส่เดี๋ยวใส่เพิ่ม -->
        <!-- <div class="icon-nav">
            <input type="text" id="search" size="30%" placeholder="search menu">
            <div class="button"></div>
            <div class="user-icon"></div>
            <div class="shop-bag"></div>
        </div> -->

       
        <br><br>
        <hr><h1>YOUR CART</h1> <hr><br><br>
            <form>
                <table border="1">
                <?php
                    $sum = 0;
                    foreach ($_SESSION["cart"] as $item) {
                        $sum += $item["price"] * $item["qty"];
                ?>
                    <tr>
                        <td><?=$item["menuname"]?></td>
                        <td><?=$item["detail"]?></td>
                        <td><?=$item["price"]?></td>
                        <td>
                            <input type="number" id="<?=$item["menuID"]?>" value="<?=$item["qty"]?>" min="1" max="9">
                            <a href="#" onclick="update(<?=$item["menuID"]?>)">แก้ไข</a>
                            <a href="?action=delete&menuID=<?=$item["menuID"]?>">ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
                <tr><td colspan="4" align="right">รวม <?=$sum?> บาท</td></tr>
                </table>
                </form>
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