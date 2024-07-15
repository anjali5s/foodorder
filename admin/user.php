<?php
// Start the session


// Include the database connection file
include('../connection.php');

// Check if the admin is logged in
// if (!isset($_SESSION['admin_email'])) {
//     header("Location: login.php");
//     exit(); // Ensure the script stops executing after the redirect
// }

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
} else {
    echo "0 results";
}
include 'layouts/header.php';

?>


<body>
    <div class="container">
       
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>