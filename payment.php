<?php include "connect.php";
    session_start();

    if (empty($_SESSION['username'])) {
        header("Location: login.php");
        exit;
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
        <link href="css/home.css" rel="stylesheet">
        <script src="JSON/location.js"></script>
        <link href="css/pay_delivery.css" rel="stylesheet">
        <style>
            .text-right {
                padding-left: 150px;
            }
            .text-right-total{
                padding-left: 118px;
            }
            .topnav a{
               font-size:2.5em;
            }
        </style>
    </head>
    
    <body>
        
        <nav>
            <div class="topnav" id="top-nav">
                <a href="index.php"><i class="fa-solid fa-house"></i></a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                
            </div>
        </nav>
        <!--start-->

       
            <div class="card-body"><br><br>
                 <!-- !!!!!!! order detail !!!!! -->
                <div class="col-md-5">
                        <div class="right border">
                            <div class="header">รายการสั่งซื้อทั้งหมด</div>
                
                  <?php 
                  $sum = 0;
                  foreach ($_SESSION["cart"] as $item) { 
                    $sum += $item["price"] * $item["qty"];?>
                            <div class="cakecontent">
                                <div class="cakecontent-left">
                                    <img src="img/menu/<?=$item["menuname"]?>.jpg" alt="" width='120'height='120' >
                                </div>
                                <div class="cakecontent-right">
                                    <h2><?=$item["menuname"]?></h2>
                                    <p>จำนวน : <?=$item["qty"]?> ชิ้น ( ขนาด
                                        <?php
                                            if (strpos($item['menuname'], 'เค้ก') === 0) {
                                                echo $item["Size_Pound_or_Piece"] . " ปอนด์";
                                            } elseif (strpos($item['menuname'], 'คัพเค้ก') === 0) {
                                                echo $item["Size_Pound_or_Piece"] . " ชิ้น";
                                            } else {
                                                echo $item["Size_Pound_or_Piece"] . " กล่อง";
                                            }
                                        ?>
                                    )</p>
                                    <p>ราคา : <?=$item["price"]?></p>
                             
                                </div>
                            </div>
                        <?php } ?>

                            

                            <hr><br>
                            <div class="row lower">
                                <div>Subtotal<span class="text-right"><?=$sum?></span></div>
                            </div>
                            <div class="row lower">
                                <div>Delivery<span class="text-right">Free</span></div>
                            </div>
                            <div class="row lower">
                                <div><b>Total to pay<span class="text-right-total"><?=$sum?></span></b></div>
                            </div>
                            
                        </div>
                    </div>
                <!-- !!!!!!! end order detail !!!!! -->

                <!-- !!!!!!! payment !!!!! -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="left border">
                            <div class="row">
                                <span class="header">Payment</span>
                                <div class="icons">
                                    <!-- !!!!!!! เพิ่ม qr !!!!! -->
                                    <img src="img/PromptPay.png" width='250'/>
                                   
                                </div>
                            </div>
                           
                            <form action="paymentQR.php" method="post" >
                                <input type="hidden" name="username" value="<?=$_SESSION["username"]?>">
                                <input type="hidden" name="total_amount" value="<?=$sum?>">
                                <span>ชื่อ-สกุล :</span>
                                <input type="text" placeholder="Linda Williams" title="กรุณากรอกข้อมูล" required>
                                <span>เบอร์โทรศัพท์ :</span>
                                <input type="tel" placeholder="012 345 6789" required>
                                <div class="area">
                                    <span>ที่อยู่ :</span><br>
                                    <textarea name="address" rows="5" cols="50" required></textarea>
                                </div>
                                
                                <div class="row">
                                    <div class="col-4"><span>derivery date :</span>
                                        <input type="date" name="deriverydate" required>
                                    </div>
                                </div>
                                <input class="btn" type="submit"value="pay for your order" >
                            </form>
                            
                        </div> 
                                               
                    </div>
                    
                    
                </div>
                 <!-- !!!!!!! end payment !!!!! -->
            </div>         
         <div>
        </div>
        </div>

        <!--end-->         
        <footer>
            <div class="footer-content">
                
                <h3>Our Store Locations</h3>
                <ul id="footer-result"></ul>
                
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