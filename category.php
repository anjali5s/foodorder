<?php

include 'connection.php';

// session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/homepage.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<div class="image1">

<figure>
    <a href="category.php?category=pizza">
        <img src="image/burger.jpg" alt="my img" class="image"/>
    </a>
    <figcaption><button class="product-cart-box">Add to cart</button></figcaption>
</figure>
<a href="menu.php#pizza"><h3>Chicken Burger</h3></a>

</div>
<div class="image1">
<figure>
    <a href="category.php?category=burger">
        <img src="image/burger.jpg" alt="my img" class="image"/>
    </a>
    <figcaption><button class="product-cart-box">Add to cart</button></figcaption>
</figure>
<a href="menu.php#burger"><h3>Burger</h3></a>
</div>
<div class="image1">
<figure>
    <a href="category.php?category=pizza">
        <img src="image/burger.jpg" alt="my img" class="image"/>
    </a>
    <figcaption> <!--<button class="product-cart-box">t</button>--><a href="components/add_to_cart.php">Add to cart</a></figcaption> 
</figure>
<a href="category.php?category=pizza"><h3>Chicken Burger</h3></a>
</div>

<?php include 'components/footer.php'; ?>

</body>
</html>