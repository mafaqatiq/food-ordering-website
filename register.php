<?php

include 'config.php';

if (isset($_POST['submit'])) {

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, $_POST['password']);
   $cpass = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
   $user_type = $_POST['role'];

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {
      $message[] = 'User already exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'Passwords do not match!';
      } else {
         // Use password_hash for secure password hashing
         $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
         mysqli_query($conn, "INSERT INTO `users` (name, email, password, user_type) VALUES ('$name', '$email', '$hashed_password', '$user_type')") or die('query failed');
         $message[] = 'Registered successfully!';
         header('location:login.php');
      }
   }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register</title>
   <link rel="stylesheet" href="style.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

   <style>
      .eye-icon {
         position: absolute;
         right: 10px;
         top: 50%;
         transform: translateY(-50%);
         cursor: pointer;
      }

      .error-message {
         color: red;
         font-size: 0.8rem;
         margin-top: 0.25rem;
      }
   </style>
</head>

<body style="width: 100%;">

   <?php
   if (isset($message)) {
      foreach ($message as $message) {
         echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <div class="register-body">
      <div class="container">
         <h1 class="register-now-txt">Register Now</h1>
         <form action="" method="post">
            <div class="form-floating">
               <input type="text" class="form-control" id="floatingName" name="name" placeholder="studentName"
                  pattern="^[a-zA-Z ]+$" required>
               <label for="floatingName" class="label-txt">Enter your name</label>
            </div>
            <div class="form-floating ">
               <input type="email" class="form-control" id="floatingEmail" name="email" placeholder="studentEmail"
                  required>
               <label for="floatingEmail" class="label-txt">Enter your email</label>
            </div>
            <div class="form-floating position-relative">
               <input type="password" class="form-control" id="floatingPassword" name="password"
                  placeholder="studentPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$"
                  minlength="8" required>
               <label for="floatingPassword" class="label-txt">Enter your password</label>
               <span class="eye-icon" onclick="togglePasswordVisibility('floatingPassword')">
                  <i class="fa fa-eye" aria-hidden="true"></i>
               </span>
            </div>
            <div class="form-floating position-relative">
               <input type="password" class="form-control" id="floatingConfirmPassword" name="confirmPassword"
                  placeholder="studentConfirmPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\da-zA-Z]).{8,}$"
                  minlength="8" required>
               <label for="floatingConfirmPassword" class="label-txt">Confirm your password</label>
               <span class="eye-icon" onclick="togglePasswordVisibility('floatingConfirmPassword')">
                  <i class="fa fa-eye" aria-hidden="true"></i>
               </span>
            </div>


            <div class="form-floating ">
               <select class="form-select" id="floatingRole" name="role">
                  <option value="user" selected>User</option>
                  <option value="admin">Admin</option>
               </select>
               <label for="floatingRole" class="label-txt">Register as a:</label>
            </div>
            <div class="d-grid pt-2">
               <input class="custom-button" type="submit" name="submit" value="Submit" class="btn">
            </div>
            <div style="margin-top:5px;">
               <p style="color: white;">already have an account? <a href="login.php">Login now</a></p>
            </div>
         </form>
      </div>
   </div>
   <script src="script.js"></script>

</body>

</html>