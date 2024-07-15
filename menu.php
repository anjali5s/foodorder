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

    $foodsql = "SELECT * FROM products";
    $result_products = mysqli_query($conn, $foodsql);
    $products = array();

    if (mysqli_num_rows($result_products) > 0) {
        while ($row_products = mysqli_fetch_assoc($result_products)) {
            $products[] = $row_products; // Append each row to the $categories array
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

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FoodHub Menu</title>

    </head>

    <body>
        <div class="menu">
            <h1>Welcome to FoodHub!</h1>
        

            <?php foreach($categories as $category) { ?>
                <section id="<?php echo $category['name']; ?>">
                    <!-- <div> -->
                        <h4 style="text-align: center;"><?php echo ucwords($category['name']); ?></h4>
                    <!-- </div> -->
                    <div class="section" style="margin-left: 50px;">
                        <?php foreach($products as $product) { ?>
                            <?php if($category['id'] === $product['category_id']) { 
                                $product_idd = $product['id'];    
                            ?>

                                <div class="item">
                                    <figure>
                                        
                                        <img src="uploads/products/<?php echo $product['image']; ?>" alt="Pepproni">
                                        
                                        
                                    </figure>
                                    <h4><?php echo ucwords($product['name']); ?></h4>
                                    <p><?php echo $product['description']; ?></p>
                                    <h4>Rs.<?php echo $product['price']; ?></h4>
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
                                                <a href="login.php">Add to Cart</a>
                                            </button>
                                        <?php } ?>
                                    </form>
                                    </figcaption> 
                                </div>

                            <?php } ?>
                        <?php } ?>
                    </div>
                    

                </section>
            
            <?php } ?>
            <!-- <div class="section">
                <h3>Burger</h3>
                <div class="item">
                    <figure>
                        <a href="category.php?category=pizza">
                            <img src="image/burger.jpg" alt="Pepproni">
                        </a>
                        
                    </figure>
                    <a href="category.php?category=pizza"><h4>Chicken Burger</h4></a>
                    <p> the pepperoni! Slices of pepperoni are scattered generously over the sauced dough.</p>
                    <h4>Rs.900</h4>
                    <figcaption> <button class="product-cart-box"><a href="add_to_cart.php">Add to cart</a></button></figcaption> 
                </div>

                <div class="item">
                    <figure>
                        <a href="category.php?category=pizza">
                            <img src="image/burger2.jpg" alt="Pepproni">
                        </a>
                        
                    </figure>
                    <a href="category.php?category=pizza"><h4>Veg Burger</h4></a>
                    <p> the pepperoni! Slices of pepperoni are scattered generously over the sauced dough.</p>
                    <h4>Rs.900</h4>
                    <figcaption> <button class="product-cart-box"><a href="add_to_cart.php">Add to cart</a></button></figcaption> 
                </div>

                <div class="item">
                    <figure>
                        <a href="category.php?category=pizza">
                            <img src="image/chicken.jpg" alt="Pepproni">
                        </a>
                        
                    </figure>
                    <a href="category.php?category=pizza"><h4> Burger</h4></a>
                    <p> the pepperoni! Slices of pepperoni are scattered generously over the sauced dough.</p>
                    <h4>Rs.900</h4>
                    <figcaption> <button class="product-cart-box"><a href="add_to_cart.php">Add to cart</a></button></figcaption> 
                </div>

            </div>
            <div class="section">
                <h3>breakfast</h3>
                <div class="item">
                    <figure>
                        <a href="category.php?category=pizza">
                            <img src="image/pepperoni.jpg" alt="Pepproni">
                        </a>
                        
                    </figure>
                    <a href="category.php?category=pizza"><h4>Chicken Burger</h4></a>
                    <p> the pepperoni! Slices of pepperoni are scattered generously over the sauced dough.</p>
                    <h4>Rs.900</h4>
                    <figcaption> <button class="product-cart-box"><a href="add_to_cart.php">Add to cart</a></button></figcaption> 
                </div>

                <div class="item">
                    <figure>
                        <a href="category.php?category=pizza">
                            <img src="image/pepperoni.jpg" alt="Pepproni">
                        </a>
                        
                    </figure>
                    <a href="category.php?category=pizza"><h4>Chicken Burger</h4></a>
                    <p> the pepperoni! Slices of pepperoni are scattered generously over the sauced dough.</p>
                    <h4>Rs.900</h4>
                    <figcaption> <button class="product-cart-box"><a href="add_to_cart.php">Add to cart</a></button></figcaption> 
                </div>

                <div class="item">
                    <figure>
                        <a href="category.php?category=pizza">
                            <img src="image/pepperoni.jpg" alt="Pepproni">
                        </a>
                        
                    </figure>
                    <a href="category.php?category=pizza"><h4>Chicken Burger</h4></a>
                    <p> the pepperoni! Slices of pepperoni are scattered generously over the sauced dough.</p>
                    <h4>Rs.900</h4>
                    <figcaption> <button class="product-cart-box"><a href="add_to_cart.php">Add to cart</a></button></figcaption> 
                </div>

            </div> -->
        </div>
    </body>

    </html>







    <!-- footer -->
    <?php include 'components/footer.php' ?>
    <!-- footer end -->
</body>

</html>