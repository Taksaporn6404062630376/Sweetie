
<?php include "../connect.php" ?>
<?php session_start();
echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";
echo "---------------------------------------";
// echo "<pre>";
// print_r($_SESSION['cart'][$_GET["menuID"]]['qty']);
// echo "</pre>";

echo $_GET["menuID"];
if (isset($_GET["menuID"])) {
    $targetMenuID = $_GET["menuID"];
    echo $targetMenuID;
    // นำ $targetMenuID มาใช้ในการหยิบสินค้าที่ต้องการจากตะกร้า
    // ...
    // วนลูปเข้าถึงรายการสินค้าในตะกร้า
    foreach ($_SESSION['cart'] as $cartItem) {
        // ตรวจสอบว่า menuID ของรายการสินค้าตรงกับค่าที่ต้องการหรือไม่
        if ($cartItem['menuID'] == $targetMenuID) {
            // นำค่าที่ต้องการมาใช้
            $menuID = $cartItem['menuID'];
            $menuname = $cartItem['menuname'];
            $sizeOrPiece = $cartItem['Size_Pound_or_Piece'];
            $price = $cartItem['price'];
            $qty = $cartItem['qty'];

            echo ''. $menuID .''. $menuname .'';
        }
    }
}
?>
