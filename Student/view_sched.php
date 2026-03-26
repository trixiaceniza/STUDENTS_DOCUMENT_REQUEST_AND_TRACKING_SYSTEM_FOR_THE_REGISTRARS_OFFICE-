<?php
include '../Include/db.php';

/* Join with users table to show student name */
$result = $conn->query("
    SELECT r.*, u.name 
    FROM requests r
    JOIN users u ON r.student_name = u.id
    WHERE r.status = 'Approved'
");
?>

<style>
.table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.table th, .table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

.table th {
    background: #2c3e50;
    color: white;
}

.badge {
    padding: 5px 10px;
    border-radius: 5px;
    color: white;
}

.approved { background: #27ae60; }
</style>

<h2>📅 Approved Schedules</h2>

<table class="table">
<tr>
    <th>Student Name</th>
    <th>Document</th>
    <th>Request Date</th>
    <th>Release Schedule</th>
    <th>Status</th>
</tr>

<?php if($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['name'] ?></td>
        <td><?= $row['document_type'] ?></td>
        <td><?= $row['request_date'] ?></td>
        <td><?= $row['release_schedule'] ?></td>
        <td><span class="badge approved"><?= $row['status'] ?></span></td>
    </tr>
    <?php endwhile; ?>
<?php else: ?>
<tr>
    <td colspan="5">No approved schedules found.</td>
</tr>
<?php endif; ?>

</table>