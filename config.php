<?php
$host = "localhost";
$user = "root";  // Default XAMPP MySQL user
$pass = "";      // Default XAMPP MySQL has no password
$db = "water_refill_pos";  // Change this if your database name is different

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
