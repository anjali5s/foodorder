<?php
session_start();
include 'connection.php';


if (isset($_POST['submit'])) {
   $user_id = null;
   if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
   }
   if (isset($_SESSION['cart'])) {
      foreach ($_SESSION['cart'] as $key => $cart) {
         // Prepare the SQL statement
         $sql = "INSERT INTO orders (user_id, price, product_id, quantity, total_price) VALUES (?, ?, ?, ?, ?)";

         // Prepare the statement
         $stmt = mysqli_prepare($conn, $sql);

         // Bind the variables to the prepared statement as parameters
         mysqli_stmt_bind_param($stmt, "idiii", $user_id, $cart['price'], $cart['id'], $cart['quantity'], $total_price);

         // Calculate the total price
         $total_price = $cart['price'] * $cart['quantity'];

         // Execute the statement
         mysqli_stmt_execute($stmt);

         // Close the statement
         mysqli_stmt_close($stmt);
      }
   }

   header("Location: order.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
       <!-- Bootstrap CSS v5.2.1 -->
       <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.1/css/bootstrap.min.css">
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.2.1/js/bootstrap.bundle.min.js"></script>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/homepage.css">

</head>

<body>

   <!-- header section starts  -->
   <?php
   include 'components/header.php'
   ?>
   <!-- header section ends -->



   <section class="checkout">

      <form action="" method="post">

         <div class="user-info">
            <h3>Your Information</h3>
            <table>
               <tr>
                  <td><label for="name">Name:</label></td>
                  <td><input type="text" id="name" name="name" required></td>
               </tr>
               <tr>
                  <td><label for="number">Phone Number:</label></td>
                  <td><input type="text" id="number" name="number" required></td>
               </tr>
               <tr>
                  <td><label for="email">Email:</label></td>
                  <td><input type="email" id="email" name="email" required></td>
               </tr>
               <tr>
                  <td><label for="portal">Payment Method</label></td>
                  <td>
                  <select id="portal" name="portal" required>
                     <option value="">Select a payment method</option>
                     <option value="credit_card">Esewa</option>>
                  </select>
               </td>
               </tr>
               <tr>
                  <td><label for="address">Address:</label></td>
                  <td><textarea id="address" name="address" required></textarea>

                  </td>
               </tr>
            </table>

            <!-- <input type="submit" value="Place Order" class="btn" style="width:100%;" name="submit"> -->
            <button type="submit" name="submit" class="btn" id="payment-button">Place Order</button>
            
         </div>

      </form>

   </section>
   
    <!-- Place this where you need payment button -->
    <!-- Paste this code anywhere in you body tag -->
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                "EBANKING",
                "MOBILE_BANKING",
                "CONNECT_IPS",
                "SCT",
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script>
    <!-- Paste this code anywhere in you body tag -->


   <!-- footer section starts  -->
   <?php
   include 'components/footer.php'
   ?>
   <!-- footer section ends -->

</body>

</html>