<?php
session_start();
include "db.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
    exit();
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id <= 0) {
    echo json_encode(["success" => false, "message" => "Invalid review ID"]);
    exit();
}

$stmt = $conn->prepare("DELETE FROM reviews WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $stmt->close();
    echo json_encode(["success" => true, "message" => "Review deleted successfully"]);
} else {
    $error = $stmt->error;
    $stmt->close();
    echo json_encode(["success" => false, "message" => "Failed to delete: " . $error]);
}

$conn->close();
?>
