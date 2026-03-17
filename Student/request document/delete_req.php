<?php
include '../../Inlcude/db.php';

$id = $_GET['id'];

$sql = "DELETE FROM requests WHERE id='$id'";

mysqli_query($conn,$sql);

header("Location: view_req.php");

?>