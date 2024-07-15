<?php
session_start();
include 'connection.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' and password ='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['islogin'] = true;
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id']; //session is temporary data storage on server

        if($user['role_id'] == 1) {
            $_SESSION['is_admin'] = true;
            header("Location: admin/dashboard.php");
        } else {
            $_SESSION['is_admin'] = false;
            header("Location: index.php");
        }
        exit;
    } else {
        $error = "Invalid email or password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
<div class="log-in">
    <div class="image-container">
        <img src="image/login.jpg" alt="Background Image">
        <div class="overlay">
            <div class="centered-box">
                <div class="box">
                    <h2>Login</h2>
                    <?php if (isset($error)) { ?>
                        <p style="color: red;"><?php echo $error; unset($error); ?></p>
                    <?php } ?>
                    <form action="login.php" method="post">
                        <div class="form-box">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" >
                        </div>
                        <div class="form-box">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" >
                        </div>
                        <div class="forgot-password"><a href="#">Forgot Password?</a></div>
                        <button type="submit" name="login" class="login-button">Login</button>
                    </form>
                    <div class="register-link">
                        Don't have an account?
                        <a href="register.php" id="register-link">Register</a>
                    </div>
                    <a href="index.php" style="color: white;">Home</a>
                </div>
            </div>
            
        </div>
    </div>
</div>
    
</body>

</html>