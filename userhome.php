<?php
    include 'connect.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>User Home</title>

   <!-- font awesome cdn link  -->
   <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
   />
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css" />
   <script>
     function confirmDelete(username) {
            var ans = window.confirm("ต้องการลบผู้ใช้ " + username);
            if (ans) {
                document.location = "deleteaccount.php?username=" + username;
            }
        }
   </script>
</head>
<body>
   <section class="form-container">
      <h1>User Home</h1>
      <h1>Hello! <?=$_SESSION["fullname"]?></h1>
      If you want to log out, please click <a href="logout.php">Log out</a>
      <p>If you want to delete account, please click <?php
            $stmt = $pdo->prepare("SELECT * FROM members");
            $stmt->execute();
            echo "<a href='#' onclick='confirmDelete(\"" . $_SESSION["username"] . "\")'>Delete my account</a>";
        ?></p>
   </section>
</body>
</html>
