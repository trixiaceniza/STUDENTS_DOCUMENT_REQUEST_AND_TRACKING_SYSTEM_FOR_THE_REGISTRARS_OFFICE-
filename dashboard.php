<?php
session_start();
include 'db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user info
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// Count total students
$total_students_result = $conn->query("SELECT COUNT(*) as total FROM users");
$total_students = $total_students_result->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<style>
/* Reset and font */
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Georgia', serif; }

body {
    background: #dff6e3; /* baby-green background */
    background-image: repeating-linear-gradient(
        45deg,
        rgba(0,100,0,0.03),
        rgba(0,100,0,0.03) 1px,
        transparent 1px,
        transparent 20px
    );
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.dashboard-card {
    background: #f0f9f4;
    padding: 40px 50px;
    border-radius: 12px;
    border: 2px solid #a3d9a5;
    box-shadow: 4px 6px 20px rgba(0,80,40,0.2);
    width: 500px;
    text-align: center;
}

.dashboard-card h2 {
    color: #3a6b44;
    font-family: 'Courier New', monospace;
    margin-bottom: 25px;
}

.dashboard-card .nav-links a {
    display: inline-block;
    margin: 10px;
    padding: 10px 20px;
    border: 2px solid #8fcf8b;
    border-radius: 6px;
    background-color: #a3d9a5;
    color: #fff8f0;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
}

.dashboard-card .nav-links a:hover {
    background-color: #7fc37d;
    border-color: #5ea65b;
    color: #fff8f0;
}

.dashboard-card .stats {
    margin-top: 30px;
    background-color: #eaf8ed;
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #8fcf8b;
    color: #3a6b44;
    font-weight: bold;
}

@media (max-width: 550px) {
    .dashboard-card { width: 90%; padding: 30px; }
    .dashboard-card .nav-links a { width: 100%; margin-bottom: 10px; }
}
</style>
</head>
<body>

<div class="dashboard-card">
    <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h2>

    <div class="nav-links">
        <a href="index.php">View Students</a>
        <a href="create.php">Add New Student</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="stats">
        Total Registered Students: <strong><?php echo $total_students; ?></strong>
    </div>
</div>

</body>
</html>