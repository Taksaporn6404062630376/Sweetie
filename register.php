<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("SELECT * FROM members WHERE username LIKE ?");
    $stmt->bindParam(1, $_POST["username"]);
    $stmt->execute();
      // $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
   // Insert the new user into the database
   $stmt = $pdo->prepare("INSERT INTO members (username, name, tel, email, password) VALUES (?, ?, ?, ?, ?)");
   $stmt->bindParam(1, $_POST["username"]);
   $stmt->bindParam(2, $_POST["name"]);
   $stmt->bindParam(3, $_POST["tel"]);
   $stmt->bindParam(4, $_POST["email"]);
   $stmt->bindParam(5, $_POST["password"]); // บันทึกรหัสผ่านที่ถูกแฮช
   $stmt->execute();
   setcookie('username', $_POST['username'], time() + 3600 * 24 * 7); // Cookie expires in 7 days
   header('location: login.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Whisk & Roll Bakery</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/register.css">
   
   <script>
       // Check the username Ajax
       var xmlHttp;
       function checkUsername() {
         document.getElementById("username").className = "thinking";
         
         xmlHttp = new XMLHttpRequest();
         xmlHttp.onreadystatechange = showUsernameStatus;
         
         var username = document.getElementById("username").value;

         var url = "checkusername.php?username=" + username;
         xmlHttp.open("GET", url);
         xmlHttp.send();
      }
      
      function showUsernameStatus() {
         if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if (xmlHttp.responseText !== "okay") {
               document.getElementById("username").className = "denied";
               document.getElementById("errormsg").innerHTML = 'Username is already taken. Please choose another one or Login.';
               document.getElementById("username").focus();
               // Disable other form fields
               document.getElementById("name").disabled = true;
               document.getElementById("tel").disabled = true;
               document.getElementById("email").disabled = true;
               document.getElementById("password").disabled = true;
               document.getElementById("cpassword").disabled = true;
            } else {
               document.getElementById("username").className = "approved";
               document.getElementById("errormsg").innerHTML = '';
               document.getElementById("name").disabled = false;
               document.getElementById("tel").disabled = false;
               document.getElementById("email").disabled = false;
               document.getElementById("password").disabled = false;
               document.getElementById("cpassword").disabled = false;
            }
         }
      }

      //check_password
      function validateForm() {
         var password1 = document.getElementById("password").value;
         var password2 = document.getElementById("cpassword").value;
         // Check if the password and confirm password match
         if (password1 !== password2) {
            alert("Passwords do not match.");
            return false;
         }

         // Check if the password meets certain criteria using regex
         var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
         if (!password.match(passwordPattern)) {
            alert("Password must contain at least one lowercase letter, one uppercase letter, one number, and be at least 8 characters long.");
            return false;
         }
         // Continue with form submission if all checks pass
         return true;
      }

      //showpasssword
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
      <form method="post" onsubmit="return validateForm()">
         <h1>Register now</h1>
         <p>Already have an account? <a href="login.php">Login now</a></p>
         <div class="form-group">
            <label for="username">Username:</label>
            <input id="username" type="text" name="username" id="username" placeholder="Make your username" pattern="^[a-zA-Z0-9_]{2,20}$" title="Username in English must be 2-20 characters." required class="box" onblur="checkUsername()">
            <div id="errormsg"></div>
         </div>
         <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" pattern="^[A-Za-z\s]^[ก-๏\s]+{3,100}$" title="Name must contain only letters and spaces, at least 3 characters." required class="box">
         </div>
         <div class="form-group">
            <label for="tel">Phone number:</label>
            <input id="tel" type="text" name="tel" placeholder="Enter your phone number" required class="box">
         </div>
         <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required class="box">
         </div>

         <div class="pass-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" pattern="^[a-zA-Z0-9_]{2,20}$" title="Password be in English, at least 8 characters." required class="box">
            <button type="button" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')"><i class="fa-solid fa-eye"></i></button>    
         </div>
         <div class="pass-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" required class="box">
            <button type="button" id="toggleCPassword" onclick="togglePasswordVisibility('cpassword', 'toggleCPassword')"><i class="fa-solid fa-eye"></i></button>
         </div>
         <div class="btn-container">
            <input type="submit" name="submit" value="Create Account" class="btn">
         </div>
         
      </form>
   </section>
</body>
</html>
