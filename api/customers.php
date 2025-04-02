<?php
include "../db.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") { // Add Customer
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    
    $sql = "INSERT INTO customers (name, phone, address) VALUES ('$name', '$phone', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Customer added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}

if ($method == "GET") { // View Customers
    $result = $conn->query("SELECT * FROM customers");
    $customers = [];

    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }

    echo json_encode($customers);
}

if ($method == "PUT") { // Update Customer
    parse_str(file_get_contents("php://input"), $_PUT);
    $id = $_PUT["id"];
    $name = $_PUT["name"];
    $phone = $_PUT["phone"];
    $address = $_PUT["address"];

    $sql = "UPDATE customers SET name='$name', phone='$phone', address='$address' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Customer updated successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}

if ($method == "DELETE") { // Delete Customer
    parse_str(file_get_contents("php://input"), $_DELETE);
    $id = $_DELETE["id"];

    $sql = "DELETE FROM customers WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Customer deleted successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}
?>
