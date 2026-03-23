<?php
session_start();
include '../Include/db.php';

if($_SESSION['role']!='admin'){ header("Location:index.php"); }
?>

<style>
.sidebar {width:200px; height:100vh; background:#333; color:#fff; position:fixed;}
.sidebar a {display:block; color:#fff; padding:10px; text-decoration:none;}
.sidebar a:hover {background:#575757;}
.content {margin-left:210px; padding:20px;}
</style>

<div class="sidebar">
<h3>Menu</h3>
<a href="manage_request\view_req.php">Student's Requests</a>
<a href="../manage_manage/view_stud.php">View Students</a>
<a href="logout.php">Logout</a>
</div>

<div class="content">
</div>