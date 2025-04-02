<?php
include "../db.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") { // Add Order
    $customer_id = $_POST["customer_id"];
    $total_amount = $_POST["total_amount"];
    
    $sql = "INSERT INTO orders (customer_id, total_amount, payment_status) VALUES ($customer_id, $total_amount, 'unpaid')";
    
    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Order added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}

if ($method == "GET") { // View Orders
    $result = $conn->query("SELECT orders.*, customers.name FROM orders JOIN customers ON orders.customer_id = customers.id");
    $orders = [];

    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    echo json_encode($orders);
}
?>
