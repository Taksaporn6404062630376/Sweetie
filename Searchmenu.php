<?php include "connect.php";?>
<html>
    <head>
        <title>ชื่อร้านยังไม่คิด</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1.0, minimum-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@100;200;300;400&display=swap" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    </head>
        <br><br>
        <div class="menu">
 
        <?php
            $keyword = $_GET["search"];
            $conn = mysqli_connect("localhost", "root", "", "sweetie");

            $sql = "SELECT * FROM menu WHERE menuname LIKE '%$keyword%'";
            $objQuery = mysqli_query($conn,$sql);
        ?>
        <?php while ($row = mysqli_fetch_assoc($objQuery)): ?>
        <?php
            if($row["menuname"] == 'เค้ก%' ){
                echo"<div class='menu-image'><a href='selectsize_pound.php?menuname=".$row["menuname"]."'><img src='img/menu/{$row['menuname']}.jpg'width='400'></a></div><br><br><br>";
            } else {
                echo"<div class='menu-image'><a href='selectsize_piece.php?menuname=".$row["menuname"]."'><img src='img/menu/{$row['menuname']}.jpg'width='400'></a></div><br><br><br>";
            }
        ?>

        <?php endwhile; ?>
            <!-- <img src=""> -->
            
        </div>

    </body>
</html>