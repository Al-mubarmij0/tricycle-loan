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
<html lang="en">
<head>
    <title>Book Tricycle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        .book-container {
            max-width: 600px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .book-container h2 {
            margin-top: 0;
            color: #2c3e50;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background: var(--primary);
            border: none;
            border-radius: 8px;
            font-size: 16px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button[type="submit"]:hover {
            background: var(--secondary);
        }
    </style>
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="overlay">
    <div class="book-container">
        <h2>Book Tricycle - <?= htmlspecialchars($tricycle['plate_no']); ?></h2>

        <form method="POST" action="book_process.php">
            <input type="hidden" name="tricycle_id" value="<?= $tricycle_id; ?>">

            <label for="duration">Rental Duration</label>
            <select name="rental_duration_id" id="duration" required>
                <?php while ($d = $durations->fetch_assoc()): ?>
                    <option value="<?= $d['id']; ?>">
                        <?= htmlspecialchars($d['label']); ?> - ₦<?= number_format($d['price']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Submit Booking</button>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
</body>
</html>
