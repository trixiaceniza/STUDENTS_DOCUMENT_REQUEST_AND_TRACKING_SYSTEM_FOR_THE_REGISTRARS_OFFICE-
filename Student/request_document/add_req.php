<?php
session_start();
include '../../Include/db.php';

if(isset($_POST['submit'])){
    $user_id = $_SESSION['user_id'];
    $doc = $_POST['document_type'];


    $conn->query("INSERT INTO requests (student_id, document_type)
                  VALUES ('$user_id','$doc')");

    header("Location: view_req.php");
}
?>

<form method="POST">
    Document:
    <select name="document_type">
        <option>Transcript of Records</option>
        <option>Certificate of Enrollment</option>
         <option>Course Prospectus</option>
    </select><br>


    <button name="submit">Submit</button>
</form>