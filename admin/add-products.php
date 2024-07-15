<?php
    include '../connection.php';

    if (!empty($_POST)) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        // print_r($_POST);
        if (isset($_FILES['image'])) {
            if (isset($_FILES['image'])) {
                $image = $_FILES['image'];
                $imgName = $image['name'];
                $tmp = $_FILES['image']['tmp_name'];
                $path = '../uploads/products/';
                $destination = $path . $image['name']; // Concatenate $path and $image['name'] to form the destination path
                move_uploaded_file($tmp, $destination); // Move uploaded file to destination path
            }
        }
        $sql = "INSERT INTO products(name,description,price,category_id,image) VALUES('$name','$description',$price,$category,'$imgName')";
        $result = mysqli_query($conn,$sql);
        if($result){
            header('location: product.php');
        }
    }

    $sql = "SELECT * FROM categories";
    $result = mysqli_query($conn, $sql);
    $categories = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row;
        }
        // print_r($categories); // Append each row to the $categories array
        // die;
    }
?>


<?php
include 'layouts/header.php';

?>

    <div class="row">
        <div class="col-md-6">
            <h1>Add Product</h1>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">Product Name:
                    <input type="text" class="form-control" name="name" placeholder="Product Name" required>
                </div>
                <div class="form-group">Product Description
                    <textarea class="form-control" name="description" placeholder="Product Description"></textarea>
                </div>
                <div class="form-group">Product Price
                    <input type="number" class="form-control" name="price" placeholder="Product Price" required>
                </div>
                <div class="form-group">
                    <label for="category">Select Category:</label>
                    <select class="form-control" name="category" required>                        
                        <option value>Select a category</option>
                        <?php foreach($categories as $category) { ?>
                            
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                

                <div class="form-group">Image
                    <input type="file" name="image" required >
                </div>
                <button type="submit" class=" btn btn-primary" value="Add Product">Add Product</button>
            </form>
        </div>

    </div>