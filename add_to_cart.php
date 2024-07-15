<?php
session_start();
include 'connection.php';





?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/homepage.css">

</head>

<body>

   <!-- header section starts  -->
   <?php
   include 'components/header.php'
   ?>
   <!-- header section ends -->

   <!-- shopping cart section starts  -->

   <!-- <section class="products"> -->

   <h1>CART</h1>

<table class="order_table" style="width:100%"> 
            <thead>
               <tr>
                  <th>Image</th>
                  <th>Food Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total Price</th>
               </tr>
            </thead>
            <tbody>
            <?php if (isset($_SESSION['cart'])) {
   $total_price = 0;
   foreach ($_SESSION['cart'] as $key => $cart) { ?>
            <tr>
                  <th><img src="uploads/products/<?php echo $cart['image']; ?>" alt="<?php echo $cart['name']; ?>" style="width:100px;height:100px"></th>
                  <th><?php echo ucwords($cart['name']); ?></th>
                  <th>Rs. <span class="product-price"><?php echo $cart['price']; ?></span></th>
                  <th> <input type="number" min="1" value="1" class="quantity" data-price="<?php echo $cart['price']; ?>" oninput="updateTotalPrice()"></th>
                  <?php $total_price += $cart['price'];?>
                  <th>NPR <span id="total-price"><?php echo $total_price; ?></span></th>
               </tr>

               <?php
            }
         } else {
            echo '<p class="empty">no orders placed yet!</p>';
         }
         ?>
            </tbody>
         </table>





   <div class="cart-total">
   <p>Total Price: Rs. <span id="total-price"><?php echo $total_price; ?></span></p>
      <a href="checkout.php" style="background-color:green; color:white;">Proceed to checkout</a>

   </div>

   <div class="more-btn">
      <form action="" method="post">
         <a href="add_to_cart.php?delete_all" class="delete-btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
      </form>
      <a href="menu.php" class="btn" style="background-color:green; color:white;">continue shopping</a>
   </div>

   </section>



   <!-- shopping cart section ends -->

   <!-- footer section starts  -->
   <?php
   include 'components/footer.php'
   ?>
   <!-- footer section ends -->


   <script>
function updateTotalPrice() {
   let totalPrice = 0;
   const quantities = document.querySelectorAll('.quantity');
   
   quantities.forEach(quantity => {
      const price = quantity.getAttribute('data-price');
      const quantityValue = quantity.value;
      totalPrice += price * quantityValue;
   });

   document.getElementById('total-price').innerText = totalPrice;
}
</script>


</body>

</html>