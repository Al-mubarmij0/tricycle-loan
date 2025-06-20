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
    <title>My Rentals | TLMTS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background-color: #f4f6f9;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #3498db;
        }

        .rental-card {
            padding: 20px;
            border-left: 5px solid #3498db;
            border-radius: 10px;
            background-color: #ecf5fc;
            margin-bottom: 20px;
        }

        .rental-card p {
            margin: 8px 0;
        }

        .rental-card a {
            display: inline-block;
            margin-top: 10px;
            background-color: #3498db;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .rental-card a:hover {
            background-color: #2980b9;
        }

        .status {
            font-weight: bold;
        }

        .status.approved {
            color: green;
        }

        .status.pending {
            color: orange;
        }

        .status.declined {
            color: red;
        }

        .back-btn {
    display: inline-block;
    background-color: #3498db;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.back-btn:hover {
    background-color: #2980b9;
}


        .footer-link {
            text-align: center;
            margin-top: 30px;
        }

        .footer-link a {
            color:rgb(246, 247, 247);
            text-decoration: none;
            font-weight: 500;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>My Rentals</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="rental-card">
            <p><strong>Plate No:</strong> <?= $row['plate_no']; ?></p>
            <p><strong>Duration:</strong> <?= $row['label']; ?></p>
            <p><strong>Status:</strong> 
                <span class="status <?= $row['status']; ?>">
                    <?= ucfirst($row['status']); ?>
                </span>
            </p>
            <p><strong>Return:</strong>
                <?php if ($row['return_status'] == 'none' && $row['status'] == 'approved'): ?>
                    <a href="request_return.php?id=<?= $row['id']; ?>">Request Return</a>
                <?php elseif ($row['return_status'] == 'return_pending'): ?>
                    Awaiting Approval
                <?php elseif ($row['return_status'] == 'returned'): ?>
                    Returned
                <?php endif; ?>
            </p>
        </div>
    <?php endwhile; ?>

  <div class="footer-link">
    <a class="back-btn" href="dashboard.php">← Back to Dashboard</a>
</div>
</div>

</body>
</html>
