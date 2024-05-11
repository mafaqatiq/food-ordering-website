<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}
;

if (isset($_POST['add_product'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'images/' . $image;


    $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'product name already added';
    } else {
        $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image, category) VALUES('$name', '$price', '$image', '$category')") or die('query failed');


        if ($add_product_query) {
            if ($image_size > 2000000) {
                $message[] = 'image size is too large';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                echo "<script>alert('Product added successfully!');</script>";
            }
        } else {
            $message[] = 'product could not be added!';
        }
        
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('images/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin-products.php');
}

if (isset($_POST['update_product'])) {

    $update_p_id = $_POST['update_p_id'];
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_price = $_POST['update_price'];
    $update_category = mysqli_real_escape_string($conn, $_POST['category']); // Changed from $_POST['update_category']

    mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', category = '$update_category' WHERE id = '$update_p_id'") or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'images/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('images/' . $update_old_image);
        }
    }

    header('location:admin-products.php');

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

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
                    <li class="list border-animation" id="list1"><a href="#" onclick="changeActive('list1')">Home</a>
                    </li>
                    <li class="list border-animation" id="list2"><a class="default-color" href="#"
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

    <!-- product CRUD section starts  -->

    <section class="add-products">

        
        <h1 class="title-shop-products">Shop Products</h1>

        <form action="" method="post" enctype="multipart/form-data">
            <h3>Add product</h3>
            <input type="text" name="name" class="form-box" placeholder="Enter product name" required>
            <input type="number" min="0" name="price" class="form-box" placeholder="Enter product price" required>
            <select name="category" class="form-box" required>
                <option value="">Select category</option>
                <option value="burger">Burger</option>
                <option value="pizza">Pizza</option>
                <option value="icecream">Ice Cream</option>
            </select>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="form-box" required>
            <input type="submit" value="Add product" name="add_product" class="btn">
        </form>

    </section>

    <!-- product CRUD section ends -->

    <!-- show products  -->

    <section class="show-products">

        <div class="box-container">

            <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            if (mysqli_num_rows($select_products) > 0) {
                while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                    ?>
                    <div class="card-1">
                        <img src="images/<?php echo $fetch_products['image']; ?>" alt="">
                        <div class="name">
                            <?php echo $fetch_products['name']; ?>
                        </div>
                        <div class="price">$
                            <?php echo $fetch_products['price']; ?>/-
                        </div>
                        <a href="admin-products.php?update=<?php echo $fetch_products['id']; ?>"
                            class="option-btn fancy-link">Update</a>
                        <a href="admin-products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn fancy-link"
                            onclick="return confirm('Delete this product?');">Delete</a>
                    </div>
                    <?php
                }
            } else {
                echo '<p style="margin:auto;" class="empty">No products are added yet!</p>';
            }
            ?>

        </div>

    </section>

    <section class="edit-product-form" id="edit-form">
        <?php
        if (isset($_GET['update'])) {
            $update_id = $_GET['update'];
            $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
            if (mysqli_num_rows($update_query) > 0) {
                while ($fetch_update = mysqli_fetch_assoc($update_query)) {
                    ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
                        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                        <img style="    height: 119px; width: 129px; display: block;margin: auto;     margin-top:10px; margin-bottom:10px;
    border: none;
    border-radius: 10px;" src="images/<?php echo $fetch_update['image']; ?>" alt="">
                        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="form-box" required
                            placeholder="enter product name">
                        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0"
                            class="from-box" required placeholder="enter product price">

                        <select name="category" class="form-box" required>
                            <option value="">Select category</option>
                            <option value="burger" <?php if ($fetch_update['category'] === 'burger')
                                echo ' selected'; ?>>Burger
                            </option>
                            <option value="pizza" <?php if ($fetch_update['category'] === 'pizza')
                                echo ' selected'; ?>>Pizza</option>
                            <option value="icecream" <?php if ($fetch_update['category'] === 'icecream')
                                echo ' selected'; ?>>Ice
                                Cream</option>
                        </select>

                        <input type="file" class="form-box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                        <input type="submit" value="Update" name="update_product" class="btn">
                        <input type="reset" value="Cancel" id="close-update" onclick="close_edit_form()">

                    </form>
                    <?php
                }
            }
        } else {
            echo '<script>document.getElementById("edit-form").style.display = "none";</script>';
        }
        ?>

    </section>


    <script src="script.js"></script>

</body>

</html>