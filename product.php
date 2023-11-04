<?php
include("include/connect.php");
if(isset($_GET['pid'])){
    $pid = $_GET['pid'];
}
if (!isset($_POST['product']) || !isset($_POST['pid'])) {
    header("location: store.php");
} else {
    $pid = $_POST['product']; //get value from button name product (value is pid)
}
?>

<head>
    <link href="style/store/product.css" rel="stylesheet">
    <script>
         function Check(pid, pname, price) {
            let create = document.getElementById("error-message");
            let q = document.getElementById("quan").value;
            let add = document.getElementById("addtext");

            if (q <= 0) {
                if (!create) {
                    create = document.createElement("h3");
                    create.id = "error-message";
                    add.appendChild(create);
                }
                create.innerHTML = "สินค้าต้องมีค่าเป็น 1 ขึ้นไป";
            } else {
                if (create) {
                    // Remove the error message if it exists
                    create.remove();
                }
                location = "cartAdd.php?action=add&pid=" + pid + "&pname=" + pname + "&price=" + price + "&quan=" + q;
            }
}
    </script>
</head>

<body>
    <header>
        <?php include("include/header.php"); ?>
    </header>
    <main>
        <?php
        $show_product = $pdo->prepare("SELECT * FROM product WHERE pid = :pid");
        $show_product->bindParam(":pid", $pid);
        $show_product->execute();
        $row = $show_product->fetch(PDO::FETCH_ASSOC);
        ?>
        <section>
            <div class="bg-light py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-0 color1">
                            <article style="display: flex;justify-content: center;align-items: center;">
                                <a href="index.php" class="changec">หน้าหลัก</a> <span class="mx-2 mb-0">/</span>
                                <a href="store.php" class="changec">รายการสินค้า</a> <span class="mx-2 mb-0">/</span>
                                <span><?=$row['pname']?></span>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <aside>
            <div class="container" style="margin-top: 2rem;">
                <img src="<?=$row['pimg']?>" width="100" height="100">
                <p><?=$row['pname']?></p>
                <p>รายละเอียดสินค้า</p>
                <p style="opacity: 0.5;"><?=$row['pdetail']?></p>
                <p><span>ราคา : </span><?=number_format($row['price'],2)?> ฿</p>
                <p><span>จำนวนในสต๊อก : </span><?=$row['pquan_stock']?> </p>
                
                
                
                
                <input type="number" id="quan" name="quan" value="0">
                
                <div id="addtext"></div>
                <div><button type="submit" onclick="Check('<?=$pid?>','<?=$row['pname']?>','<?=$row['price']?>')" name="add" value="เพิ่มลงตะกร้า" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;">เพิ่มลงตะกร้า</button>
                    
                <span><i class="fa-regular fa-heart" style="background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;"></i></span></div>
                
            </div>
        </aside>
    </main>
</body>