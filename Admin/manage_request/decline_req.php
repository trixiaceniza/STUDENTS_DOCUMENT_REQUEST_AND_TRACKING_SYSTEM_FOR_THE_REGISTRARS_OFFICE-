<?php
include '../../Include/db.php';

$id = $_GET['id'];

$sql = "UPDATE requests 
        SET status='Declined' 
        WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: view_req.php");
?>