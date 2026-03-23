<?php
session_start();
include '../Include/db.php';

if($_SESSION['role']!='student'){ header("Location:index.php"); }
?>

<style>
.sidebar {width:200px; height:100vh; background:#222; color:#fff; position:fixed;}
.sidebar a {display:block; color:#fff; padding:10px; text-decoration:none;}
.sidebar a:hover {background:#444;}
.content {margin-left:210px; padding:20px;}
</style>

<div class="sidebar">
<h3>Student</h3>
<a href="Student/request_document/add_req.php">Request</a>
<a href="Student/view_sched.php">View Schedule</a>

<a href="../../logout.php">Logout</a>
</div>

<div class="content">
<h2>Request Document</h2>
<form method="POST">
<select name="doc">
<option>Transcript</option>
<option>Certificate</option>
</select>
<button name="submit">Request</button>
</form>


</div>