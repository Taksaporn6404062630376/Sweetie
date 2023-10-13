<html>
    <body>
        <?php

            $pdo = new PDO("mysql:host=localhost;dbname=sweetie;charset=utf8", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           // $conn = mysqli_connect('localhost','root','','sweetie') or die('connection failed');
        ?>
    </body>
</html>