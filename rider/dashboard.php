<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

include '../includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rider Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<?php include '../includes/navbar.php'; ?>

<div class="overlay">
    <div class="container">
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
                            <strong>Model:</strong> {$row['model']}<br>
                            <a href='book.php?id={$row['id']}'>🚀 Rent Now</a>
                          </div>";
                }
            } else {
                echo "<p>No tricycles available now.</p>";
            }
            ?>
        </div>
    </div>
</div>

<!-- ✅ Footer -->
<?php include '../includes/footer.php'; ?>

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
