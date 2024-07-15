
<?php

    include '../connection.php';

    // DELETE CATEGORY
    if (isset($_POST['delete'])) {
        $category_id = $_POST['category_id'];
        $sql = "DELETE FROM categories WHERE id = $category_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // category deleted successfully
            header("Location: categories.php");
            exit;
        } else {
            echo "Error while deleting category";
        }
    }
?>


<?php include 'layouts/header.php'?>

        <div class="row">
            <div class="col-md-12">
                <h1>Manage Category</h1>
                <button><a href="add-category.php">Add Category</a></button>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- php code -->
                    <?php
                        $sql = "SELECT * FROM categories";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>
                                
                                        <button class='btn btn-primary'><a href='add-category.php?id=" . $row['id'] . "'><i class='far fa-edit' style='font-size:24px'></i></a></button>
                                        <form method='POST'>
                                            <input type='hidden' name='category_id' value='" . $row['id'] . "'>
                                            
                                            <button type='submit' class='btn btn-danger' name='delete'><i class='fas fa-trash-alt' style='font-size:24px'></i></button>
                                        </form>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>No categories found</td></tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
<?php include 'layouts/footer.php' ?>