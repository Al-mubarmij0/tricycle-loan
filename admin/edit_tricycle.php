<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $plate_no = trim($_POST['plate_no']);
    $model = trim($_POST['model']);
    $status = $_POST['status'];

    if ($id && $plate_no && $model && in_array($status, ['available', 'unavailable'])) {
        $stmt = $conn->prepare("UPDATE tricycles SET plate_no=?, model=?, status=? WHERE id=?");
        $stmt->bind_param("sssi", $plate_no, $model, $status, $id);
        $stmt->execute();
        header("Location: manage_tricycles.php?success=1");
        exit;
    } else {
        header("Location: manage_tricycles.php?success=0");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Tricycle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background: #f4f6f9;
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 400px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            margin-top: 20px;
            padding: 10px 18px;
            background-color: #3498db;
            border: none;
            color: white;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background-color: #2980b9;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <h2>Edit Tricycle</h2>

    <?php if (isset($error)): ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Plate No:</label>
        <input type="text" name="plate_no" value="<?= htmlspecialchars($tricycle['plate_no']); ?>" required>

        <label>Model:</label>
        <input type="text" name="model" value="<?= htmlspecialchars($tricycle['model']); ?>" required>

        <label>Status:</label>
        <select name="status" required>
            <option value="available" <?= $tricycle['status'] === 'available' ? 'selected' : '' ?>>Available</option>
            <option value="unavailable" <?= $tricycle['status'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
        </select>

        <button type="submit">Update</button>
    </form>

</body>
</html>
