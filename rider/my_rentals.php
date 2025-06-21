<?php
include '../includes/session_check.php';
include '../includes/db.php';

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT r.*, t.plate_no, d.label 
    FROM rental_requests r
    JOIN tricycles t ON r.tricycle_id = t.id
    JOIN rental_durations d ON r.rental_duration_id = d.id
    WHERE r.user_id = $user_id
    ORDER BY r.id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My Rentals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .rental-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .rental-card {
            width: 100%;
            max-width: 600px;
            background-color: #f9f9f9;
            border-left: 5px solid #3498db;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        .rental-card p {
            margin: 8px 0;
            line-height: 1.5;
        }

        .rental-card a {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 10px;
        }

        .rental-card a:hover {
            background-color: #2980b9;
        }

        h2 {
            color: white;
            font-size: 50px;
            text-align: center;
            margin-top: 30px;
        }

        .status-pending {
            color: orange;
            font-weight: bold;
        }

        .status-approved {
            color: green;
            font-weight: bold;
        }

        .status-declined {
            color: red;
            font-weight: bold;
        }

        .return-status {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="container">
    <h2>My Rentals</h2>

    <div class="rental-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="rental-card">
                    <p><strong>Plate No:</strong> <?= $row['plate_no']; ?></p>
                    <p><strong>Duration:</strong> <?= $row['label']; ?></p>
                    <p><strong>Status:</strong>
                        <span class="status-<?= strtolower($row['status']); ?>">
                            <?= ucfirst($row['status']); ?>
                        </span>
                    </p>
                    <div class="return-status">
                        <strong>Return:</strong>
                        <?php if ($row['return_status'] == 'none' && $row['status'] == 'approved'): ?>
                            <a href="request_return.php?id=<?= $row['id']; ?>">Request Return</a>
                        <?php elseif ($row['return_status'] == 'return_pending'): ?>
                            <span class="status-pending">Awaiting Approval</span>
                        <?php elseif ($row['return_status'] == 'returned'): ?>
                            <span class="status-approved">Returned</span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No rentals found.</p>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
