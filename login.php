<?php
include 'connect.php';
session_start();

if (isset($_POST['submit'])) {
   $stmt = $pdo->prepare("SELECT * FROM members WHERE email = ? AND password = ?");
   $stmt->bindParam(1, $_POST["email"]);
   $stmt->bindParam(2, $_POST["password"]);
   $stmt->execute();
   $row = $stmt->fetch();
   
   if (!empty($row)) {
      // Set cookies for user information
      setcookie("fullname", $row["name"], time() + 3600, "/");
      setcookie("username", $row["username"], time() + 3600, "/");
      setcookie("useremail", $row["email"], time() + 3600, "/");
      $_SESSION["fullname"] = $row["name"];
      $_SESSION["username"] = $row["username"];
      $_SESSION['useremail'] = $row['email'];
      exit();
      header('location: userhome.php');
  }
//    else {
//       $loginFailed = true;
//   }
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <script>
      // Check if the login failed and show an loginstatus
   //    function validateForm(loginFailed) {
   //      var errorMsg = document.getElementById("errormsg");
   //      if (loginFailed===true) {
   //       errorMsg.innerHTML = '';  // Clear any previous error messages
   //       console.log("true");
   //      } else {
   //          errorMsg.innerHTML = 'Incorrect email or password!';
   //      }
   //  }


      function togglePasswordVisibility(inputId, buttonId) {
         var input = document.getElementById(inputId);
         var button = document.getElementById(buttonId);
         if (input.type === "password") {
            input.type = "text";
            button.innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
         } else {
            input.type = "password";
            button.innerHTML = '<i class="fa-solid fa-eye"></i>';
         }
      }
   </script>
</head>
<body>
   <section class="form-container">
      <form action="" method="post">
         <h1>Login now</h1>
         <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required class="box">
         </div>
         <div class="pass-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required="" id="password" placeholder="Enter your password" required class="box" >
            <button type="button" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"><i class="fa-solid fa-eye"></i></button>
         </div>
         <div id="errormsg"></div>
         <div class="btn-container">
            <input type="submit" name="submit" value="Login" class="btn">
         </div>
         <p>Don't have an account? <a href="register.php">register now</a></p>
      </form>
   </section>
</body>
</html>