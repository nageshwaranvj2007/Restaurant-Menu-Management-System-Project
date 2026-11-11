<?php
include "db.php";
header("Content-Type: application/json");

$query = "SELECT 
    (SELECT COUNT(*) FROM menu) AS total_menu,
    (SELECT COUNT(*) FROM orders) AS total_orders,
    (SELECT COUNT(*) FROM orders WHERE order_date = CURDATE()) AS today_orders,
    (SELECT COALESCE(SUM(total), 0) FROM orders) AS total_revenue,
    (SELECT CASE WHEN (SELECT COUNT(*) FROM customers) > 0 THEN (SELECT COUNT(*) FROM customers) ELSE (SELECT COUNT(*) FROM users WHERE role = 'customer') END) AS total_customers,
    (SELECT COUNT(*) FROM reviews) AS total_reviews,
    (SELECT COALESCE(AVG(rating), 0) FROM reviews) AS avg_rating";

$result = mysqli_query($conn, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "success" => true,
        "total_menu" => (int)$row['total_menu'],
        "total_orders" => (int)$row['total_orders'],
        "today_orders" => (int)$row['today_orders'],
        "total_revenue" => (float)$row['total_revenue'],
        "total_customers" => (int)$row['total_customers'],
        "total_reviews" => (int)$row['total_reviews'],
        "avg_rating" => (float)number_format((float)$row['avg_rating'], 1)
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => mysqli_error($conn)
    ]);
}

mysqli_close($conn);
?>
