<?php
include '../config.php';

$sql = "SELECT id, name FROM users WHERE role='customer'";
$result = $conn->query($sql);

$customers = [];
while ($row = $result->fetch_assoc()) {
    $customers[] = $row;
}

echo json_encode($customers);
?>
