<?php

include 'connection.php';

session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
};


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search page</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/homepage.css">

</head>

<body>

    <?php include 'components/header.php'; ?>

    <section class="food-search text-center">
        <div class="container">
            <?php

            //Get the Search Keyword
            // $search = $_POST['search'];
            $search = mysqli_real_escape_string($conn, $_POST['search_box']); 

            ?>


            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

            //SQL Query to Get foods based on search keyword
            //$search = burger '; DROP database name;
            // "SELECT * FROM tbl_food WHERE title LIKE '%burger'%' OR description LIKE '%burger%'";
            $sql = "SELECT * FROM products WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Count Rows
            $count = mysqli_num_rows($res);

            //Check whether food available of not
            if ($count > 0) {
                //Food Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get the details
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            // Check whether image name is available or not
                            if ($image_name == "") {
                                //Image not Available
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                //Image Available
                            ?>
                                <img src="<?php ?>images/food/<?php echo $image_name; ?>" alt=" Pizza" class="img-responsive img-curve">
                            <?php

                            }
                            ?>

                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">$<?php echo $price; ?></p>
                            <p class="food-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="#" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>

            <?php
                }
            } else {
                //Food Not Available
                echo "<div class='error'>Food not found.</div>";
            }

            ?>



            <div class="clearfix"></div>



        </div>

    </section>










    <?php include 'components/footer.php'; ?>



</body>

</html>