<?php
include '../../Include/db.php';

$id = $_GET['id'];

if(isset($_POST['submit'])){

    $schedule = $_POST['schedule'];

    $sql = "UPDATE requests 
            SET release_schedule='$schedule' 
            WHERE id='$id'";

    mysqli_query($conn,$sql);

    header("Location: view_req.php");
}
?>

<h2>Set Document Release Schedule</h2>

<form method="POST">

<label>Select Release Date:</label>

<br><br>

<input type="date" name="schedule" required>

<br><br>

<button type="submit" name="submit">
Set Schedule
</button>

</form>