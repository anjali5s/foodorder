<?php
session_start();
// Include your database connection file or configuration
include 'connection.php';

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $password = md5($_POST['password']);

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = '$email'";
    $check_email_result = mysqli_query($conn, $check_email_query);
    if (mysqli_num_rows($check_email_result) > 0) {
        $_SESSION['error'] = "Employee with this email already exists";
        header("Location: register.php");
        exit();
    }

    // Insert employee data into the database
    $insert = "INSERT INTO users (name, email, address, phone, password) 
    VALUES ('$name', '$email', '$address', '$phone', '$password')";
    $result = mysqli_query($conn, $insert);
    if ($result) {
        $_SESSION['success'] = " Registered successfully";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to register ";
        header("Location: register.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
    <div class="register">
        <div class="reg-image">
            <img src="image/login.jpg" alt="Background Image">
            <div class="image-overlay">
                <div class="register-box">
                    <div class="reg-box">
                        <h2>Register your Account</h2>
                        <?php if (isset($_SESSION['error'])) { ?>
                            <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
                        <?php } ?>
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" id="address" name="address" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone No.:</label>
                                <input type="tel" id="phone" name="phone" pattern="[0-9]{10}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                            <button type="submit" name="submit">Register</button>
                        </form>
                        <div class="bottom-link">
                            Already have an account? <a href="login.php">Login</a>
                        </div>
                        <a href="index.php" style="color: white;">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>