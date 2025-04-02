<?php
include '../config.php';


$sql = "SELECT id, customer, amount, date FROM sales";
$result = $conn->query($sql);

$sales = [];
while ($row = $result->fetch_assoc()) {
    $sales[] = $row;
}

echo json_encode($sales);
?>
