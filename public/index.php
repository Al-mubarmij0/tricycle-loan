<?php
include '../includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tricycle Rentals</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">

</head>
<body>

<!-- ✅ Navbar -->
<div class="navbar">
    <div class="heading">TLMTS</div>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
    </div>
</div>

<div class="overlay">
    <div class="container">

        <!-- ✅ Hero -->
        <section class="hero">
            <h1>Welcome to Tricycle Rentals</h1>
            <p class="lead">Reliable, convenient, and affordable tricycle transport for all your local needs. Perfect for quick rides or deliveries in busy areas.</p>
        </section>

        <!-- ✅ About Section -->
        <section class="about">
            <h2>What is a Tricycle?</h2>
            <p>Tricycles—also called "keke" or "three-wheelers"—are lightweight vehicles used widely for short-distance travel and small deliveries. They’re fast, fuel-efficient, and can easily navigate tight roads. Our platform helps you find and book available tricycles near you quickly and affordably.</p>
        </section>

        <!-- ✅ Available Tricycles -->
        <section>
            <h2 class="section-title">Available Tricycles</h2>
            <div class="search-bar">
                <input type="text" id="searchInput" onkeyup="filterTricycles()" placeholder="Search by model or plate number...">
            </div>
            <div class="tricycle-grid" id="tricycleGrid">
                <?php
                $res = $conn->query("SELECT * FROM tricycles WHERE status = 'available'");
                if ($res->num_rows) {
                    while ($row = $res->fetch_assoc()) {
                        echo "<div class='card' data-search='" . strtolower($row['plate_no'].' '.$row['model']) . "'>
                            <strong>Plate No:</strong> {$row['plate_no']}<br>
                            <strong>Model:</strong> {$row['model']}<br>";
                        echo isset($_SESSION['user_id'])
                            ? "<a href='book.php?id={$row['id']}'>🚀 Rent Now</a>"
                            : "<a href='login.php'>🔐 Login to Rent</a>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No tricycles available now.</p>";
                }
                ?>
            </div>
        </section>

        <!-- ✅ Pricing -->
        <section>
            <h2 class="section-title">Rental Prices</h2>
            <div class="pricing-grid">
                <?php
                $res2 = $conn->query("SELECT * FROM rental_durations");
                if ($res2->num_rows) {
                    while ($d = $res2->fetch_assoc()) {
                        echo "<div class='pricing-card'><strong>{$d['label']}</strong>₦".number_format($d['price'],2)."</div>";
                    }
                } else {
                    echo "<p>No pricing info available.</p>";
                }
                ?>
            </div>
        </section>

    </div>
</div>

<!-- ✅ Footer -->
<div class="footer">
    <p>&copy; <?php echo date("Y"); ?> TLMTS - Tricycle Local Mobility Transport Service</p>
</div>

<!-- ✅ Filter Script -->
<script>
function filterTricycles() {
    const val = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('#tricycleGrid .card').forEach(c => {
        c.style.display = c.getAttribute('data-search').includes(val) ? 'block' : 'none';
    });
}
</script>

</body>
</html>
