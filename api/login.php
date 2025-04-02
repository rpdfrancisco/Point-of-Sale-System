<?php
header("Content-Type: application/json"); // Set JSON response
include "../db.php";

// Ensure the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle raw JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    // Check if data is sent as form-data or JSON
    $email = $_POST["email"] ?? $data["email"] ?? null;
    $password = $_POST["password"] ?? $data["password"] ?? null;

    // Validate required fields
    if (!$email || !$password) {
        echo json_encode(["message" => "Email and password are required"]);
        exit();
    }

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id, name, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user["password"])) {
            echo json_encode([
                "message" => "Login successful",
                "user" => [
                    "id" => $user["id"],
                    "name" => $user["name"],
                    "email" => $user["email"],
                    "role" => $user["role"]
                ]
            ]);
        } else {
            echo json_encode(["message" => "Invalid password"]);
        }
    } else {
        echo json_encode(["message" => "User not found"]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}
?>
