<?php
include '../includes/admin_session_check.php';
include '../includes/db.php';

$query = "
    SELECT rr.*, u.full_name, t.plate_no, d.label AS duration_label 
    FROM rental_requests rr
    JOIN users u ON rr.user_id = u.id
    JOIN tricycles t ON rr.tricycle_id = t.id
    JOIN rental_durations d ON rr.rental_duration_id = d.id
    ORDER BY rr.request_time DESC
";
$requests = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Rental Requests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="display: flex;">

<?php include 'sidebar.php'; ?>

<div class="p-4" style="flex: 1;">
    <h2 class="mb-4">📄 Rental Requests</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>#</th>
                <th>Rider</th>
                <th>Tricycle</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Return</th>
                <th>Requested At</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($r = $requests->fetch_assoc()): ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $r['full_name']; ?></td>
                    <td><?= $r['plate_no']; ?></td>
                    <td><?= $r['duration_label']; ?></td>
                    <td>
                        <?php if ($r['status'] == 'pending'): ?>
                            <a href="update_status.php?id=<?= $r['id']; ?>&status=approved" class="btn btn-sm btn-success">Approve</a>
                            <a href="update_status.php?id=<?= $r['id']; ?>&status=rejected" class="btn btn-sm btn-danger">Reject</a>
                        <?php else: ?>
                            <span class="badge bg-<?= $r['status'] == 'approved' ? 'success' : 'danger'; ?>">
                                <?= ucfirst($r['status']); ?>
                            </span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge bg-secondary"><?= ucfirst($r['return_status']); ?></span></td>
                    <td><?= date('d M Y H:i', strtotime($r['request_time'])); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
