<?php include "connect.php";
      session_start();
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
    </head>
    <style>
        
.card{
    max-width: 1000px;
    margin: 2vh;
}

.card-top{
    padding: 0.7rem 5rem;
}
.card-top a{
    float: left;
    margin-top: 0.7rem;
}
#logo{
    font-family: 'Dancing Script';
    font-weight: bold;
    font-size: 1.6rem;
}
.card-body{
    padding: 0 5rem 5rem 5rem;
    background-image: url("img/home/cake_head.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    
}
@media(max-width:600px){
    .card-body{
        padding: 0 1rem 1rem 1rem;
        background-image: url("img/home/cake_head.jpg");   
        background-size: cover;
        background-repeat: no-repeat;
    }  
    .card-top{
        padding: 0.7rem 1rem;
    }
}

.icons{
    margin-left: auto;
}
form span{
    color: rgb(179, 179, 179);
}
form{
    padding: 2vh 0;
}
input{
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247);
}
input:focus::-webkit-input-placeholder
{
      color:transparent;
}
.header{
    font-size: 1.5rem;
}
.left{
    background-color: #ffffff;
    padding: 2vh;   
}
.left img{
    width: 2rem;
}
.left .col-4{
    padding-left: 0;
}
.right .item{
    padding: 0.3rem 0;
}
.right{
    background-color: #ffffff;
    padding: 2vh;
}

.lower{
    line-height: 2;
}
.btn{
    background-color: saddlebrown;
    color: white;
    width: 100%;
    font-size: 0.7rem;
    margin: 4vh 0 1.5vh 0;
    padding: 1.5vh;
    border-radius: 10px;
    text-decoration: none;   
}
.btn:focus{
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    transition: none; 
}
.btn:hover{
    color: white;
    background-color: #563c15;
}
a{
    color: black;
}
a:hover{
    color: black;
    text-decoration: none;
}
input[type=checkbox]{
    width: unset;
    margin-bottom: unset;
}
#cvv{
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.575) , rgba(255, 255, 255, 0.541)), url("https://img.icons8.com/material-outlined/24/000000/help.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center;
} 

.cakecontent {
            background-color: #f4f4f4;
            margin: 20px 50px;
            border-radius: 15px;
            -webkit-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            -moz-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            display: inline-block;
            width:300px;
            height: 320px;;
}

.cakecontent-left {
    flex: 1;
    padding-top: 20px;
}

.cakecontent-right {
    flex: 1;
    padding-bottom: 5px;
    text-align: center;
}

    </style>
    <body>
        <!-- !!!!!!! shop name not has been entered !!!!! -->
        
        <nav>
            <div class="topnav" id="top-nav">
                <a href="Home_page.php"><i class="fa-solid fa-house"></i></a>
                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                    <i class="fa fa-bars"></i>
                </a>
                
            </div>
        <nav>
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
                                    <p>จำนวน : <?=$item["qty"]?> ชิ้น ( ขนาด <?=$item["Size_Pound_or_Piece"]?> ปอนด์)</p>
                                    <p>ราคา : <?=$item["price"]?></p>
                             
                                </div>
                            </div>
                        <?php } ?>

                            

                            <hr>
                            <div class="row lower">
                                <div class="col text-left">Subtotal</div>
                                <div class="col text-right"><?=$sum?></div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Delivery</div>
                                <div class="col text-right">Free</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><b>Total to pay</b></div>
                                <div class="col text-right"><b><?=$sum?></b></div>
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
                                    <img src="https://img.icons8.com/color/48/000000/visa.png"/>
                                    <img src="https://img.icons8.com/color/48/000000/mastercard-logo.png"/>
                                    <img src="https://img.icons8.com/color/48/000000/maestro.png"/>
                                </div>
                            </div>
                           
                            <form action="insert_order.php" method="post" >
                                <input type="hidden" name="username" value="<?=$_SESSION["username"]?>">
                                <input type="hidden" name="total_amount" value="<?=$sum?>">
                                <span>ชื่อ-สกุล :</span>
                                <input placeholder="Linda Williams">
                                <span>เบอร์โทรศัพท์ :</span>
                                <input placeholder="012 345 6789">
                                <span>ที่อยู่ :</span><br>
                                <textarea name="address" rows="5" cols="50"></textarea>
                                <div class="row">
                                    <div class="col-4"><span>derivery date :</span>
                                        <input type="date" name="deriverydate">
                                    </div>
                                </div>
                                <input type="checkbox" id="save_card" class="align-left">
                                <label for="save_card">Save card details to wallet</label>  
                                <input class="btn" type="submit"value="Place order" >
                                <p class="text-muted text-center">Complimentary Shipping & Returns</p>
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