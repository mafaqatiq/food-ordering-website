<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_POST['update_order'])) {

   $order_update_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'") or die('query failed');
   $message[] = 'payment status has been updated!';

}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin-orders.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

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
               <li class="list border-animation" id="list3"><a class="default-color" href="#"
                     onclick="changeActive('list3')">Orders</a></li>
               <li class="list border-animation" id="list4"><a href="#" onclick="changeActive('list4')">Users</a></li>
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

   <section class="orders">

      <h1 class="title">Placed Orders</h1>

      <div class="box-container">
         <?php
         $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
         if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
               ?>
               <div class="box">
                  <p style="width:100%;"> <span style="margin-right:201px; text-align:start; float:left;"> user id :</span>
                     <span style="float:right;">
                        <?php echo $fetch_orders['user_id']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:73px; text-align:start; float:left;"> placed on :</span>
                     <span style="float:right;">
                        <?php echo $fetch_orders['placed_on']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:186px; text-align:start; float:left;"> name : </span><span
                        style="float:right;">
                        <?php echo $fetch_orders['name']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:101px; text-align:start; float:left;"> number :</span>
                     <span style="float:right;">
                        <?php echo $fetch_orders['number']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:94px; text-align:start; float:left;"> email :</span> <span
                        style="float:right;">
                        <?php echo $fetch_orders['email']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:157px; text-align:start; float:left;"> address :</span>
                     <span style="float:right;">
                        <?php echo $fetch_orders['address']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:146px; text-align:start; float:left;"> total products
                        :</span> <span style="float:right;">
                        <?php echo $fetch_orders['total_products']; ?>
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:135px; text-align:start; float:left;"> total price
                        :</span> <span style="float:right;">$
                        <?php echo $fetch_orders['total_price']; ?>/-
                     </span> </p>
                  <p style="width:100%;"> <span style="margin-right:18px; text-align:start; float:left;"> payment method
                        :</span> <span style="float:right;">
                        <?php echo $fetch_orders['method']; ?>
                     </span> </p>
                  <form action="" method="post">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <select name="update_payment">
                        <option value="" selected disabled>
                           <?php echo $fetch_orders['payment_status']; ?>
                        </option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                     </select>

                     <input type="submit" value="update" name="update_order" class="option-btn">
                     <a href="admin-orders.php?delete=<?php echo $fetch_orders['id']; ?>"
                        onclick="return confirm('delete this order?');" class="delete-btn">delete</a>
                  </form>
               </div>
               <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
      </div>

   </section>










   <!-- custom admin js file link  -->
   <script src="script.js"></script>

</body>

</html>