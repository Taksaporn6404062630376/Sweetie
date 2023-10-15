<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <style>
        .cakedetail {
            background-color: #f4f4f4;
            margin: 20px 50px;
            border-radius: 15px;
            -webkit-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            -moz-box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
            display: flex;
        }
        
        .cakedetail-left {
            flex: 1;
            padding: 20px;
        }
        
        .cakedetail-right {
            flex: 1;
            padding: 80px;
            text-align: center;
        }

        .cakedetail a{
            text-decoration: none;
            color:#f4f4f4;
            background-color: #573822;
            padding:10px;
            border-radius:15px;
        }

        .cakedetail a:hover{
            color:#d2d3d2;
            background-color: saddlebrown;
        }
    </style>
</head>
<body>
    <div class="cakedetail">
        <div class="cakedetail-left">
            <img src="<?php echo $menu_image; ?>" alt="<?php echo $product_name; ?>" width='300'>
        </div>
        <div class="cakedetail-right">
            <h2><?php echo $product_name; ?></h2><br>
            <p><?php echo $detail; ?></p>
            <p>ราคา : <b><?php echo $price; ?></b> บาท </p><br><br>
            <!-- <tocart> -->
            <a href="addtocart.php"><i class="fa-solid fa-plus"></i> หยิบใส่ตะกร้า</a><br><br>
        </div>
    </div>
</body>
</html>