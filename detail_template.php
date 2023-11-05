<!DOCTYPE html>
<?php session_start(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <link href="css/details.css" rel="stylesheet">
</head>
<body>
    <div class="cakecontent">
        <div class="cakecontent-left">
            <div class='borderCake'>
                <img src="<?php echo $menu_image; ?>" alt="<?php echo $product_name; ?>" width='450'>  
            </div>
        </div>
        <div class="cakecontent-right">
            <div class="cakeDet">
                <h2><?php echo $product_name; ?> </h2>
                <h2><?php echo $product_nameen; ?></h2><br>
                <p><?php echo $detail; ?></p>
                <p>ราคา : <b><?php echo $price; ?></b> บาท </p><br><br>
                <!-- <tocart> -->
                <form method="post" action="Cart.php?action=add&menuID=<?=$row["menuID"]?>&menuname=<?=$row["menuname"]?>&Size_Pound_or_Piece=<?=$row["Size_Pound_or_Piece"]?>&price=<?=$row["price"]?>">
                    จำนวน  <input type="number" name="qty" size="5" value="1" min="1" max="9"><br><br>
                <button type="submit"><i class="fa-solid fa-bag-shopping"></i>  add to cart</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>