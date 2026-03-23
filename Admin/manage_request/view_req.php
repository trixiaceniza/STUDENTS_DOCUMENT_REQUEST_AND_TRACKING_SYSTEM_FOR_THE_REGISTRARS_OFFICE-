<?php
session_start();
include '../../Include/db.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../../../login.php");
}

$sql = "SELECT * FROM requests";
$result = mysqli_query($conn,$sql);
?>

<h2>All Student Document Requests</h2>

<table border="1">

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

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['student_id']; ?></td>
<td><?php echo $row['document_type']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['release_schedule']; ?></td>

<td>

<a href="Admin/manage_request/approve_req.php?id=<?php echo $row['id']; ?>">Approve</a>
|
<a href="Admin/manage_request/decline_req.php?id=<?php echo $row['id']; ?>">Decline</a>
|
<a href="Admin/scheduling/add_sched.php?id=<?php echo $row['id']; ?>">Set Schedule</a>

</td>

</tr>

<?php } ?>

</table>

<br><br>

<a href="Admin/dashboard/view_dashboard.php">Back</a>