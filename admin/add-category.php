<?php
    include '../connection.php';

    if(isset($_GET['id']) && $_GET['id'] != null ) {
        $category_id = $_GET['id'];

        if($category_id){
            $sql = "SELECT * FROM categories Where id = $category_id";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $category = $result->fetch_assoc();
            }
        }
    }

    // CREATE CATEGORY
    if (isset($_POST['submit']) && isset($_FILES["image"])) {
        $category_name = $_POST['name'];
        $category_image = $_FILES['image'];

        // Get the extension of the uploaded file
        $image_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Generate a new unique name for the image
        $new_image_name = "categories-".uniqid(). '.' . $image_extension;

        $target_dir = "../uploads/categories/"; // Specify the directory where you want to save the uploaded images
        $target_file = $target_dir . $new_image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Error while adding category Image";    
        }

        $sql = "INSERT INTO categories (name, image) VALUES ('$category_name', '$new_image_name')";
        
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // category added successfully
            header("Location: categories.php");
            exit;
        } else {
            echo "Error while adding category";
        }
    }

    // UPDATE CATEGORY
    if (isset($_POST['update'])) {
        $category_id = $_GET['id'];
        $category_name = $_POST['name'];
        $category_image = $_FILES['image'];

        // Get the extension of the uploaded file
        $image_extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));

        // Generate a new unique name for the image
        $new_image_name = "categories-".uniqid(). '.' . $image_extension;

        $target_dir = "../uploads/categories/"; // Specify the directory where you want to save the uploaded images
        $target_file = $target_dir . $new_image_name;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Error while adding category Image";    
        }

        $sql = "UPDATE categories SET name = '$category_name', image = '$new_image_name' WHERE id = $category_id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // category updated successfully
            header("Location: categories.php");
            exit;
        } else {
            echo "Error while updating category";
        }
    }


?>

<?php include 'layouts/header.php'?>

    <div class="row">
        <div class="col-md-6">
            <h1><?php if(isset($category)) { echo 'Update'; } else { echo 'Add'; } ?> Category</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Category Name" value="<?php if(isset($category)) echo $category['name']; ?>" required>
                </div>

                <div class="form-group">
                    <input type="file" class="form-control" name="image" placeholder="Category Image">
                    <?php if(isset($category)) { ?>
                        <div>
                            <img src="../uploads/categories/<?php if(isset($category)) echo $category['image']; ?>" alt="" style="width: 250px; height: 250px;">
                        </div>
                    <?php } ?>
                </div>
                <button type="submit" class="btn btn-primary" name="<?php if(isset($category)) { echo 'update'; } else { echo 'submit';} ?>"><?php if(isset($category)) { echo 'Update'; } else { echo 'Add'; } ?></button>
            </form>
        </div>
    </div>

<?php include 'layouts/footer.php'?>