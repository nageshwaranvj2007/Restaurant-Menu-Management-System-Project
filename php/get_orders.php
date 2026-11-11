<?php

include "db.php";

header("Content-Type: application/json");

$sql = "SELECT * FROM orders ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

$orders = [];

while ($row = mysqli_fetch_assoc($result)) {

    $orders[] = $row;

}

echo json_encode($orders);

mysqli_close($conn);

?>