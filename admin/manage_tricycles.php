<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

// Handle search & filter
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

// Pagination setup
$limit = 10;
$page = max(1, intval($_GET['page'] ?? 1));
$offset = ($page - 1) * $limit;

// Base query
$where = "1";
if (!empty($search)) {
    $search = $conn->real_escape_string($search);
    $where .= " AND plate_no LIKE '%$search%'";
}
if (!empty($status)) {
    $status = $conn->real_escape_string($status);
    $where .= " AND status = '$status'";
}

// Count for pagination
$totalQuery = $conn->query("SELECT COUNT(*) AS total FROM tricycles WHERE $where");
$totalTricycles = $totalQuery->fetch_assoc()['total'];
$totalPages = ceil($totalTricycles / $limit);

// Fetch records
$tricycles = $conn->query("SELECT * FROM tricycles WHERE $where LIMIT $limit OFFSET $offset");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Tricycles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex">

<?php include 'sidebar.php'; ?>

<div class="flex-grow-1 p-4" style="background: #f4f6f9;">
    <h2 class="mb-4">🛺 Manage Tricycles</h2>

    <!-- ✅ Flash Message -->
    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">✅ Operation completed successfully.</div>
    <?php endif; ?>

    <!-- ✅ Search/Filter Form -->
    <form class="row g-3 mb-3" method="GET">
        <div class="col-md-4">
            <input type="text" name="search" value="<?= htmlspecialchars($search); ?>" placeholder="Search by plate no" class="form-control">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">All Status</option>
                <option value="available" <?= $status == 'available' ? 'selected' : '' ?>>Available</option>
                <option value="rented" <?= $status == 'rented' ? 'selected' : '' ?>>Rented</option>
                <option value="maintenance" <?= $status == 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="manage_tricycles.php" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    <!-- ✅ Add Tricycle Button -->
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">➕ Add Tricycle</button>

    <!-- ✅ Tricycle Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th><th>Plate No</th><th>Model</th><th>Status</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = $offset + 1; while($t = $tricycles->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= htmlspecialchars($t['plate_no']); ?></td>
                    <td><?= htmlspecialchars($t['model']); ?></td>
                    <td><?= ucfirst($t['status']); ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $t['id']; ?>">✏️ Edit</button>
                        <a href="delete_tricycle.php?id=<?= $t['id']; ?>" onclick="return confirm('Delete tricycle?')" class="btn btn-sm btn-danger">🗑️</a>
                    </td>
                </tr>

                <!-- ✅ Edit Modal -->
                <div class="modal fade" id="editModal<?= $t['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="edit_tricycle.php">
                            <input type="hidden" name="id" value="<?= $t['id']; ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Tricycle</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label>Plate No</label>
                                        <input type="text" name="plate_no" value="<?= htmlspecialchars($t['plate_no']); ?>" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Model</label>
                                        <input type="text" name="model" value="<?= htmlspecialchars($t['model']); ?>" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <select name="status" class="form-select">
                                            <option <?= $t['status'] == 'available' ? 'selected' : '' ?>>available</option>
                                            <option <?= $t['status'] == 'rented' ? 'selected' : '' ?>>rented</option>
                                            <option <?= $t['status'] == 'maintenance' ? 'selected' : '' ?>>maintenance</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button class="btn btn-primary" type="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- ✅ Pagination -->
    <nav>
        <ul class="pagination">
            <?php for($p = 1; $p <= $totalPages; $p++): ?>
                <li class="page-item <?= $p == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?search=<?= urlencode($search) ?>&status=<?= urlencode($status) ?>&page=<?= $p ?>"><?= $p ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>

<!-- ✅ Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="add_tricycle.php">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Tricycle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Plate No</label>
                        <input type="text" name="plate_no" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Model</label>
                        <input type="text" name="model" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select">
                            <option>available</option>
                            <option>rented</option>
                            <option>maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-success" type="submit">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
