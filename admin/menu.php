<?php
    include "../connect.php";
    session_start();
    $menu = $pdo->prepare("SELECT * from menu");
    $menu->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
    <script>
    function confirmDelete(menuID) { 
        var ans = confirm("ต้องการลบเมนูนี้ "); 
        if (ans==true) 
            document.location = "delete.php?menuID="+ menuID; 
    }
    </script>
    
</head>
<body>
<ul class="nav">
      <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
      <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
    <li><a  href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
    <li><a class="active" href='menu.php'>จัดการเมนู</a></li>
    <li style="float:right"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>
    <h2>รายการสินค้าทั้งหมด <button><a href="addmenu.php">เพิ่มรายการใหม่</a></button></h2>
    

    <table>
        <tr>
            <th>Menuname</th>
            <th>Piece/Pound</th>
            <th>Price</th>
            <th></th><!--delete-->
            <th></th><!--update-->
        </tr>
        <?php while ($row = $menu->fetch()) : ?>
            <tr>
                <td><?= $row['menuname'] ?></td>
                <td><?= $row['Size_Pound_or_Piece'] ?></td>
                <td><?= $row['price'] ?></td>
                <td ><a href="editform.php?menuID=<?= $row['menuID'] ?>">แก้ไข</a></td>
                <td ><a href="#" onclick="confirmDelete('<?= $row['menuID'] ?>')"> ลบ</a></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>
