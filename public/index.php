<?php
include '../includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tricycle Rentals</title>
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>

<!-- ✅ NAVIGATION BAR -->
<?php include '../includes/navbar.php'; ?>


<!-- ✅ MAIN CONTAINER -->
<div class="container">
    <h1>Available Tricycle</h1>

    <?php
    $tricycles = $conn->query("SELECT * FROM tricycles WHERE status = 'available'");

    if ($tricycles->num_rows > 0) {
        echo "<div class='tricycle-grid'>";
            while ($row = $tricycles->fetch_assoc()) {
                echo "<div class='card'>
                        <strong>Plate No:</strong> {$row['plate_no']}<br>
                        <strong>Model:</strong> {$row['model']}<br><br>";
                
                if (isset($_SESSION['user_id'])) {
                    echo "<a href='book.php?id={$row['id']}'>🚀 Rent Now</a>";
                } else {
                    echo "<a href='login.php'>🔐 Login to Rent</a>";
                }

                echo "</div>";
            }
            echo "</div>";

    } else {
        echo "<p>No tricycles available at the moment.</p>";
    }
    ?>

    <h2>Rental Prices</h2>
    <?php
    $durations = $conn->query("SELECT * FROM rental_durations");

    if ($durations->num_rows > 0) {
        echo "<div class='pricing-grid'>";
        while ($d = $durations->fetch_assoc()) {
            echo "<div class='pricing-card'>
                    <strong>{$d['label']}</strong><br>
                    ₦" . number_format($d['price'], 2) . "
                </div>";
        }
        echo "</div>";

    } else {
        echo "<p>No pricing information available.</p>";
    }
    ?>
</div>


<?php include '../includes/footer.php'; ?>

</body>
</html>
