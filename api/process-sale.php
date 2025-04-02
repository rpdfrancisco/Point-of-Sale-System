<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';

header('Content-Type: application/json');

// Debugging: Check if POST data is received
$input = file_get_contents("php://input");
parse_str($input, $postData);

if (empty($postData)) {
    echo json_encode(["message" => "No POST data received", "raw_input" => $input]);
    exit;
}

$customer_id = $postData['customer_id'] ?? null;
$amount = $postData['amount'] ?? null;
$date = date("Y-m-d H:i:s");

if (!$customer_id || !$amount) {
    echo json_encode(["message" => "All fields are required", "received_data" => $postData]);
    exit;
}

$sql = "INSERT INTO sales (customer_id, amount, date) VALUES ('$customer_id', '$amount', '$date')";

if ($conn->query($sql) === TRUE) {
    echo json_encode(["message" => "Sale processed successfully"]);
} else {
    echo json_encode(["message" => "Error processing sale: " . $conn->error]);
}
?>
