<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

$totalUsers = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$totalTricycles = $conn->query("SELECT COUNT(*) FROM tricycles")->fetch_row()[0];
$activeRentals = $conn->query("SELECT COUNT(*) FROM rental_requests WHERE status = 'approved'")->fetch_row()[0];
$returnPending = $conn->query("SELECT COUNT(*) FROM rental_requests WHERE return_status = 'return_pending'")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            display: flex;
            min-height: 100vh;
        }

        .main-content {
            flex: 1;
            padding: 40px;
            background-color: #f4f6f9;
        }

        .dashboard-grid {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .summary-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            width: 250px;
            text-align: center;
        }

        .summary-card h3 {
            font-size: 1.2rem;
            color: #555;
        }

        .summary-card p {
            font-size: 2rem;
            font-weight: bold;
            color: #3498db;
        }

        h2.section-title {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>

<!-- ✅ Sidebar Included -->
<?php include 'sidebar.php'; ?>

<!-- ✅ Main Content -->
<div class="main-content">
    <h2 class="section-title">📊 Admin Dashboard</h2>

    <div class="dashboard-grid">
        <div class="summary-card">
            <h3>Total Users</h3>
            <p><?= $totalUsers; ?></p>
        </div>
        <div class="summary-card">
            <h3>Total Tricycles</h3>
            <p><?= $totalTricycles; ?></p>
        </div>
        <div class="summary-card">
            <h3>Active Rentals</h3>
            <p><?= $activeRentals; ?></p>
        </div>
        <div class="summary-card">
            <h3>Pending Returns</h3>
            <p><?= $returnPending; ?></p>
        </div>
    </div>
</div>

</body>
</html>
