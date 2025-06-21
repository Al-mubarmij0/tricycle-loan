<!-- admin/sidebar.php -->
<style>
    /* Sidebar Navigation (Admin Panel) */
    .sidebar {
        width: 220px;
        background-color: #2c3e50;
        color: white;
        padding: 20px;
        flex-shrink: 0;
        min-height: 100vh;
    }

    .sidebar h2 {
        font-size: 1.4rem;
        margin-bottom: 20px;
        color: #ecf0f1;
    }

    .sidebar a {
        display: block;
        color: white;
        text-decoration: none;
        padding: 10px 0;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .sidebar a:hover {
        background-color: #34495e;
        padding-left: 10px;
    }
</style>

<div class="sidebar">
    <h2>🛠 Admin</h2>
    <a href="dashboard.php">📊 Dashboard</a>
    <a href="manage_riders.php">👤 Manage Riders</a>
    <a href="manage_tricycles.php">🛺 Manage Tricycles</a>
    <a href="rental_requests.php">📄 Rental Requests</a>
    <a href="return_requests.php">📦 Return Requests</a>
    <a href="logs.php">📝 Activity Logs</a>
    <a href="logout.php" style="color: #e74c3c;">🚪 Logout</a>
</div>
