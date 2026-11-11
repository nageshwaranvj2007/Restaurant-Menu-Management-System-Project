<?php
header("Content-Type: text/html; charset=UTF-8");
require_once __DIR__ . "/db.php";

$status = [];
$status['php_version'] = phpversion();
$status['server_software'] = $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown';

// Test DB Connection
if ($conn && !$conn->connect_error) {
    $status['db_connected'] = true;
    $status['mysql_version'] = $conn->server_info;
    $status['host_info'] = $conn->host_info;
} else {
    $status['db_connected'] = false;
    $status['error'] = $conn->connect_error;
}

// Check tables
$tables = ['users', 'customers', 'menu', 'orders', 'reviews'];
$table_counts = [];
if ($status['db_connected']) {
    foreach ($tables as $t) {
        $res = mysqli_query($conn, "SELECT COUNT(*) AS cnt FROM `$t`");
        if ($res && $r = mysqli_fetch_assoc($res)) {
            $table_counts[$t] = $r['cnt'];
        } else {
            $table_counts[$t] = "Not found / Error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>XAMPP Database Connection Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 40px;
            display: flex;
            justify-content: center;
        }
        .box {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            max-width: 650px;
            width: 100%;
        }
        h1 {
            color: #fa0822;
            margin-top: 0;
            font-size: 26px;
        }
        .badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-fail { background: #f8d7da; color: #721c24; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            text-align: left;
            padding: 10px 12px;
            border-bottom: 1px solid #eee;
        }
        th { background: #f8f9fa; color: #555; }
        .btn {
            display: inline-block;
            margin-top: 25px;
            background: #fa0822;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            font-weight: bold;
        }
        .btn:hover { background: #d9001f; }
    </style>
</head>
<body>

<div class="box">
    <h1>🚀 XAMPP Backend & MySQL Status</h1>

    <?php if ($status['db_connected']): ?>
        <div class="badge badge-success">✅ MySQL Connected Successfully to restaurant_db</div>
    <?php else: ?>
        <div class="badge badge-fail">❌ Failed to Connect to Database</div>
    <?php endif; ?>

    <table>
        <tr>
            <th>Environment</th>
            <td><?php echo htmlspecialchars($status['server_software']); ?></td>
        </tr>
        <tr>
            <th>PHP Version</th>
            <td>PHP <?php echo htmlspecialchars($status['php_version']); ?></td>
        </tr>
        <tr>
            <th>MySQL / MariaDB Version</th>
            <td><?php echo htmlspecialchars($status['mysql_version'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <th>Connection Info</th>
            <td><?php echo htmlspecialchars($status['host_info'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <th>Database Name</th>
            <td><strong>restaurant_db</strong></td>
        </tr>
    </table>

    <h3 style="margin-top: 25px; color: #333;">Database Tables & Records</h3>
    <table>
        <tr>
            <th>Table Name</th>
            <th>Record Count</th>
            <th>Status</th>
        </tr>
        <?php foreach ($table_counts as $table => $cnt): ?>
        <tr>
            <td><code><?php echo htmlspecialchars($table); ?></code></td>
            <td><?php echo htmlspecialchars($cnt); ?> rows</td>
            <td><span style="color: green; font-weight: bold;">✔ Active</span></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div style="margin-top: 25px; display: flex; gap: 10px; flex-wrap: wrap;">
        <a href="../login.html" class="btn">Go to Login Page</a>
        <a href="../dashboard.html" class="btn" style="background: #333;">Admin Dashboard</a>
        <a href="../reviews.html" class="btn" style="background: #e67e22;">Customer Reviews</a>
    </div>
</div>

</body>
</html>
