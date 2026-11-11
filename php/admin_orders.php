<?php
include "db.php";

$sql = "SELECT * FROM orders ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Orders - Restaurant Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            padding: 30px;
            margin: 0;
        }

        .header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        h1 {
            color: #fa0822;
            margin: 0;
        }

        .back-btn {
            background: #fa0822;
            color: white;
            text-decoration: none;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: bold;
        }

        .back-btn:hover {
            background: #d9001f;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #eee;
            padding: 12px 14px;
            text-align: center;
        }

        th {
            background: #fa0822;
            color: white;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background: #fafafa;
        }

        tr:hover {
            background: #fff3f3;
        }

        .status-badge {
            background: #ffecb3;
            color: #b78103;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: bold;
        }

        .status-completed {
            background: #c8e6c9;
            color: #256029;
        }
    </style>
</head>

<body>

<div class="header-bar">
    <h1>📋 Customer Orders</h1>
    <a href="../dashboard.html" class="back-btn">⬅ Back to Dashboard</a>
</div>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Food Item</th>
            <th>Qty</th>
            <th>Delivery Address</th>
            <th>Status</th>
            <th>Total</th>
            <th>Order Date</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $is_completed = (strtolower($row['status']) === 'completed');
            echo "<tr>";
            echo "<td>#" . htmlspecialchars($row['order_id']) . "</td>";
            echo "<td>" . htmlspecialchars($row['customer_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['item']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>" . htmlspecialchars($row['delivery_address'] ?? 'N/A') . "</td>";
            echo "<td><span class='status-badge " . ($is_completed ? 'status-completed' : '') . "'>" . htmlspecialchars($row['status']) . "</span></td>";
            echo "<td><strong>₹" . number_format((float)$row['total'], 2) . "</strong></td>";
            echo "<td>" . htmlspecialchars($row['order_date']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8' style='padding: 25px; color: #777;'>No orders placed yet.</td></tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>
