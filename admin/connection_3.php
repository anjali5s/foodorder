<?php
$conn = mysqli_connect("localhost", "root", "", "onlinefoodorder");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}