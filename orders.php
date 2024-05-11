<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
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
<style>
    /* style.css */

/* Body styles */
body {
   font-family: Arial, sans-serif;
   margin: 0;
   padding: 0;
   background-color: #f9f9f9;
   width: 80%;
   margin: auto;
}

/* Heading styles */
.heading {
    margin-top: 10px;
    border-radius: 10px;
   text-align: center;
   padding: 7px 0;
   background-color: #FFFFFF;
   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
   color: #EB5757;
}

/* Placed orders section styles */
.placed-orders {
    margin-top: 20px;
   padding: 20px;
   background-color: #FFFFFF;
   border-radius: 10px;
   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

/* Title styles */
.title {
   text-align: center;
   margin-bottom: 20px;
   color: #333;
}

/* Box container styles */
.box-container {
   display: grid;
    grid-template-columns: repeat(auto-fill, minmax(535px, 1fr));
   
}

/* Box styles */
.box {
   margin-bottom: 10px;
   background-color: #fff;
   padding: 20px;
   border-radius: 10px;
   box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
   transition: transform 0.3s, box-shadow 0.3s;
   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);

}

.box:hover {
   transform: translateY(-5px);
   box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
}

/* Box content styles */
.box p {
   margin: 5px 0;
}

.box p span {
   font-weight: bold;
}

/* Empty message styles */
.empty {
   text-align: center;
   color: #777;
}

/* Link styles */
a {
   color: #333;
   text-decoration: none;
   transition: color 0.3s;
}

a:hover {
   color: #666;
}
</style>

</head>
<body>
    

<div class="heading">
   <h1>My Orders</h1>
   
</div>

<section class="placed-orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">

      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
      <div class="box">
         <p> Placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
         <p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
         <p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> Payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> Your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> Total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
         </div>
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>

</section>







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>