<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT username FROM members WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    if ($stmt->fetch()) {
        // Insert the new user into the database
        $stmt = $pdo->prepare("INSERT INTO members (username, name, tel, email, password) VALUES (:username, :name, :tel, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $pass);
        $stmt->execute();
        $message[] = 'Registered successfully!';
        header('location: login.php');
    }
    else {
      echo '<script>var loginFailed = true;</script>';
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="style.css">
   
   <script>
       // Check if the login failed and show an alert
       if (typeof loginFailed !== 'undefined' && loginFailed) {
            alert('Incorrect email or password!');
        }
       // JavaScript to check the username
      var xmlHttp;
      function checkUsername() {
         document.getElementById("username").className = "thinking";
         xmlHttp = new XMLHttpRequest();
         xmlHttp.onreadystatechange = showUsernameStatus;
         var username = document.getElementById("username").value;
         var url = "checkusername.php?username=" + username;
         xmlHttp.open("GET", url, true);
         xmlHttp.send();
      }
      function showUsernameStatus() {
         var usernameStatus = document.getElementById("usernameStatus");
         if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
            if (xmlHttp.responseText == "okay") {
            document.getElementById("username").className = "approved";
            // usernameStatus.textContent = ""; // Clear the error message
            } else {
            document.getElementById("username").className = "denied";
            document.getElementById("username").focus();
            document.getElementById("username").select();
            usernameStatus.textContent = "Username already exists!";
            }
         }
      }
      //checkusername
      // var xmlHttp;
      // function checkUsername() {
      //    // document.getElementById("username").className = "thinking";
      //    xmlHttp = new XMLHttpRequest();
      //    xmlHttp.onreadystatechange = showUsernameStatus;
      //    var username = document.getElementById("username").value;
      //    var url = "checkusername.php?username=" + username;
      //    xmlHttp.open("GET", url, true);
      //    xmlHttp.send(null);
      // }
      // function showUsernameStatus() {
      //    if (xmlHttp.readyState == 4){
      //       if (xmlHttp.status == 200) {
      //          document.getElementById("username").className = "approved";
      //    }else{
      //       document.getElementById("username").className = "denied";
      //       document.getElementById("username").focus();
      //       document.getElementById("username").select();
      //    } 
      //    }
      // } 
      
      //check_phonenumber
      // var xmlHttp;
      // function checkPhone() {
      //    var telElement = document.getElementById("tel");
      //    telElement.className = "thinking";

      //    xmlHttp = new XMLHttpRequest();
      //    xmlHttp.onreadystatechange = showPhoneStatus;

      //    var tel = telElement.value;
      //    var url = "checkphone.php?tel=" + tel;
      //    xmlHttp.open("GET", url, true);
      //    xmlHttp.send();
      //    console.log("Checking phone..."); // Added a message to log
      // }

      // function showPhoneStatus() {
      //    var telElement = document.getElementById("tel");
      //    if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
      //       if (xmlHttp.responseText === "okay") {
      //          telElement.className = "approved";
      //       } else {
      //          telElement.className = "denied";
      //          telElement.title = "Phone number is already in use. Please choose a different one.";
      //          alert("Phone number is already in use. Please choose a different one.");
      //       }
      //    }
      // }
      
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
               button.textContent = "Hide";
            } else {
               input.type = "password";
               button.textContent = "Show";
            }
         }
   </script>
</head>
<body>
   <?php
      if(isset($message)){
         foreach($message as $message){
            echo '
            <div class="message">
               <span>'.$message.'</span>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      }
   ?>
   <section class="form-container">
      <form action="" method="post" onsubmit="return validateForm()">
         <h1>Register now</h1>
         <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" placeholder="Make your username" pattern="^[a-zA-Z0-9_]{3,20}$" title="Username must be 3-20 characters." required class="box" onkeyup="checkUsername()">
            <span id="usernameStatus" class="status"></span>
         </div>
         <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" pattern="^[A-Za-z\s]^[ก-๏\s]+{3,100}$" title="Name must contain only letters and spaces, at least 3 characters." required class="box">
         </div>
         <div class="form-group">
            <label for="tel">Phone number:</label>
            <input type="text" name="tel" id="tel" placeholder="Enter your phone number" required class="box" onblur="checkPhone()">
         </div>
         <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required class="box">
         </div>
         <div class="pass-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required class="box">
            <button type="button" id="togglePassword" onclick="togglePasswordVisibility('password', 'togglePassword')">Show</button>    
         </div>
         <div class="pass-group">
            <label for="cpassword">Confirm Password:</label>
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" required class="box">
            <button type="button" id="toggleCPassword" onclick="togglePasswordVisibility('cpassword', 'toggleCPassword')">Show</button>
         </div>
         <input type="submit" name="submit" value="Creat Account" class="btn"><br>
         <p>Already have an account? <a href="login.php">Login now</a></p>
      </form>
   </section>
</body>
</html>
