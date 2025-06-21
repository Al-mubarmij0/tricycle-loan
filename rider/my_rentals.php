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
<html>
<head>
    <title>My Rentals</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <?php include '../includes/navbar.php'; ?>
    <h2>My Rentals</h2>

    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <p>
                <strong>Plate:</strong> <?= $row['plate_no']; ?> <br>
                <strong>Duration:</strong> <?= $row['label']; ?> <br>
                <strong>Status:</strong> <?= ucfirst($row['status']); ?> <br>
                <strong>Return:</strong>
                <?php if ($row['return_status'] == 'none' && $row['status'] == 'approved'): ?>
                    <a href="request_return.php?id=<?= $row['id']; ?>">Request Return</a>
                <?php elseif ($row['return_status'] == 'return_pending'): ?>
                    Awaiting Approval
                <?php elseif ($row['return_status'] == 'returned'): ?>
                    Returned
                <?php endif; ?>
            </p>
        </div><hr>
    <?php endwhile; ?>

   <?php include '../includes/footer.php'; ?>
</body>
</html>
