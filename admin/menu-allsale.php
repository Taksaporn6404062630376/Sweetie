<?php
include "../connect.php";
session_start();
$menuCountStmt = $pdo->prepare("SELECT m.menuname, COALESCE(SUM(COALESCE(od.quantity, 0)), 0) 
    AS total_quantity, COALESCE(SUM(COALESCE(od.sub_total, 0)), 0) 
    AS total_sales FROM menu m LEFT JOIN orderdetails od 
    ON m.menuID = od.menuID GROUP BY m.menuname;");
$menuCountStmt->execute();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link href="../css/adminn.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <ul class="nav">
        <li><a href="all-orders.php">ดูรายการ Order ของลูกค้า</a></li>
        <li><a href="all-payments.php">ดูการจ่ายเงิน payment ของลูกค้า</a></li>
        <li><a href='income-day.php'>ดูยอดรวมเงินที่รับจากการชำระเงินในแต่ละวัน</a></li>
        <li><a class="active" href='menu-allsale.php'>ดูรายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</a></li>
        <li><a href='menu.php'>จัดการเมนู</a></li>
        <li class="logout"><a class="redactive" href="../logout.php">Log out</a></li>
    </ul>

    <h2>รายการอาหารที่ขายได้และยอดรวมขายได้ในแต่ละเมนู</h2>
    <form id="sortForm" style="float: right; padding-bottom: 20px">
        <label for="sort">เรียงลำดับตาม:</label>
        <select id="sort" name="sort">
            <option value="desc_sales">Total Sales: มากสุด</option>
            <option value="asc_sales">Total Sales: น้อยสุด</option>
            <option value="desc_quantity">Total Quantity: มากสุด</option>
            <option value="asc_quantity">Total Quantity: น้อยสุด</option>
        </select>
    </form>

    <?php
    // Fetch the data from the database and store it in a PHP array
    $menuData = [];
    while ($menuCountRow = $menuCountStmt->fetch()) {
        $menuData[] = $menuCountRow;
    }

    // Sort the data based on the selected option
    if (isset($_GET['sort'])) {
        $sortOption = $_GET['sort'];

        switch ($sortOption) {
            case 'desc_sales':
                $sortColumn = 'total_sales';
                $sortOrder = SORT_DESC;
                break;
            case 'asc_sales':
                $sortColumn = 'total_sales';
                $sortOrder = SORT_ASC;
                break;
            case 'desc_quantity':
                $sortColumn = 'total_quantity';
                $sortOrder = SORT_DESC;
                break;
            case 'asc_quantity':
                $sortColumn = 'total_quantity';
                $sortOrder = SORT_ASC;
                break;
            default:
                $sortColumn = 'total_sales'; // Default sorting
                $sortOrder = SORT_DESC;
                break;
        }

        array_multisort(array_column($menuData, $sortColumn), $sortOrder, $menuData);
    }
    ?>

    <table>
        <tr>
            <th>Menuname</th>
            <th>Total Quantity</th>
            <th>Total Sales</th>
        </tr>
        <?php foreach ($menuData as $menuCountRow) : ?>
            <tr>
                <td><?= $menuCountRow['menuname'] ?></td>
                <td><?= $menuCountRow['total_quantity'] ?></td>
                <td><?= $menuCountRow['total_sales'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        document.getElementById("sort").addEventListener("change", function() {
            var selectedSort = this.value;
            window.location.href = 'menu-allsale.php?sort=' + selectedSort;
        });
    </script>

</body>

</html>