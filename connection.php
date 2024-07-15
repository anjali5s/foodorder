<?php
$host="localhost";
$user="root";
$password="";
$db="onlinefoodorder";

$conn=mysqli_connect($host,$user,$password,$db);
if(!$conn){
    die ("Connection Error");
}
// $sql = "ALTER TABLE users ADD CONSTRAINT fk_role_id FOREIGN KEY (role_id) REFERENCES role(id);";
// $result = mysqli_query($conn, $sql);


