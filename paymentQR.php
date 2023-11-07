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
    <?php

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
        
    foreach($_SESSION["cart"] as $item => $pd){
        
        $menuID = $pd["menuID"];
        $qty = $pd["qty"];
        // echo $menuID. ' ';
        // echo $qty. ' ';

        // ดึงราคาจากฐานข้อมูล
        $priceStmt = $pdo->prepare("SELECT price FROM menu WHERE menuID = ?");
        $priceStmt->bindParam(1, $menuID);
        $priceStmt->execute();
        while($row = $priceStmt->fetch()){
            $price = floatval($row['price']);
            $sub_total = $qty * $price;
            // echo floatval($row['price'])*$pd["qty"]. ' ';
            $orderDetailsStmt = $pdo->prepare("INSERT INTO `orderdetails` VALUES ('', ?, ?, ?, ?)");
            $orderDetailsStmt->bindParam(1,  $orderID);
            $orderDetailsStmt->bindParam(2,  $pd["menuID"]);
            $orderDetailsStmt->bindParam(3, $pd["qty"]);
            $orderDetailsStmt->bindParam(4, $sub_total);
            $orderDetailsStmt->execute();
            $order_details_id = $pdo->lastInsertId(); 
        }
    }
    
        $paymentStatus = 'wait';
        $payment = $pdo->prepare("INSERT INTO `payment` VALUES ('',?,?,?)");
        $payment->bindParam(1, $orderID);
        $payment->bindParam(2, $paymentStatus);
        $payment->bindParam(3, $formattedDate);
        $payment->execute();
        $paymentID  = $pdo->lastInsertId();  
    ?>
        

        
    <div class="hidden-sum">
        <input type="hidden" id="amount" value="<?= $sum?>">  
    </div>
    <section class="qr-code">
        <div class="top-qr">
            <div class='border-qr'>
                <h2>กรุณาชำระเงิน</h2>
                <img id="imgqr" src="" style="width: 400px; object-fit: contain;">
                <h3>ยอดชำระ : <?= $sum?> บาท</h3>
            </div>
        </div>
        
        <div class="but">
            <a href="ordercomplete.php">กลับหน้าหลัก</a>
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