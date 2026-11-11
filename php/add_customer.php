<?php
include "db.php";
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
    exit();
}

$name = trim($_POST['name'] ?? '');
$mobile = trim($_POST['mobile'] ?? '');
$email = trim($_POST['email'] ?? '');
$city = trim($_POST['city'] ?? '');
$gender = trim($_POST['gender'] ?? 'Other');
$customer_id = trim($_POST['customer_id'] ?? '');

if (empty($name)) {
    echo json_encode(["success" => false, "message" => "Customer name is required."]);
    exit();
}

// Auto-generate customer_id if not provided
if (empty($customer_id)) {
    $res = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM customers");
    $row = mysqli_fetch_assoc($res);
    $next_num = ($row && $row['max_id']) ? ((int)$row['max_id'] + 1) : 1;
    $customer_id = 'C' . str_pad($next_num, 3, '0', STR_PAD_LEFT);
}

// Check if customer_id already exists
$check = $conn->prepare("SELECT id FROM customers WHERE customer_id = ? LIMIT 1");
$check->bind_param("s", $customer_id);
$check->execute();
if ($check->get_result()->num_rows > 0) {
    $check->close();
    // Generate new unique ID
    $res = mysqli_query($conn, "SELECT MAX(id) AS max_id FROM customers");
    $row = mysqli_fetch_assoc($res);
    $next_num = ($row && $row['max_id']) ? ((int)$row['max_id'] + 1) : 1;
    $customer_id = 'C' . str_pad($next_num, 3, '0', STR_PAD_LEFT);
} else {
    $check->close();
}

$stmt = $conn->prepare("INSERT INTO customers (customer_id, name, mobile, email, city, gender) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $customer_id, $name, $mobile, $email, $city, $gender);

if ($stmt->execute()) {
    $stmt->close();
    echo json_encode([
        "success" => true,
        "message" => "Customer saved successfully!",
        "customer" => [
            "customer_id" => $customer_id,
            "name" => $name,
            "mobile" => $mobile,
            "email" => $email,
            "city" => $city,
            "gender" => $gender
        ]
    ]);
} else {
    $err = $stmt->error;
    $stmt->close();
    echo json_encode(["success" => false, "message" => "Error saving customer: " . $err]);
}

$conn->close();
?>
