<?php
include '../Include/db.php';
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

// Fetch all student requests
$result = $conn->query("
    SELECT r.*, s.name AS student_name 
    FROM requests r
    JOIN students s ON r.student_id = s.id
    ORDER BY r.request_date DESC
");
?>

<h2>📄 Student Requests</h2>
<table border="1" style="width:100%; border-collapse: collapse;">
    <tr>
        <th>Student</th>
        <th>Document</th>
        <th>Status</th>
        <th>Request Date</th>
        <th>Release Schedule</th>
        <th>Action</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= htmlspecialchars($row['student_name']) ?></td>
        <td><?= htmlspecialchars($row['document_name']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td><?= htmlspecialchars($row['request_date']) ?></td>
        <td><?= htmlspecialchars($row['release_schedule'] ?? 'Not Scheduled Yet') ?></td>
        <td>
            <?php if($row['status'] == 'Pending'): ?>
                <a href="update_req.php?id=<?= $row['id'] ?>">Edit</a> |
                <a href="delete_req.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this request?');">Delete</a>
            <?php else: ?>
                🔒 Locked
            <?php endif; ?>
        </td>
    </tr>
    <?php endwhile; ?>
</table>