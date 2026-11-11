<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customer_name    = trim($_POST['customer_name'] ?? '');
    $item             = trim($_POST['item'] ?? '');
    $quantity         = (int)($_POST['quantity'] ?? 1);
    $order_date       = trim($_POST['order_date'] ?? date('Y-m-d'));
    $delivery_address = trim($_POST['delivery_address'] ?? '');

    if (empty($customer_name) || empty($item) || $quantity < 1) {
        die("Invalid order details. Please go back and fill all fields.");
    }

    // Default fallback prices
    $prices = [
        "Idli"            => 50,
        "Plain Dosa"      => 60,
        "Masala Dosa"     => 90,
        "Pongal"          => 70,
        "Parotta"         => 50,
        "Chicken Biryani" => 180,
        "Mutton Biryani"  => 250,
        "Fish Fry"        => 200,
        "Jigarthanda"     => 80,
        "Gulab Jamun"     => 60
    ];

    $price = null;

    // Check menu table in database first for dynamic price
    $menu_stmt = $conn->prepare("SELECT price FROM menu WHERE food_name = ? LIMIT 1");
    if ($menu_stmt) {
        $menu_stmt->bind_param("s", $item);
        $menu_stmt->execute();
        $menu_res = $menu_stmt->get_result();
        if ($menu_row = $menu_res->fetch_assoc()) {
            $price = (float)$menu_row['price'];
        }
        $menu_stmt->close();
    }

    if ($price === null) {
        if (!isset($prices[$item])) {
            die("Invalid food item.");
        }
        $price = (float)$prices[$item];
    }

    $total = $price * $quantity;

    // Generate next Order ID
    $result = mysqli_query($conn, "SELECT MAX(order_id) AS max_order FROM orders");
    $row = mysqli_fetch_assoc($result);
    $order_id = ($row && $row['max_order']) ? ((int)$row['max_order'] + 1) : 101;

    // Default status
    $status = "Pending";

    // Insert order
    $sql = "INSERT INTO orders
            (order_id, customer_name, item, quantity, order_date, delivery_address, status, total)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param(
        $stmt,
        "ississsd",
        $order_id,
        $customer_name,
        $item,
        $quantity,
        $order_date,
        $delivery_address,
        $status,
        $total
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: ../place order.html?success=1");
        exit();
    } else {
        echo "Error placing order: " . mysqli_error($conn);
    }

} else {
    echo "Invalid request method.";
}
?>
