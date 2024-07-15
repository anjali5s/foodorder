<?php
session_start();
include 'connection.php';
$user_id = null;
$orders = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

// Prepare the SQL statement with a join between orders and users tables
$select_orders = $conn->prepare("
    SELECT orders.*, users.name AS user_name, users.email AS user_email, products.image, products.name AS product_name
    FROM orders
    JOIN products ON orders.product_id = products.id
    JOIN users ON orders.user_id = users.id
    WHERE orders.user_id = ?
");
$select_orders->bind_param("i", $user_id);

// Execute the statement and handle potential errors
if ($select_orders->execute()) {
    // Get the result set
    $result = $select_orders->get_result();

    // Fetch and process the orders
    while ($fetch_orders = $result->fetch_assoc()) {
        $orders[] = $fetch_orders;
    }
} else {
    echo "Error executing query: " . $select_orders->error;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="css/homepage.css">
</head>
<body>

    <!-- Header section starts -->
    <?php include 'components/header.php'; ?>
    <!-- Header section ends -->

    <section class="orders">
        <h1 class="heading">Placed Orders</h1>

        <div class="box-container">
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
                <?php
                if (count($orders) > 0) {
                    foreach ($orders as $order) {
                ?>
                    <tr>
                        <td><img src="image/<?= htmlspecialchars($order['image']) ?>" alt="" style="width:100px;height:100px"></td>
                        <td><?= htmlspecialchars($order['product_name']); ?></td>
                        <td><?= htmlspecialchars($order['price']); ?></td>
                        <td><?= htmlspecialchars($order['quantity']); ?></td>
                        <td>NPR <?= htmlspecialchars($order['total_price']); ?></td>
                    </tr>
                <?php
                    }
                } else {
                    echo '<tr><td colspan="5" class="empty">No orders placed yet!</td></tr>';
                }
                ?>
                </tbody>
            </table>
        </div>
    </section>

    <!-- Footer section starts -->
    <?php include 'components/footer.php'; ?>
    <!-- Footer section ends -->

</body>
</html>
