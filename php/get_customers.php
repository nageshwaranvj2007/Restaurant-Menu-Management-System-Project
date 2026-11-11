<?php
include "db.php";
header("Content-Type: application/json");

$result = mysqli_query($conn, "SELECT id, customer_id, name, mobile, email, city, gender FROM customers ORDER BY id ASC");
$customers = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $customers[] = $row;
    }
}

echo json_encode([
    "success" => true,
    "total" => count($customers),
    "customers" => $customers
]);

mysqli_close($conn);
?>
