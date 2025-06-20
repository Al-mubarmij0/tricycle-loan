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
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .booking-box {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            max-width: 450px;
            width: 100%;
        }

        .booking-box h2 {
            margin-top: 0;
            margin-bottom: 20px;
            color: #3498db;
            text-align: center;
        }

        label {
            font-weight: 500;
            display: block;
            margin: 10px 0 5px;
        }

        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="booking-box">
    <h2>Book a Tricycle - <?= htmlspecialchars($tricycle['plate_no']); ?></h2>

    <form method="POST" action="book_process.php">
        <input type="hidden" name="tricycle_id" value="<?= $tricycle_id; ?>">

        <label for="rental_duration_id">Rental Duration:</label>
        <select name="rental_duration_id" id="rental_duration_id" required>
            <?php while ($d = $durations->fetch_assoc()): ?>
                <option value="<?= $d['id']; ?>"><?= $d['label']; ?> - ₦<?= number_format($d['price']); ?></option>
            <?php endwhile; ?>
        </select>

        <button type="submit">Submit Booking</button>
    </form>
</div>

</body>
</html>
