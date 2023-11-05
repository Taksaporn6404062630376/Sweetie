<?php
    include "../connect.php";
    session_start();
?>

<?php
    $stmt = $pdo->prepare("INSERT INTO menu VALUES ('', ?, ?,?, ?, ?)");
    $stmt->bindParam(1, $_POST["menuname"]);
    $stmt->bindParam(2, $_POST["menunameen"]);
    $stmt->bindParam(3, $_POST["Size_Pound_or_Piece"]);
    $stmt->bindParam(4, $_POST["detail"]);
    $stmt->bindParam(5, $_POST["price"]);
    if ($stmt->execute()) {
        $value = 'เพิ่มเมนูสำเร็จ';
    }
    else{
        $value = 'เพิ่มเมนูไม่สำเร็จ';
    }
    $menuID = $pdo->lastInsertId();   
    
    $image_file = $_FILES["image"];

    // Exit if no file uploaded
    if (!isset($image_file)) {
        die('No file uploaded.');
    }
    
    // Exit if is not a valid image file
    $image_type = exif_imagetype($image_file["tmp_name"]);
    if (!$image_type) {
        die('Uploaded file is not an image.');
    }

    // Convert uploaded image to PNG format
    $png_file_path = __DIR__ . "/../img/menu-1/" . pathinfo($image_file["name"], PATHINFO_FILENAME) . ".png";
    $success = imagepng(imagecreatefromstring(file_get_contents($image_file["tmp_name"])), $png_file_path);

    if (!$success) {
        die('Error converting image to PNG format.');
    }

    // Move the temp PNG image file to the images/ directory
    move_uploaded_file(
        $png_file_path,
        __DIR__ . "/../img/menu-1/" . $image_file["name"]
    );


?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/admin.css" rel="stylesheet">

</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
      <li><a href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
      <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2><?=$value?></h2>
    <a href="menu.php">next</a>
</body>
</html>
้
