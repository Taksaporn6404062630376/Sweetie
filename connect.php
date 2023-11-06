<html>

<body>
    <?php
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=sweetie;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $conn = mysqli_connect('localhost','root','','sweetie') or die('connection failed');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>
</body>

</html>