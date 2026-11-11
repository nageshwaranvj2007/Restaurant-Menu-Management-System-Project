<?php
session_start();
include "db.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode([
        "success" => false,
        "message" => "Invalid request method"
    ]);
    exit();
}

// Get customer name from POST or from session if available
$customer_name = trim($_POST["customer_name"] ?? '');
if (empty($customer_name) && isset($_SESSION['fullname'])) {
    $customer_name = $_SESSION['fullname'];
}
if (empty($customer_name) && isset($_SESSION['username'])) {
    $customer_name = $_SESSION['username'];
}

$raw_rating = trim($_POST["rating"] ?? '5');
$review_text = trim($_POST["review_text"] ?? '');

// Parse rating integer (1 to 5)
$rating = 5;
if (preg_match('/[1-5]/', $raw_rating, $matches)) {
    $rating = (int)$matches[0];
}

// Validate inputs
if (empty($customer_name)) {
    echo json_encode([
        "success" => false,
        "message" => "Please enter your name."
    ]);
    exit();
}

if (empty($review_text)) {
    echo json_encode([
        "success" => false,
        "message" => "Please write your review feedback."
    ]);
    exit();
}

if ($rating < 1 || $rating > 5) {
    $rating = 5;
}

$stmt = $conn->prepare("INSERT INTO reviews (customer_name, rating, review_text) VALUES (?, ?, ?)");
if (!$stmt) {
    echo json_encode([
        "success" => false,
        "message" => "Database error: " . $conn->error
    ]);
    exit();
}

$stmt->bind_param("sis", $customer_name, $rating, $review_text);

if ($stmt->execute()) {
    $stmt->close();
    echo json_encode([
        "success" => true,
        "message" => "Thank you! Your review has been submitted successfully."
    ]);
} else {
    $error = $stmt->error;
    $stmt->close();
    echo json_encode([
        "success" => false,
        "message" => "Failed to save review: " . $error
    ]);
}

$conn->close();
?>
