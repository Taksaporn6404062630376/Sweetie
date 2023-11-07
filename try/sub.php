<?php 
session_start();
include "connect.php";

if (!isset($_SESSION['username'])) {
	header("location:login.php");
}
else{
    echo 'yes' .$_POST["username"];
}

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
        // $_SESSION['orderID'] = $orderID;
        $orderID = $pdo->lastInsertId();
//     foreach($_SESSION["cart"] as $item => $pd){
        
//         $menuID = $pd["menuID"];
//         $qty = $pd["qty"];
//         // echo $menuID. ' ';
//         // echo $qty. ' ';

//         // ดึงราคาจากฐานข้อมูล
//         $priceStmt = $pdo->prepare("SELECT price FROM menu WHERE menuID = ?");
//         $priceStmt->bindParam(1, $menuID);
//         $priceStmt->execute();
//         while($row = $priceStmt->fetch()){
//             $price = floatval($row['price']);
//             $sub_total = $qty * $price;
//             echo floatval($row['price'])*$pd["qty"]. ' ';
//             $orderDetailsStmt = $pdo->prepare("INSERT INTO `orderdetails` VALUES ('', ?, ?, ?, ?)");
//             $orderDetailsStmt->bindParam(1,  $orderID);
//             $orderDetailsStmt->bindParam(2,  $pd["menuID"]);
//             $orderDetailsStmt->bindParam(3, $pd["qty"]);
//             $orderDetailsStmt->bindParam(4, $sub_total);
//             $orderDetailsStmt->execute();
//             $order_details_id = $pdo->lastInsertId(); 
//         }
//     }
echo "<script>alert('สั่งซื้อสินค้าเรียบร้อย');window.location.href = 'index.php';</script>";
?>

