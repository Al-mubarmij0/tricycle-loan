<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

// Fetch all riders
$riders = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Riders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            margin: 0;
            display: flex;
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
        }

        .admin-content {
            flex: 1;
            padding: 30px;
        }

        .section-title {
            margin-bottom: 20px;
        }

        .search-bar {
            margin-bottom: 15px;
        }

        .search-bar input {
            padding: 10px;
            width: 300px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .styled-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .styled-table th, .styled-table td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .styled-table th {
            background-color: #3498db;
            color: white;
        }

        .styled-table tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #2980b9;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            margin: 100px auto;
            position: relative;
        }

        .close {
            position: absolute;
            top: 10px; right: 15px;
            font-size: 18px;
            cursor: pointer;
            font-weight: bold;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination button {
            padding: 6px 12px;
            margin: 0 3px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
        }

        .pagination button.active {
            background: #2c3e50;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="admin-content">
    <h2 class="section-title">👤 Manage Riders</h2>
    <?php if (isset($_GET['success']) && $_GET['success'] === 'deleted'): ?>
        <p style="color: green;">Rider deleted successfully.</p>
    <?php elseif (isset($_GET['error'])): ?>
        <p style="color: red;">
            <?php
            if ($_GET['error'] === 'notfound') echo "Rider not found.";
            elseif ($_GET['error'] === 'failed') echo "Failed to delete rider.";
            ?>
        </p>
    <?php endif; ?>


    <div class="search-bar">
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search by name or email...">
    </div>

    <table class="styled-table" id="ridersTable">
        <thead>
            <tr>
                <th>#</th><th>Full Name</th><th>Email</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while($r = $riders->fetch_assoc()): ?>
                <tr data-name="<?= strtolower($r['full_name'] . ' ' . $r['email']); ?>">
                    <td><?= $i++; ?></td>
                    <td><?= $r['full_name']; ?></td>
                    <td><?= $r['email']; ?></td>
                    <td>
                        <a href="#" onclick="openModal(<?= htmlspecialchars(json_encode($r)); ?>)">✏️ Edit</a> |
                        <a href="delete_rider.php?id=<?= $r['id']; ?>" onclick="return confirm('Delete rider?')">🗑️ Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div class="pagination" id="pagination"></div>
</div>

<!-- ✅ Edit Modal -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <form action="update_rider.php" method="POST">
            <input type="hidden" name="id" id="riderId">
            <label>Full Name:</label><br>
            <input type="text" name="full_name" id="riderName" required><br><br>
            <label>Email:</label><br>
            <input type="email" name="email" id="riderEmail" required><br><br>
            <button type="submit">Update</button>
        </form>
    </div>
</div>

<script>
function openModal(data) {
    document.getElementById('editModal').style.display = 'block';
    document.getElementById('riderId').value = data.id;
    document.getElementById('riderName').value = data.full_name;
    document.getElementById('riderEmail').value = data.email;
}

function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

function filterTable() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    document.querySelectorAll("#ridersTable tbody tr").forEach(row => {
        row.style.display = row.dataset.name.includes(input) ? "" : "none";
    });
}

// ✅ Pagination (Client-side)
document.addEventListener("DOMContentLoaded", function() {
    const rowsPerPage = 5;
    const rows = Array.from(document.querySelectorAll("#ridersTable tbody tr"));
    const pageCount = Math.ceil(rows.length / rowsPerPage);
    const pagination = document.getElementById("pagination");

    function showPage(page) {
        rows.forEach((row, i) => {
            row.style.display = (i >= (page - 1) * rowsPerPage && i < page * rowsPerPage) ? "" : "none";
        });
        Array.from(pagination.children).forEach(btn => btn.classList.remove("active"));
        pagination.children[page - 1].classList.add("active");
    }

    for (let i = 1; i <= pageCount; i++) {
        const btn = document.createElement("button");
        btn.textContent = i;
        btn.onclick = () => showPage(i);
        pagination.appendChild(btn);
    }

    if (pageCount > 0) showPage(1);
});
</script>

</body>
</html>
