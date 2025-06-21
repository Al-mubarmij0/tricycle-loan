<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plate_no = trim($_POST['plate_no']);
    $model = trim($_POST['model']);
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO tricycles (plate_no, model, status) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $plate_no, $model, $status);
    $stmt->execute();

    header("Location: manage_tricycles.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Tricycle</title>
</head>
<body>
    <h2>Add Tricycle</h2>
    <form method="POST">
        <label>Plate No:</label>
        <input type="text" name="plate_no" required><br><br>

        <label>Model:</label>
        <input type="text" name="model" required><br><br>

        <label>Status:</label>
        <select name="status">
            <option value="available">Available</option>
            <option value="unavailable">Unavailable</option>
        </select><br><br>

        <button type="submit">Add</button>
    </form>
</body>
</html>
