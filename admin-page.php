<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin panel</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

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
                    <li class="list border-animation" id="list1"><a class="default-color" href="#"
                            onclick="changeActive('list1')">Home</a></li>
                    <li class="list border-animation" id="list2"><a href="#"
                            onclick="changeActive('list2')">Products</a></li>
                    <li class="list border-animation" id="list3"><a href="#" onclick="changeActive('list3')">Orders</a>
                    </li>
                    <li class="list border-animation" id="list4"><a href="#" onclick="changeActive('list4')">Users</a>
                    </li>
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

    <!-- admin dashboard section starts  -->

    <section class="dashboard">

        <h1 class="title">DASHBOARD</h1>

        <div class="box-container">

            <div class="box">
                <?php
                $total_pendings = 0;
                $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');
                if (mysqli_num_rows($select_pending) > 0) {
                    while ($fetch_pendings = mysqli_fetch_assoc($select_pending)) {
                        $total_price = $fetch_pendings['total_price'];
                        $total_pendings += $total_price;
                    }
                    ;
                }
                ;
                ?>
                <div class="h3">$
                    <?php echo $total_pendings; ?>/-
                </div>
                <div class="p">Total Pendings</div>
            </div>

            <div class="box">
                <?php
                $total_completed = 0;
                $select_completed = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');
                if (mysqli_num_rows($select_completed) > 0) {
                    while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
                        $total_price = $fetch_completed['total_price'];
                        $total_completed += $total_price;
                    }
                    ;
                }
                ;
                ?>
                <div class="h3">$
                    <?php echo $total_completed; ?>/-
                </div>
                <div class="p">Completed Paymemts</div>
            </div>

            <div class="box">
                <?php
                $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
                $number_of_orders = mysqli_num_rows($select_orders);
                ?>
                <div class="h3">
                    <?php echo $number_of_orders; ?>
                </div>
                <div class="p">Order Placed</div>
            </div>

            <div class="box">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                $number_of_products = mysqli_num_rows($select_products);
                ?>
                <div class="h3">
                    <?php echo $number_of_products; ?>
                </div>
                <div class="p">Products Added</div>
            </div>

            <div class="box">
                <?php
                $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
                $number_of_users = mysqli_num_rows($select_users);
                ?>
                <div class="h3">
                    <?php echo $number_of_users; ?>
                </div>
                <div class="p">Normal Users</div>
            </div>

            <div class="box">
                <?php
                $select_admins = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'admin'") or die('query failed');
                $number_of_admins = mysqli_num_rows($select_admins);
                ?>
                <div class="h3">
                    <?php echo $number_of_admins; ?>
                </div>
                <div class="p">Admin Users</div>
            </div>

            <div class="box">
                <?php
                $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
                $number_of_account = mysqli_num_rows($select_account);
                ?>
                <div class="h3">
                    <?php echo $number_of_account; ?>
                </div>
                <div class="p">Total Accounts</div>
            </div>

            <div class="box">
                <?php
                $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
                $number_of_messages = mysqli_num_rows($select_messages);
                ?>
                <div class="h3">
                    <?php echo $number_of_messages; ?>
                </div>
                <div class="p">New Messages</div>
            </div>

        </div>

    </section>

    <!-- admin dashboard section ends -->

    <!-- custom admin js file link  -->
    <script src="script.js"></script>

</body>

</html>