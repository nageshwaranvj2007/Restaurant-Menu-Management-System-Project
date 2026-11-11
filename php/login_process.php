<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../login.html");
    exit();
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$role     = trim($_POST['role'] ?? '');

if (empty($username) || empty($password) || empty($role)) {
    echo "<script>alert('Please fill in all fields.'); window.location.href='../login.html';</script>";
    exit();
}

// 1. Fetch the user matching username/email and role
$stmt = $conn->prepare("SELECT id, fullname, username, email, password, role FROM users WHERE (username = ? OR email = ?) AND role = ? LIMIT 1");
$stmt->bind_param("sss", $username, $username, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    $stmt->close();

    // 2. Verify hashed password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id']  = $user['id'];
        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role']     = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../dashboard.html");
        } else {
            header("Location: ../customer dashboard.html");
        }
        exit();
    } else {
        echo "<script>alert('Invalid Password!'); window.location.href='../login.html';</script>";
        exit();
    }
} else {
    $stmt->close();
    echo "<script>alert('No user found with that username and role!'); window.location.href='../login.html';</script>";
    exit();
}
?>
