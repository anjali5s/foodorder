<?php
include 'connection.php';
// session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // $sql = "SELECT * FROM user_tbl WHERE id='$user_id'";
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {

    // }

    $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
} else {
    $user_id = null;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodHub</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <!--  Header -->
    <header>

        <div class="logo">
            <h2><a href="index.php" style="color: white;">Food Hub</a></h2>
        </div>

        <ul>
            <!-- <li><a href="searchbar.php"><i class="fas fa-search"></i></a></li> -->
            <!-- <li><a href="index.php">Home</a></li> -->
            <li><a href="menu.php">Menu</a></li>
            <li><a href="order.php">Order</a></li>
            <li><a href="About.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
            ?>
                <form action="" method="post">
                    <li><a href="logout.php" name="Logout" onclick="return confirm('Are you sure you want to Logout?')">Log out</a></li>
                </form>

            <?php
            } else {
            ?>
                <li><a href="login.php">Log in</a></li>
            <?php
            }
            ?>

            <!-- <li><a href="add_to_cart.php"><i class="fas fa-shopping-cart"></i></a></li> -->
            <?php
            if (isset($_SESSION['user_id'])) {
            ?>
                <li class="wrapper"><a href="add_to_cart.php"><i class="fas fa-shopping-cart"></i><span><?php echo $cart_count; ?></span></a></li>
            <?php } ?>
        </ul>


    </header>
    <!-- header end -->