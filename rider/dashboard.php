<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rider Dashboard</title>
</head>
<body>
    <h2>Welcome to Your Dashboard</h2>
    <p><a href="../public/index.php">View Tricycles</a> | <a href="my_rentals.php">My Rentals</a> | <a href="logout.php">Logout</a></p>
</body>
</html>
