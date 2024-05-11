<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `users` WHERE id = '$delete_id'") or die('query failed');
    header('location:landing-page.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">


    <title>Fudo</title>

</head>

<body>
    <header>
        <nav>
            <div id="nav-inner1">
                <div id="nav-inner-inner1">
                    <img id="logo" src="images/logo.png" alt="">
                    <span id="logo-text">Fudo</span>
                </div>
            </div>
            <div id="nav-inner2">
                <ol>
                    <li class="list border-animation" id="list1"><a class="default-color" href="#why-fudo"
                            onclick="changeActive(event, 'list1')">Why Fudo?</a></li>

                    <li class="list border-animation" id="list2"><a href="#services-container"
                            onclick="changeActive(event, 'list2')">Services</a></li>

                    <li class="list border-animation" id="list3"><a href="#menu-containerr"
                            onclick="changeActive(event, 'list3')">Menu</a></li>

                    <li class="list border-animation" id="list4"><a href="#contact-container"
                            onclick="changeActive(event, 'list4')">Contact</a></li>
                </ol>
            </div>

            <div id="nav-inner3">
                <div id="nav-inner-inner3">

                    <!-- place orders by customer -->
                    <a href="orders.php" class="tooltip">
                        <img class="placed-order-img" src="images/order.png" alt="">
                        <span class="tooltiptext">Orders</span>
                    </a>


                    <div class="tooltip">
    <img id="cart-openModalBtn" src="images/cart.png" alt="">
    <span class="tooltiptext">Cart</span>
</div>


                    <div class="cart-modal" id="cart-modal" style="display:none; overflow:auto;">
                        <div class="cart-modal-content">
                            <span class="cart-close" id="cart-closeModalBtn">&times;</span>
                            <h2>Cart</h2>
                            <p id="empty-cart" style="margin-left: 79px; color:red; position: relative; top: 184px;">
                                Cart is Empty!</p>

                            <button id="cart-check">Checkout -> </button>
                        </div>
                    </div>

                    <div id="cart-overlay"></div>



                    <input class="get-started-btn get-start" onclick="window.location.href='logout.php'" type="button"
                        value="Logout">
                </div>
            </div>

        </nav>
    </header>


    <div class="fudo-container" id="why-fudo">
        <div class="left-container">
            <div class="more-than-faster"
                style="background-color: #FEE9DE; width: 204px; height: 52px; border-radius: 27px;">
                <span style="font-size: 15px; margin-right: 10px; margin-left: 26px; color: #EB5757;">More Than
                    Faster</span>
                <img style="width: 20px; height: 18px;" src="images/image 1.png" alt="">
            </div>
            <div class="be-the-fastest">
                <p style="font-size: 72px; margin-top: 40px; font-weight: bolder; line-height: 90px; color: #333333;">Be
                    The Fastest <br>In Delivering <br>Your <span id="food-text">Food</span></p><br>
                <p style=" font-size: 18; margin-top: 12px;">Our job is to filling your tummy with delicious food <br>
                    and with fast and free delivery</p>
            </div>
            <div class="buttons" style="margin-top: 12px; display: flex; align-items: center ; flex-wrap: wrap;">
                <input class="get-started-btnn get-start" onclick="scrollToMenu()" type="button" value="Get Started">

                <img class="play-video-btn" style="margin-top: 5px; cursor: pointer;" src="images/play.png" alt="">

                <span class="play-video-btn">Watch Video</span>
                <div style="display: none;" class="videoPopup" id="videoPopup">
                    <video id="videoPlayer" controls>
                        <source src="images/video.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <button id="closeButton">Close</button>
                </div>
            </div>
        </div>

        <div class="right-container" style="margin-top: 100px; display: flex; flex-wrap: wrap;  position: relative; ">
            <img style="height: 552px; width: 552px;" src="images/Ellipse 3.png" alt="">
            <img id="girl-img" src="images/girlui.png" alt="">
            <img id="clock" src="images/clock.png" alt="">
            <img id="noto" src="images/noto_fire.png" alt="">
            <img id="group" src="images/Group 53.png" alt="">
            <img src="images/Rectangle 7.png" alt="" id="big-square">
            <img src="images/Rectangle 8.png" alt="" class="small-square">
            <img src="images/Ellipse 16.png" alt="" class="small-circle">
            <div class="call-watson">
                <div class="left-call">
                    <div class="img-bg" style="display: flex; justify-content: center; align-items: center; ">
                        <img style="width: 47px; height: 47px;" src="images/men.png" alt="">
                    </div>
                    <div class="watson-name" style="margin-right: 35px;display: flex;
                        flex-direction: column;">

                        <p style="font-size: 15px; font-weight: bold; color: black;">Richard Watson</p>
                        <span style="font-size: 12px; margin-top: 5px; color: #828282;">Food Courier</span>
                    </div>
                    <div class="call-bg" style="align-items: center; justify-content: center; display: flex; ">
                        <img src="images/callll.png" alt="">

                    </div>
                </div>


            </div>
            <div class="pizza">
                <div class="pizza-img"
                    style="display: flex; justify-content: center; align-items: center; margin-left: 10px;">
                    <img style="margin-left: 7px;" src="images/pizza.png" alt="">
                </div>
                <div class="pizza-txt">
                    <span style="font: 15px; font-weight: bold;">Italian Pizza</span>
                    <div class="stars" data-rating="5"></div>
                    <p style="margin-top: 15px;"><span class="dollar">$</span> <span class="dollar-price">7.49</span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div id="services-container">
        <div class="what-we-serve-container">
            <p id="what-we-serve">WHAT WE SERVE</p>
            <p class="your-favourite-food">Your Favorite Food</p>
            <P class="your-favourite-food">Delivery Partner</P>
        </div>

        <div class="services-boxes" style="margin-top: 20px;">
            <div class="services-box services-box-1" style=" text-align: center;">
                <img style="height: 143px; width: 170px;" src="images/newgrl.png" alt="">
                <span class="service-box-span-1">Easy To Order</span>
                <span class="service-box-span-2">You only need a few steps in <br> ordering food</span>
            </div>
            <div class="services-box services-box-2" style=" text-align: center;">
                <img style="height: 143px; width: 121px;" src="images/delivery-boy.png" alt="">
                <span class="service-box-span-1">Fastest Delivery</span>
                <span class="service-box-span-2">Delivery that is always ontime <br> even faster</span>
            </div>
            <div class="services-box services-box-3" style="text-align: center;">
                <img style="height: 147px; width: 141px;" src="images/quality.png" alt="">
                <span class="service-box-span-1">Best Quality</span>
                <span class="service-box-span-2">Not only fast for us quality is also <br> number one</span>
            </div>
        </div>

        <div class="menu-container" id="menu-containerr">
            <div class="menu-txt-container">
                <span>OUR MENU</span>
                <p class="p1">Menu That Always</p>
                <p class="p2">Makes You Fall In Love</p>
            </div>
            <div class="actual-menu">
                <div class="left-actual-menu">
                    <div class="burger-1 menu-btn" id="burger-btn" onclick="displayBurgerItems()">
                        <img src="images/burger_icon.png" alt="" class="icons">
                        <span id="burger-btn-txt">Burger</span>
                    </div>
                    <div class="burger-2 menu-btn" id="pizza-btn" onclick="displayPizzaItems()">
                        <img src="images/pizza-icon.png" alt="" class="icons">
                        <span id="pizza-btn-txt">Pizza</span>
                    </div>
                    <div class="burger-3 menu-btn" id="icecream-btn" onclick="displayIceCreamItems()">
                        <img src="images/icecream-icon.png" alt="" class="icons">
                        <span class="icecream-btn-txt">Ice Cream</span>
                    </div>

                    <div class="line"></div>

                </div>

                <div class="right-actual-menu">
                    <div id="burger-items" class="fast-food-items">
                        <?php
                        include 'config.php';

                        $sql = "SELECT * FROM products WHERE category='Burger'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Display burger items
                                echo "<div class='card'>";
                                echo "<img src='images/{$row['image']}' alt='{$row['name']}' style='width:100%'>";
                                echo "<h2 style='margin-bottom: 5px;'>{$row['name']}</h2>";
                                echo "<p class='price'>$ {$row['price']}</p>";
                                echo "<input class='counter' type='number' name='' id='' placeholder='Quantity' min='0'>";
                                echo "<p><button>Add to Cart</button></p>";
                                echo "</div>";
                            }
                        } else {
                            echo "No burger items found";
                        }

                        mysqli_close($conn);
                        ?>
                    </div>

                    <div id="pizza-items" class="fast-food-items">
                        <?php
                        include 'config.php';

                        $sql = "SELECT * FROM products WHERE category='Pizza'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Display pizza items
                                echo "<div class='card'>";
                                echo "<img src='images/{$row['image']}' alt='{$row['name']}' style='width:100%'>";
                                echo "<h2 style='margin-bottom: 5px;'>{$row['name']}</h2>";
                                echo "<p class='price'>$ {$row['price']}</p>";
                                echo "<input class='counter' type='number' name='' id='' placeholder='Quantity' min='0'>";
                                echo "<p><button>Add to Cart</button></p>";
                                echo "</div>";
                            }
                        } else {
                            echo "No pizza items found";
                        }

                        mysqli_close($conn);
                        ?>
                    </div>

                    <div id="icecream-items" class="fast-food-items">
                        <?php
                        include 'config.php';

                        $sql = "SELECT * FROM products WHERE category='IceCream'";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Display ice cream items
                                echo "<div class='card'>";
                                echo "<img src='images/{$row['image']}' alt='{$row['name']}' style='width:100%'>";
                                echo "<h2 style='margin-bottom: 5px;'>{$row['name']}</h2>";
                                echo "<p class='price'>$ {$row['price']}</p>";
                                echo "<input class='counter' type='number' name='' id='' placeholder='Quantity' min='0'>";
                                echo "<p><button>Add to Cart</button></p>";
                                echo "</div>";
                            }
                        } else {
                            echo "No ice cream items found";
                        }

                        mysqli_close($conn);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>





















    <div class="chef-container">
        <div class="left-chef-container"
            style="margin-top: 100px; display: flex; flex-wrap: wrap;  position: relative; ">
            <img style="margin-left: 22px;" src="images/what-they-say-bg.png" alt="">
            <img src="images/chef.png" alt="" class="chef-img">
            <img src="images/vertical-onion.png" alt="" class="vertical-onion">
            <img src="images/tilt-onion.png" alt="" class="tilt-onion">
            <img src="images/vertical-leaf.png" alt="" class="vertical-leaf">
            <img src="images/titlt-leaf.png" alt="" class="tilt-leaf">
            <img src="images/ginger.png" alt="" class="ginger">
            <img src="images/mirch.png" alt="" class="mirch">

            <div class="total-reviews"
                style="    top: 389px;
                right: -9px; height: 130px; width: 250px;  text-align: center; position: absolute; display: flex; flex-direction: column; justify-content: center;">
                <span style="font-size: 20px;">Our Reviewers</span>
                <div class="img-review"
                    style="display: flex; align-items: center; justify-content: center; margin-top: 10px;">
                    <img style="height: 64px; width: 64px;" src="images/customer.png" alt="">
                    <div class="review-counts"
                        style=" display: flex; justify-content: center; align-items: center; margin-left: 40px; color: white;">
                        12k+</div>
                </div>
            </div>





        </div>

        <div class="right-chef-container">
            <div class="customer-saying-container">
                <span class="what-they-say-txt" style="margin-bottom: 15px;">WHAT THEY SAY</span>
                <span class="customer-say-txt" style="margin-bottom: 25px;">What Our Customers Say About Us</span>
                <p class="review">“Fudo is the best. Besides the many and delicious meals, the service is also very
                    good, especially in the very fast delivey. I highly recommend Fudo to <br> you”.</p>

                <div class="customer" style="display: flex;">
                    <div class="customer-img" style="display: flex; align-items: center;">
                        <img style="height: 64px; width: 64px;" src="images/customer.png" alt="">
                    </div>
                    <div class=" customer-data"
                        style="margin-left: 10px; display: flex; flex-direction: column; flex-wrap: wrap;  justify-content: center;">

                        <span style="margin-bottom: 6px; font-size: 20px ; font-weight: bold;">Theresa Jordan</span>
                        <span class="food-enth">Food Enthusiast</span>

                    </div>

                </div>
                <div class="rating" style="display: flex; align-items: center; margin-top: 10px;">

                    <div class="starss" data-rating="5"></div>
                    <span style="margin-top: 6px; font-size: 15px;">4.8</span>
                </div>

            </div>
        </div>
    </div>

    <footer style="display: flex; flex-direction: row; margin-top: 250px; flex-wrap: wrap;" id="contact-container">
        <div class="left-most-footer right-left">
            <div id="nav-inner-inner1">
                <img id="logo" src="images/logo.png" alt="">
                <span id="logo-text" style="color: black;">Fudo</span>
            </div>
            <p class="our-job-txt" style="margin-top: 30px; line-height: 30px;">
                Our job is to filling your tummy with delicious food and with fast and free delivery.</p>
            <div class="social-media-img"
                style="display: flex; flex-direction: row; margin-top: 30px; margin-left: 15px;">
                <img class="icons" style="margin-right: 25px;" src="images/bx_bxl-instagram-alt.png" alt="">
                <img class="icons" style="margin-right: 25px;" src="images/bx_bxl-facebook.png" alt="">
                <img class="icons" src="images/akar-icons_twitter-fill.png" alt="">

            </div>
        </div>
        <div class="footer-container">
            <div class="footer-column">
                <div class="about-div">
                    <span class="footer-heading">About</span>
                    <a class="footer-link" href="/about-us">About Us</a>
                    <a class="footer-link" href="/about-us">Features</a>
                    <a class="footer-link" href="/about-us">News</a>
                    <a class="footer-link" href="/about-us">Menu</a>
                </div>
            </div>
            <div class="footer-column">
                <div class="company-div">
                    <span class="footer-heading">Company</span>
                    <a class="footer-link" href="/company">Why Fudo?</a>
                    <a class="footer-link" href="/company">Accessibility</a>
                    <a class="footer-link" href="/company">FAQ</a>
                    <a class="footer-link" href="/company">Blog</a>
                </div>
            </div>
            <div class="footer-column">
                <div class="support-div">
                    <span class="footer-heading">Support</span>
                    <a class="footer-link" href="/support">Account</a>
                    <a class="footer-link" href="/support">Support</a>
                    <a class="footer-link" href="/support">Feedback</a>
                    <a class="footer-link" href="/support">Contact Us</a>
                </div>
            </div>
        </div>

        <div class="right-most-footer right-left">
            <div class="company-footer" style="margin-top: 11px; display: flex; flex-direction: column;">

                <span style="font-size: 20px;
                font-weight: bold;">Company</span>
                <span class="company-span">Questions or Feedback?</span>
                <span class="company-span">We’d love to hear from you</span>
            </div>
            <div class="email-address-container">
                <input style="outline: none; font-size: 16px;border: none;width: 121px;" type="email" name="email"
                    id="email" placeholder="Email Address">
                <img src="images/carbon_send.png" alt="">
            </div>

        </div>

        </div>
    </footer>

    <script src="script.js"></script>

</body>

</html>