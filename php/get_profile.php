<?php

session_start();
include "db.php";

header("Content-Type: application/json");

if (!isset($_SESSION['username'])) {
    echo json_encode([
        "success" => false,
        "message" => "User is not logged in"
    ]);
    exit();
}

$username = $_SESSION['username'];

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, fullname, email, mobile, username, role, created_at
     FROM users
     WHERE username = ?
     LIMIT 1"
);

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($user = mysqli_fetch_assoc($result)) {

    echo json_encode([
        "success" => true,
        "id" => $user['id'],
        "fullname" => $user['fullname'],
        "email" => $user['email'],
        "mobile" => $user['mobile'],
        "username" => $user['username'],
        "role" => $user['role'],
        "created_at" => $user['created_at']
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "User not found"
    ]);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

?>