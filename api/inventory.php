<?php
include "../db.php";

$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") { // Add Item
    $product_name = $_POST["product_name"];
    $stock = $_POST["stock"];
    $price = $_POST["price"];

    $sql = "INSERT INTO inventory (product_name, stock, price) VALUES ('$product_name', $stock, $price)";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["message" => "Product added successfully"]);
    } else {
        echo json_encode(["message" => "Error: " . $conn->error]);
    }
}

if ($method == "GET") { // View Inventory
    $result = $conn->query("SELECT * FROM inventory");
    $inventory = [];

    while ($row = $result->fetch_assoc()) {
        $inventory[] = $row;
    }

    echo json_encode($inventory);
}
?>
