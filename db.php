<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "water_refill_pos";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode(["message" => "Database connection failed: " . $conn->connect_error]));
}
?>
