<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
#contact {
  text-align: center; 
  margin: 50px auto; 
  position: relative; 
}

/* Background image styles */
#contact::after {
  content: ""; /* This pseudo-element creates a background behind the content */
  position: absolute; /* Layer the background behind the content */
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("image/toast.jpg"); 
  background-size: cover; 
  background-repeat: no-repeat;
  filter: blur(5px); 
  z-index: -1; /* Place the background behind the form content */
}


#contact form {
  display: inline-block; 
  padding: 20px; 
  border: 2px solid #ccc; 
  border-radius: 5px; 
}

</style>

<body>
    <?php include 'components/header.php' ?>
    <section id="contact">
        <h1 class="h-secondary center">Contact Us</h1>
        <div id="contactbox">
            <form action="">
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="text" name="name" id="name" placeholder="---name---">
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" placeholder="---email---">
                </div>
                <div class="form-group">
                    <label for="number">Mobile Number: </label>
                    <input type="text" name="number" id="number" placeholder="---contact number---">
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea name="message" id="message" cols="20" rows="3"></textarea>
                </div>
            </form>
        </div>
    </section>
    <!-- footer -->
    <?php include 'components/footer.php' ?>
    <!-- end footer -->
</body>

</html>