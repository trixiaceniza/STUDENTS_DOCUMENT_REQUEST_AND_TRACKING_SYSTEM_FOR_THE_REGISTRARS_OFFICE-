<?php

include '../Include/db.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] != "admin"){
    header("Location: ../manage_request/view_req.php");
    exit();
}

$sql = "SELECT * FROM requests";
$result = mysqli_query($conn,$sql);
?>

<style>
/* CARD */
.card {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
}

/* TABLE */
.table {
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

.table th, .table td {
    padding:12px;
    border:1px solid #ddd;
    text-align:center;
}

.table th {
    background:#2f3542;
    color:#fff;
}

/* STATUS COLORS */
.badge {
    padding:5px 10px;
    border-radius:5px;
    color:white;
    font-size:12px;
}

.pending { background:#f39c12; }
.approved { background:#2ecc71; }
.declined { background:#e74c3c; }

/* BUTTONS */
.btn {
    padding:6px 10px;
    border-radius:5px;
    text-decoration:none;
    color:white;
    font-size:12px;
}

.btn-approve { background:#2ecc71; }
.btn-decline { background:#e74c3c; }
.btn-sched { background:#3498db; }

.btn:hover {
    opacity:0.8;
}
</style>

<div class="card">

<h2>📄 All Student Document Requests</h2>

<table class="table">
<tr>
    <th>ID</th>
    <th>Student ID</th>
    <th>Document</th>
    <th>Status</th>
    <th>Release Schedule</th>
    <th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>
<td><?= $row['id']; ?></td>
<td><?= $row['student_id']; ?></td>
<td><?= $row['document_type']; ?></td>

<td>
<?php
$status = $row['status'];
$class = ($status=='Approved') ? 'approved' : (($status=='Declined') ? 'declined' : 'pending');
?>
<span class="badge <?= $class ?>"><?= $status ?></span>
</td>

<td><?= $row['release_schedule'] ? $row['release_schedule'] : '—'; ?></td>

<td>

<a class="btn btn-approve"
href="manage_request/approve_req.php?id=<?= $row['id']; ?>">Approve</a>

<a class="btn btn-decline"
href="manage_request/decline_req.php?id=<?= $row['id']; ?>">Decline</a>

<a class="btn btn-sched"
href="manage_request/set_sched.php?id=<?= $row['id']; ?>">Set</a>

</td>

</tr>

<?php } ?>

</table>

</div>