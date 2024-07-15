<?php
  
  include '../connection.php';


  $sql = "SELECT COUNT(id) as user_count FROM users;";
  $sql .= "SELECT COUNT(id) as category_count FROM categories;";
  $sql .= "SELECT COUNT(id) as product_count FROM products;";
  $sql .= "SELECT COUNT(id) as order_count FROM orders;"; // `order` is a reserved keyword, so use backticks around it

  $user_count = $category_count = $product_count = $order_count = 0;

  // Execute multi query
  if ($conn->multi_query($sql)) {
      // Counter for tracking the query result
      $counter = 0;
      do {
          // Store first result set
          if ($result = $conn->store_result()) {
              $row = $result->fetch_row();
              switch ($counter) {
                  case 0:
                      $user_count = $row[0];
                      break;
                  case 1:
                      $category_count = $row[0];
                      break;
                  case 2:
                      $product_count = $row[0];
                      break;
                  case 3:
                      $order_count = $row[0];
                      break;
              }
              $result->free();
          }
          // Move to the next query
          $counter++;
      } while ($conn->more_results() && $conn->next_result());
  }
 

  $conn->close();

?>



<?php
  include 'layouts/header.php'
?>

  <div class="header">
      <div class="header_title">
        <h2> Admin Dashboard</h2>
      </div>

      <div class="user_info"> Hello, Admin
      </div>
    </div>
    <!-- dashboard content-->
    <div style="float: left; width: 180px;
    height: 100px;
    margin: 10px;
    border: solid 3px #751618;
    border-radius:5px">
      Total No. User: <?php echo $user_count; ?>
    </div>

    <div style="float: left; width: 180px;
    height: 100px;
    margin: 10px;
    border: solid 3px #751618;
    border-radius:5px;">
      Total No. Category: <?php echo $category_count; ?>
    </div>

    <div style="float: left; width: 180px;
    height: 100px;
    margin: 10px;
    border: solid 3px #751618;
    border-radius:5px">
      Total No. Products: <?php echo $product_count; ?>
    </div>

    <div style="float: left; width: 180px;
    height: 100px;
    margin:10px;
    border: solid 3px #751618;
    border-radius:5px">
      Total No. Order: <?php echo $order_count; ?>
    </div>

  </div>

<?php include 'layouts/footer.php' ?>