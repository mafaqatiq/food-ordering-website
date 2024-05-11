<?php
include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
   exit; // Exit to prevent further execution
} 
// Function to get product details by name from the products table
function getProductDetails($conn, $productName) {
    $sql = "SELECT name, price, category, image FROM products WHERE name = '$productName'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return false;
    }
}

// Function to insert cart item into the cart table
function insertCartItem($conn, $user_id, $productName, $price, $quantity, $image) {
    $sql = "INSERT INTO cart (user_id, name, price, quantity, image) VALUES ('$user_id', '$productName', '$price', '$quantity', '$image')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Process cart items
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    foreach ($_GET as $key => $value) {
        if (strpos($key, 'name') === 0) {
            $index = substr($key, 4);
            $productName = $_GET['name' . $index];
            $productPrice = intval(preg_replace('/[^0-9]/', '', $_GET['price' . $index]));
            $quantity = intval($_GET['quantity' . $index]);

            // Get product details from the products table
            $productDetails = getProductDetails($conn, $productName);
            if ($productDetails) {
                $name = $productDetails['name'];
                $price = $productDetails['price'];
                $category = $productDetails['category'];
                $image = $productDetails['image'];
                insertCartItem($conn, $user_id, $name, $price, $quantity, $image);

            }
        }
    }
}







if(isset($_POST['order_btn'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = $_POST['number'];
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, ', '. $_POST['street'].', '. $_POST['city'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');
 
    $cart_total = 0;
    $cart_products[] = '';
 
    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
       while($cart_item = mysqli_fetch_assoc($cart_query)){
          $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
          $sub_total = ($cart_item['price'] * $cart_item['quantity']);
          $cart_total += $sub_total;
       }
    }
 
    $total_products = implode(', ',$cart_products);
 
    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
 
    if($cart_total == 0){
       $message[] = 'your cart is empty';
    }else{
       if(mysqli_num_rows($order_query) > 0){
          $message[] = 'order already placed!'; 
       }else{
          mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
          $message[] = 'order placed successfully!';
          mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
          echo '<script>window.location.href = "http://localhost:3000/landing-page.php";</script>';
       }
    }
    
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <style>
    /* Custom styles for the checkout page */

    body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
    width: 80%; /* Decrease width to 80% */
    margin: 0 auto; /* Center the body */
}

/* Rest of your existing styles */

.checkout form {
    padding: 10px;
    margin-top: 5px;
    transition: box-shadow 0.3s; /* Add transition for hover effect */
}
 
.heading {
    margin-top: 10px;
    border-radius: 10px;
   text-align: center;
   padding: 7px 0;
   background-color: #FFFFFF;
   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
   color: #EB5757;
}


section {
    background-color: #fff;
    padding: 20px;
    margin-top: 10px;
    margin-bottom: 10px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
section:hover{
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}
.display-order {
    margin-bottom: 20px;
    
}

.display-order:hover{
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}
.grand-total {
    font-weight: bold;
    text-align: right;
    font-size: 20px;
    margin-top: 10px;
}

.checkout form {
    margin-top: 20px;
}

.inputBox {
    margin-bottom: 15px;
}

.inputBox span {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.inputBox input,
.inputBox select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 3px;
    box-sizing: border-box;
}

.inputBox select {
    background-color: #f9f9f9;
}

.btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 472px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 20px;
    cursor: pointer;
    border-radius: 3px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #45a049;
}

.empty {
    color: #999;
    text-align: center;
}

@media screen and (max-width: 600px) {
    .flex {
        flex-direction: column;
    }

    .inputBox {
        width: 100%;
    }

    .btn {
        width: 100%;
    }
}

   </style>

</head>
<body>
   <div class="heading">
   <h1>Checkout</h1>
       </div>
    

<section class="display-order">
    <h2>Products</h2>

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   <div class="grand-total" style="color:#4CAF50;"> Grand total : <span style="font-size:20px; ">$<?php echo $grand_total; ?>/-</span> </div>

</section>

<section class="checkout">

   <form action="" method="post">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <span>Your name :</span>
            <input type="text" name="name" required placeholder="enter your name">
         </div>
         <div class="inputBox">
            <span>Your number :</span>
            <input type="number" name="number" required placeholder="enter your number">
         </div>
         <div class="inputBox">
            <span>Your email :</span>
            <input type="email" name="email" required placeholder="enter your email">
         </div>
         <div class="inputBox">
            <span>Payment method :</span>
            <select name="method">
               <option value="cash on delivery">cash on delivery</option>
               <option value="credit card">credit card</option>
               <option value="paypal">paypal</option>
               <option value="paytm">paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Address line 01 :</span>
            <input type="text" name="street" required placeholder="e.g. street name">
         </div>
         <div class="inputBox">
            <span>City :</span>
            <input type="text" name="city" required placeholder="e.g. lahore">
         </div>
         <div class="inputBox">
            <span>State :</span>
            <input type="text" name="state" required placeholder="e.g. mansura">
         </div>
         <div class="inputBox">
            <span>Country :</span>
            <input type="text" name="country" required placeholder="e.g. pakistan">
         </div>
         <div class="inputBox">
            <span>Pin code :</span>
            <input type="number" min="0" name="pin_code" required placeholder="e.g. 4366">
         </div>
      </div>
      <input type="submit" value="Order now" class="btn" name="order_btn">
   </form>

</section>






<script>
      // Check if the user navigated back to the checkout page
      window.onload = function() {
         if (window.performance && window.performance.navigation.type === 2) {
            // Update the URL of the checkout page
            window.history.replaceState(null, null, "http://localhost:3000/landing-page.php");
         }
      };
   </script>


</body>
</html>