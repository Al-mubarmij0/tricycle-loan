<?php 
include '../includes/db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$tricycle_id = $_POST['tricycle_id'];
$rental_duration_id = $_POST['rental_duration_id'];

$stmt = $conn->prepare("INSERT INTO rental_requests (user_id, tricycle_id, rental_duration_id) VALUES (?, ?, ?)");
$stmt->bind_param("iii", $user_id, $tricycle_id, $rental_duration_id);
$stmt->execute();

$rental_id = $conn->insert_id;

$tricycle = $conn->query("SELECT plate_no FROM tricycles WHERE id = $tricycle_id")->fetch_assoc();
$duration = $conn->query("SELECT label FROM rental_durations WHERE id = $rental_duration_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Confirmation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .confirmation-box {
            position: relative;
            background: white;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 100%;
        }

        .logo {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 60px;
        }

        h2 {
            color: #2ecc71;
            margin-bottom: 10px;
        }

        p {
            margin: 8px 0;
        }

        .btn {
            display: inline-block;
            margin: 15px 10px 0;
            padding: 12px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="confirmation-box">
    <img src="../assets/logo.jpg" alt="TLMTS Logo" class="logo">

    
    <h2>✅ Booking Submitted!</h2>
    <p><strong>Tricycle:</strong> <?= htmlspecialchars($tricycle['plate_no']); ?></p>
    <p><strong>Duration:</strong> <?= htmlspecialchars($duration['label']); ?></p>
    <p><strong>Booking ID:</strong> #<?= $rental_id; ?></p>

    <a class="btn" href="../rider/dashboard.php">Go to Dashboard</a>
    <button class="btn" onclick="window.print()">🖨️ Print Receipt</button>
</div>

</body>
</html>
