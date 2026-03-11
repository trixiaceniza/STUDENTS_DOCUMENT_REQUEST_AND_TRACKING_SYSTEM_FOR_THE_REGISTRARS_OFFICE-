<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "STUDENTS_DOCUMENT_REQUEST_AND_TRACKING_SYSTEM_FOR_THE_REGISTRARS_OFFICE";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}
?>