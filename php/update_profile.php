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

$old_username = $_SESSION['username'];

$fullname = trim($_POST['fullname'] ?? '');
$new_username = trim($_POST['username'] ?? '');
$email = trim($_POST['email'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');

if (
    $fullname === '' ||
    $new_username === '' ||
    $email === '' ||
    $mobile === ''
) {

    echo json_encode([
        "success" => false,
        "message" => "All fields are required"
    ]);

    exit();
}


$stmt = mysqli_prepare(
    $conn,
    "UPDATE users
     SET fullname = ?,
         username = ?,
         email = ?,
         mobile = ?
     WHERE username = ?"
);

mysqli_stmt_bind_param(
    $stmt,
    "sssss",
    $fullname,
    $new_username,
    $email,
    $mobile,
    $old_username
);


if (mysqli_stmt_execute($stmt)) {

    $_SESSION['username'] = $new_username;

    echo json_encode([
        "success" => true,
        "message" => "Profile updated successfully"
    ]);

} else {

    echo json_encode([
        "success" => false,
        "message" => "Database update failed"
    ]);
}


mysqli_stmt_close($stmt);
mysqli_close($conn);

?>