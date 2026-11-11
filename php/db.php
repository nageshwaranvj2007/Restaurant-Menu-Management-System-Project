<?php
// php/db.php - Central Database Connection for XAMPP MySQL
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "restaurant_db";

// Connect to MySQL/MariaDB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Attempt fallback to 127.0.0.1:3306 in case socket resolution differs
    $conn = new mysqli("127.0.0.1", $username, $password, $dbname, 3306);
    if ($conn->connect_error) {
        die(json_encode([
            "success" => false,
            "message" => "Database connection failed: " . $conn->connect_error
        ]));
    }
}

// Set standard charset
$conn->set_charset("utf8mb4");
?>
