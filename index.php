<?php
    session_start();
    include 'connection.php';

    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $categories = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row; // Append each row to the $categories array
        }
    }

    $foodsql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
    $result_products = mysqli_query($conn, $foodsql);
    $products = array();

    if (mysqli_num_rows($result_products) > 0) {
        while ($row_products = mysqli_fetch_assoc($result_products)) {
            $products[] = $row_products; // Append each row to the $products array
        }
    }

    function addToCart($productId, $productName, $productPrice, $productImage) {
        // Initialize cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        // Add product to the cart session
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'image' => $productImage,
            'quantity' => 1
        ];
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productPrice = $_POST['product_price'];
        $productImage = $_POST['product_image'];
    
        addToCart($productId, $productName, $productPrice, $productImage);

        if (!isset($_SESSION['added_to_cart'])) {
            $_SESSION['added_to_cart'] = [];
        }
    
        $_SESSION['added_to_cart'][$productId] = true;
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
    <?php include 'components/header.php' ?>
    <!-- Main Section -->
    <section>
        <div class="main">
            <img src="image/smoke.jpg" width="96%" height="400px" alt="image">
            <div class="text-overlay">
                <h3>Good Food Good Mood</h3>
                <h6>can't decide what to eat</h6>
                <div class="show-more"><a href="menu.php">Show More</a></div>
            </div>
        </div>

    </section>
    <section>
        <div class="category">
            <h2>Categories</h2>
            <div class="category-container">

                <?php foreach($categories as $category) { ?>
                    <div class="image1">
                        <a href="menu.php#<?php echo $category['name'] ?>">
                            <img src="uploads/categories/<?php echo $category['image'] ?>" class="image" alt="<?php echo ucwords($category['name']); ?>">
                            <h3><?php echo $category['name'] ?></h3>
                        </a>
                    </div>
                <?php } ?>
            </div>
        
        </div>
    </section>


    <section class="product">
        <h2>Latest Product</h2>
        <div class="product-container">
            <?php 
                foreach ($products as $product) {
                    $product_idd = $product['id'];
            ?>
                <div class="box">
                <figure>
                    <img src="image/<?php echo $product['image']; ?>" alt="<?php echo ucwords($product['name']); ?>" class="image"/>
                    
                    <figcaption>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $product['price']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $product['name']; ?>">
                            <input type="hidden" name="product_image" value="<?php echo $product['image']; ?>">
                        
                            <?php if($user_id) { ?>
                                <button class="product-cart-box" type="submit" name="add_to_cart" <?php echo isset($_SESSION['added_to_cart'][$product_idd]) ? 'disabled' : ''; ?>>
                                    <?php echo isset($_SESSION['added_to_cart'][$product_idd]) ? 'Added to Cart' : 'Add to Cart'; ?>
                                </button>
                            <?php } else { ?>
                                <button class="product-cart-box" >
                                    <a href="login.php" style="color: white;">Add to Cart</a>
                                </button>
                            <?php } ?>
                        </form>
                    </figcaption>
                </figure>
                <h3><?php echo ucwords($product['name']); ?></h3></a>

            
            </div>
            
            <?php    
                }
            ?>
           
        </div>

        <div class="more-btn">
            <a href="menu.php" class="btn">View All</a>
        </div>
    </section>

    <!-- footer -->
    <?php include 'components/footer.php' ?>
    <!-- footer end -->
</body>

</html>