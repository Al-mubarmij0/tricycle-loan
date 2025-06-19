<?php
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$tricycle_id = $_GET['id'];
$result = $conn->query("SELECT * FROM tricycles WHERE id = $tricycle_id");
$tricycle = $result->fetch_assoc();

$durations = $conn->query("SELECT * FROM rental_durations");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Tricycle</title>
</head>
<body>
    <h2>Book Tricycle - <?= $tricycle['plate_no']; ?></h2>

    <form method="POST" action="book_process.php">
        <input type="hidden" name="tricycle_id" value="<?= $tricycle_id; ?>">
        <label>Rental Duration:</label>
        <select name="rental_duration_id" required>
            <?php while ($d = $durations->fetch_assoc()): ?>
                <option value="<?= $d['id']; ?>"><?= $d['label']; ?> - ₦<?= $d['price']; ?></option>
            <?php endwhile; ?>
        </select><br><br>
        <button type="submit">Submit Booking</button>
    </form>
</body>
</html>
