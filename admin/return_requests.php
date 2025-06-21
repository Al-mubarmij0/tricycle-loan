<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

$query = "
    SELECT rr.*, u.full_name, t.plate_no 
    FROM rental_requests rr
    JOIN users u ON rr.user_id = u.id
    JOIN tricycles t ON rr.tricycle_id = t.id
    WHERE rr.return_status = 'return_pending'
    ORDER BY rr.request_time DESC
";
$returnRequests = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Return Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: flex;">

<?php include 'sidebar.php'; ?>

<div class="p-4" style="flex: 1;">
    <h2 class="mb-4">📦 Return Requests</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-info">
            <tr>
                <th>#</th>
                <th>Rider</th>
                <th>Tricycle</th>
                <th>Status</th>
                <th>Requested At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($r = $returnRequests->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $r['full_name']; ?></td>
                    <td><?= $r['plate_no']; ?></td>
                    <td><span class="badge bg-warning">Return Pending</span></td>
                    <td><?= date('d M Y H:i', strtotime($r['request_time'])); ?></td>
                    <td>
                        <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#confirmReturn<?= $r['id']; ?>">Mark as Returned</button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="confirmReturn<?= $r['id']; ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <form method="POST" action="mark_returned.php">
                            <input type="hidden" name="id" value="<?= $r['id']; ?>">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Return</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to mark <strong><?= $r['plate_no']; ?></strong> as returned by <strong><?= $r['full_name']; ?></strong>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-success">Confirm</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
