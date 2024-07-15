<?php
session_start();
$id = $_SESSION['user_id'];

if(isset($_POST['Logout'])){
    $sql = "DELETE * FROM orders WHERE user_id = '$id'";
    echo $sql;
}
session_unset();
session_destroy();
header("Location: index.php");
exit();