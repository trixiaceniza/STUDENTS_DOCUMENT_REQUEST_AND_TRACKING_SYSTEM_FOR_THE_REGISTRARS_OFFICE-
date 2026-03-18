<?php
session_start();
include '../../Include/db.php';

$student_id = $_SESSION['user_id'];

$sql = "SELECT * FROM requests WHERE student_id='$student_id'";
$result = mysqli_query($conn,$sql);

?>

<h2>My Document Requests</h2>

<table border="1">

<tr>
<th>ID</th>
<th>Document</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>
<td><?php echo $row['document_type']; ?></td>
<td><?php echo $row['status']; ?></td>
<td><?php echo $row['request_date']; ?></td>

<td>

<a href="delete_req.php?id=<?php echo $row['id']; ?>">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

<br>

<a href="../dashboard/view_dashboard.php">Back</a>