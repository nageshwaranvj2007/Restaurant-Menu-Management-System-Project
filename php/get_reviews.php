<?php
include "db.php";

header("Content-Type: application/json");

// Optional filter by rating
$filter_rating = isset($_GET['rating']) && is_numeric($_GET['rating']) ? (int)$_GET['rating'] : 0;

if ($filter_rating >= 1 && $filter_rating <= 5) {
    $stmt = $conn->prepare("SELECT id, customer_name, rating, review_text, created_at FROM reviews WHERE rating = ? ORDER BY id DESC");
    $stmt->bind_param("i", $filter_rating);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT id, customer_name, rating, review_text, created_at FROM reviews ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
}

$reviews = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $reviews[] = [
            "id" => (int)$row['id'],
            "customer_name" => $row['customer_name'],
            "rating" => (int)$row['rating'],
            "review_text" => $row['review_text'],
            "created_at" => $row['created_at']
        ];
    }
}

// Calculate total and average
$stats_res = mysqli_query($conn, "SELECT COUNT(*) AS total, COALESCE(AVG(rating), 0) AS avg_rating FROM reviews");
$stats = mysqli_fetch_assoc($stats_res);

$avg = isset($stats['avg_rating']) ? (float)$stats['avg_rating'] : 0.0;

echo json_encode([
    "success" => true,
    "total_reviews" => (int)($stats['total'] ?? 0),
    "avg_rating" => (float)number_format($avg, 1),
    "reviews" => $reviews
]);

mysqli_close($conn);
?>
