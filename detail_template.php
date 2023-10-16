<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
</head>
<body>
    <div class="cakecontent">
        <div class="cakecontent-left">
            <img src="<?php echo $menu_image; ?>" alt="<?php echo $product_name; ?>" width='300'>
        </div>
        <div class="cakecontent-right">
            <h2><?php echo $product_name; ?></h2><br>
            <p><?php echo $detail; ?></p>
            <p>ราคา : <b><?php echo $price; ?></b> บาท </p><br><br>
            <!-- <tocart> -->
            <a href="addtocart.php"><i class="fa-solid fa-plus"></i> หยิบใส่ตะกร้า</a><br><br>
        </div>
    </div>
</body>
</html>