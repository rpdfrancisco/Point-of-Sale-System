<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include '../config.php';

header('Content-Type: application/json');

$sql = "SELECT sales.id, sales.amount, sales.date, users.name AS customer_name
        FROM sales
        JOIN users ON sales.customer_id = users.id
        ORDER BY sales.date DESC";

$result = $conn->query($sql);

if ($result) {
    $sales = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode($sales);
} else {
    echo json_encode(["error" => $conn->error]);
}
?>
