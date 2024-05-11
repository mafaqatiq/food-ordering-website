<?php

include 'config.php';
session_start();

if (isset($_POST['submit'])) {

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if (mysqli_num_rows($select_users) > 0) {

      $row = mysqli_fetch_assoc($select_users);
      $hashed_password = $row['password'];

      if (password_verify($password, $hashed_password)) {

         if ($row['user_type'] == 'admin') {

            $_SESSION['admin_name'] = $row['name'];
            $_SESSION['admin_email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];
            header('location:admin-page.php');

         } elseif ($row['user_type'] == 'user') {

            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_id'] = $row['id'];
            header('location:landing-page.php');
         }

      } else {
         $message[] = 'Incorrect email or password!';
      }

   } else {
      $message[] = 'User not found!';
   }

}

?>





<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
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
         <h1 class="register-now-txt">Login</h1>
         <form action="" method="post">
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



            <div class="d-grid pt-2">
               <input class="custom-button" type="submit" name="submit" value="Login" class="btn">
            </div>

            <div style="margin-top:5px;">
               <p style="color: white;">don't have an account? <a href="register.php">Register now</a></p>
            </div>
         </form>
      </div>
   </div>
   <script src="script.js"></script>

</body>

</html>