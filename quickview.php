<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   

<section class="quick-view">

   <h1 >quick view</h1>

   <form action="" method="post" class="view">
      <input type="hidden" name="pid" value="">
      <input type="hidden" name="name" value="">
      <input type="hidden" name="price" value="">
      <input type="hidden" name="image" value="">
      <img src="image/burger.jpg" alt="">
      <a href="category.php?category=" class="cat"></a>
      <div class="name"></div>
      <div class="flex">
         <div class="price"><span>$</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
      </div>
      <button type="submit" name="add_to_cart" class="cart-btn">
        <a href="add_to_cart.php">add to cart</a>
    </button>
   </form>

   <p class="empty">no products added yet!</p>

</section>

<!-- footer section starts  -->
<!-- footer section ends -->

</body>
</html>