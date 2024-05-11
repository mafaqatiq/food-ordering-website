<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin-users.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin-style.css">

</head>

<body>


   <header>
      <nav>
         <div id="nav-inner1">
            <div id="nav-inner-inner1">
               <img id="logo" src="images/logo.png" alt="">
               <span id="logo-text">Admin <span class="panel">Panel</span></span>
            </div>
         </div>
         <div id="nav-inner2">
            <ol>
               <li class="list border-animation" id="list1"><a href="#" onclick="changeActive('list1')">Home</a></li>
               <li class="list border-animation" id="list2"><a href="#" onclick="changeActive('list2')">Products</a>
               </li>
               <li class="list border-animation" id="list3"><a href="#" onclick="changeActive('list3')">Orders</a></li>
               <li class="list border-animation" id="list4"><a href="#" class="default-color"
                     onclick="changeActive('list4')">Users</a></li>
            </ol>

         </div>

         <div id="nav-inner3">
            <div id="nav-inner-inner3">
               <input class="get-started-btn get-start" onclick="window.location.href='logout.php'" type="button"
                  value="Logout">
            </div>
         </div>

      </nav>
   </header>



   <section class="users">

      <h1 class="title">User Accounts</h1>

      <div class="users-box-container">
         <?php
         $select_users = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
         while ($fetch_users = mysqli_fetch_assoc($select_users)) {
            ?>
            <div class="users-box">
               <p> User ID: <span>
                     <?php echo $fetch_users['id']; ?>
                  </span> </p>
               <p> Username: <span>
                     <?php echo $fetch_users['name']; ?>
                  </span> </p>
               <p> Email: <span>
                     <?php echo $fetch_users['email']; ?>
                  </span> </p>
               <p> User Type: <span style="color:<?php if ($fetch_users['user_type'] == 'admin') {
                  echo 'var(--orange)';
               } ?>">
                     <?php echo $fetch_users['user_type']; ?>
                  </span> </p>
               <a href="admin-users.php?delete=<?php echo $fetch_users['id']; ?>" style="color:red;"
                  onclick="return confirm('Delete this user?');" class="users-delete-btn">Delete User</a>
            </div>
            <?php
         }

         ?>
      </div>
      </div>

   </section>










   <!-- custom admin js file link  -->
   <script src="script.js"></script>

</body>

</html>