<?php

    include '../connection.php';

    // DELETE PRODUCT
    if (isset($_POST['delete'])) {
        $product_id = $_POST['product_id'];
        $sql = "DELETE FROM products WHERE id = $product_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // product deleted successfully
            header("Location: product.php");
            exit;
        } else {
            echo "Error while deleting product";
        }
    }


include 'layouts/header.php';
?>



    <div class="row">
        <div class="col-md-12">
            <h1>Manage Product</h1>
            <a href="add-products.php">Add Products</a>
            <table class="table">
                <thead>
                    <tr>
                        <th> ID</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Product Price</th>
                        <th>Product Image</th>
                        <th>Product Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                        $sql = "SELECT products.*, categories.name as category_name FROM products LEFT JOIN categories ON categories.id = products.category_id";
                        $results = mysqli_query($conn, $sql);
                        // print_r($results);
                        // foreach ($results as $result) {
                            //     print_r($result);   
                            // }
                            // die;
                            if (mysqli_num_rows($results) > 0) {
                                while ($row = mysqli_fetch_assoc($results)) {#
                                //     echo "<pre>";
                                // print_r($row);
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . ucwords($row['name']) . "</td>";
                                echo "<td>" . ucwords($row['category_name']) . "</td>";
                                echo "<td>" . $row['description'] . "</td>";
                                echo "<td>" . $row['price'] . "</td>";
                                echo "<td><img src=\"../uploads/products/" . $row['image'] . "\" width=\"100px\" ></td>";
                                echo "<td>
                                
                                        <button class='btn btn-primary'><a href='add-products.php?id=" . $row['id'] . "'><i class='far fa-edit' style='font-size:24px'></i></a></button>
                                        <form method='POST'>
                                            <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                                            
                                            <button type='submit' class='btn btn-danger' name='delete'><i class='fas fa-trash-alt' style='font-size:24px'></i></button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No product found</td></tr>";
                        }
                        ?>


                </tbody>
            </table>
        </div>
    </div>
