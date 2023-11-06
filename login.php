<!DOCTYPE html>
<html lang="en">

<head>
   <title>Whisk & Roll Bakery</title>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/register.css">
   <script src="JSON/location.js"></script>
   <script>
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
      <form action="admin/check-login.php" method="POST">
         <h1>Login now</h1>
         <!-- <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required class="box">
         </div> -->
         <div class="form-group">
            <label for="username">Username:</label>
            <input id="username" type="text" name="username" id="username" placeholder="Enter your username" pattern="^[a-zA-Z0-9_]{2,20}$" title="Username in English must be 2-20 characters." required class="box">
         </div>
         <div class="pass-group">
            <label for="password">Password:</label>
            <input type="password" name="password" required="" id="password" placeholder="Enter your password" required class="box">
            <button type="button" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"><i class="fa-solid fa-eye"></i></button>
         </div>
         <div class="btn-container">
            <!-- <a href="mypassword.php" style="text-align:left">I'm Forgot Password</a> -->
            <input type="submit" name="submit" value="Login" class="btn">
         </div>
         <p>Don't have an account? <a href="register.php">Register now</a></p>
      </form>
   </section>
</body>

</html>