<?php
    session_start();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
);


    session_destroy();
    header("location: index.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
   <section class="form-container">
      <h1>Logged out successfully</h1>
   </section>
   <footer>
    <p>If you want to log in again, please click <br><a href="login.php">Log in</a></p>
    <div class="btn"><a href="index.php">Home page</a></div>
   </footer>
</body>
</html>
