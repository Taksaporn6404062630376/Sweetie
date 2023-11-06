<?php include "connect.php" ?>
<?php session_start();
$sum = $_SESSION['sum'];?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home2.css" rel="stylesheet">
    <link href="css/payment.css" rel="stylesheet">

    <title>Whisk & Roll Bakery</title>
</head>
<body>
    <!-- <?php

        $date = new DateTime();
        $date ->setTimezone(new DateTimeZone('Asia/Bangkok'));
        $formattedDate = $date->format("Y-m-d");
        $date2 = date("Y-m-d");
        $status="wait";

        $stmt = $pdo->prepare("INSERT INTO orders VALUES ('', ?, ?, ?, ?, ?, ?)");
        $stmt->bindParam(1, $_POST["username"]);
        $stmt->bindParam(2, $formattedDate);
        $stmt->bindParam(3, $_POST["deriverydate"]);
        $stmt->bindParam(4, $_POST["total_amount"]); 
        $stmt->bindParam(5, $status);
        $stmt->bindParam(6, $_POST["address"]);
        $stmt->execute();
        $value = '' . $_POST["username"] . '';
        $orderID = $pdo->lastInsertId();   

    ?> -->
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
        
    <div class="hidden-sum">
        <input type="text" id="amount" value="<?= $sum?>">  
    </div>
    <section class="qr-code">
        <div class='border-qr'>
            <h2>กรุณาชำระเงิน</h2>
            <img id="imgqr" src="" style="width: 400px; object-fit: contain;">
            <h3>ยอดชำระ : <?= $sum?> บาท</h3>
        </div>
       
    </section>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
       
        $(document).ready(function (){
            $.ajax({
                method: 'post',
                url: 'http://localhost:3000/generateQR',
                data: {
                    amount: parseFloat($("#amount").val())
                },
                success: function(response){
                    console.log('good', response)
                    $("#imgqr").attr('src', response.Result)
                }, error: function(err){
                    console.log('bad', err)
                }
            })
        })

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