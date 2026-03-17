<?php
session_start();
include '../../Include/db.php';

if($_SESSION['role'] != "student"){
    header("Location: ../../authentication/login.php");
}

if(isset($_POST['submit'])){

    $student_id = $_SESSION['user_id'];
    $document = $_POST['document_type'];

    $sql = "INSERT INTO requests(student_id, document_type)
            VALUES('$student_id','$document')";

    mysqli_query($conn,$sql);

    echo "Request Submitted!";
}
?>

<h2>Request Document</h2>

<form method="POST">

<select name="document_type">

<option>Transcript of Records</option>
<option>Certificate of Enrollment</option>
<option>Grades</option>
<option>Good Moral Character</option>

</select>

<br><br>

<button type="submit" name="submit">Submit Request</button>

</form>

<br>

<a href="../dashboard/view_dashboard.php">Back</a>