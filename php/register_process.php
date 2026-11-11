<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../register.html");
    exit();
}

$fullname = trim($_POST["fullname"] ?? $_POST["name"] ?? "");
$email    = trim($_POST["email"] ?? "");
$username = trim($_POST["username"] ?? "");
$password = $_POST["password"] ?? "";
$mobile   = trim($_POST["mobile"] ?? "");

// Basic Validations
if (empty($fullname) || empty($email) || empty($username) || empty($password)) {
    echo "<script>alert('Please fill in all required fields.'); window.location.href='../register.html';</script>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('Please enter a valid email address.'); window.location.href='../register.html';</script>";
    exit();
}

if (strlen($password) < 6) {
    echo "<script>alert('Password must be at least 6 characters long.'); window.location.href='../register.html';</script>";
    exit();
}

// Check if username or email already exists
$check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ? LIMIT 1");
$check_stmt->bind_param("ss", $username, $email);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    $check_stmt->close();
    echo "<script>alert('Username or Email already exists. Please try another one.'); window.location.href='../register.html';</script>";
    exit();
}
$check_stmt->close();

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$role = "customer";

// Insert user
$insert_stmt = $conn->prepare("INSERT INTO users (fullname, username, email, mobile, password, role) VALUES (?, ?, ?, ?, ?, ?)");
$insert_stmt->bind_param("ssssss", $fullname, $username, $email, $mobile, $hashed_password, $role);

if ($insert_stmt->execute()) {
    $insert_stmt->close();
    echo "<script>alert('Registration successful! Please login with your credentials.'); window.location.href='../login.html';</script>";
    exit();
} else {
    $error = $insert_stmt->error;
    $insert_stmt->close();
    echo "<script>alert('Registration failed: " . addslashes($error) . "'); window.location.href='../register.html';</script>";
    exit();
}
?>
