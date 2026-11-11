<?php

include "db.php";

header("Content-Type: application/json");

$id = $_POST['id'];
$food_name = $_POST['food_name'];
$category = $_POST['category'];
$price = $_POST['price'];
$status = $_POST['status'];

$sql = "UPDATE menu 
        SET food_name = ?,
            category = ?,
            price = ?,
            status = ?
        WHERE id = ?";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssdsi",
    $food_name,
    $category,
    $price,
    $status,
    $id
);

if(mysqli_stmt_execute($stmt)) {

    echo json_encode([
        "success" => true,
        "message" => "Menu updated successfully"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Update failed"
    ]);

}

?>