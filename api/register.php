<?php
include "../db.php";

// Ensure the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if data is sent as JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if data is sent as form-data
    $name = isset($_POST["name"]) ? $_POST["name"] : (isset($data["name"]) ? $data["name"] : null);
    $email = isset($_POST["email"]) ? $_POST["email"] : (isset($data["email"]) ? $data["email"] : null);
    $password = isset($_POST["password"]) ? $_POST["password"] : (isset($data["password"]) ? $data["password"] : null);
    $role = isset($_POST["role"]) ? $_POST["role"] : (isset($data["role"]) ? $data["role"] : null);

    // Validate required fields
    if (!$name || !$email || !$password || !$role) {
        echo json_encode(["message" => "All fields are required"]);
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into database
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "User registered successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
