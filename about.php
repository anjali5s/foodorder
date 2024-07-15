<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aboutpage</title>
  <link rel="stylesheet" href="css/homepage.css" />
</head>

<body>
  <?php include 'components/header.php' ?>
  <div class="box1">
    <div class="content">
      <hr>
      <div class="about">
  
        <h1>About Us</h1>
      </div>
      <div class="paragraph">
        <p>
          Our innovative food ordering system is an online-based system to
          experience the amazing experience from hunger to satisfaction. It
          allows customers to order and pay through a digital menu either in
          the app or website. This adaptable method adapts to changing
          customer needs and makes the restaurant run better overall. It
          creates an efficient dining experience. It records a customer
          database up to date, leading to more accurate orders and
          personalized services. In addition, we are dedicated to improving
          your meal delivery business and ensuring that your clients receive
          as they request.
        </p>
        <p>
          We chose this project since sharing the technology benefits users
          and food service managers. This approach aims to improve
          communication between food consumers and producers, creating an
          optimal and effective system.
        </p>
      </div>
      <hr>
      <div class="mission">
        <h2>Mission</h2>
        <p>
          Future Scope in Online Food Ordering System This project aimed at
          developing an online food ordering system which can be used in small
          places, and medium cities firstly and then on a large scale. It is
          developed to help restaurants to simplify their daily operational
          and managerial task as well as improve the dining experience of
          customers.
        </p>
      </div>
      <div class="status">
        <h1>"Good Food Good Mood"</h1>
        <hr>
      </div>

    </div>

    <div class="imaage">
      <img src="image/meat.jpg" width="450px" height="530px" alt="" />
    </div>
  </div>
  <h2 style="margin:50px 0 0 10%;">Our Specialities:</h2>
  <div class="img_container">
    <img src="image/pizza.jpg" height="230px" alt="img1" title="Pasta" />
    <img src="image/boba.jpg" height="230px" alt="img2" title="Noodles" />
    <img src="image/burger.jpg" height="230px" alt="img3" title="Momo" />
    <img src="image/salad.jpg" height="230px" alt="img4" title="Salad" />
  </div>
  <!-----------------------------------------footer----------------------------- -->
  <?php include 'components/footer.php' ?>
  <!----------------------------------------- endfooter----------------------------- -->
  <p style="text-align: center;">&copy; FoodHub | 2024</p>
</body>
</html>