<?php
include 'db.php';

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    // Use prepared statements to be safe
    $stmt = $conn->prepare("INSERT INTO users (name, email, course) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $course);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Student</title>
<style>
/* Reset and font */
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Georgia', serif; }

body {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #dff6e3; /* baby green background */
    background-image: repeating-linear-gradient(
        45deg,
        rgba(0, 100, 0, 0.03),
        rgba(0, 100, 0, 0.03) 1px,
        transparent 1px,
        transparent 20px
    );
}

.form-card {
    background: #f0f9f4;
    padding: 45px 50px;
    border-radius: 12px;
    border: 2px solid #a3d9a5;
    box-shadow: 4px 6px 15px rgba(0, 80, 40, 0.2);
    width: 400px;
}

.form-card h2 {
    text-align: center;
    color: #3a6b44;
    font-family: 'Courier New', monospace;
    margin-bottom: 25px;
}

.form-card label {
    display: block;
    color: #4a5d40;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-card input[type="text"],
.form-card input[type="email"] {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 6px;
    border: 1px solid #8fcf8b;
    background-color: #eaf8ed;
    font-family: 'Georgia', serif;
}

.form-card button {
    width: 100%;
    padding: 12px;
    border: 2px solid #8fcf8b;
    border-radius: 6px;
    background-color: #a3d9a5;
    color: #fff8f0;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-card button:hover {
    background-color: #7fc37d;
    border-color: #5ea65b;
}

.form-card .back-link {
    margin-top: 20px;
    text-align: center;
}

.form-card .back-link a {
    text-decoration: none;
    color: #3a6b44;
    font-weight: bold;
}

.form-card .back-link a:hover {
    text-decoration: underline;
}

@media (max-width: 450px) {
    .form-card { width: 90%; padding: 35px; }
}
</style>
</head>
<body>

<div class="form-card">
    <h2>Add Student</h2>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="course">Course:</label>
        <input type="text" name="course" id="course" required>

        <button type="submit" name="submit">Save</button>
    </form>
    <div class="back-link">
        <a href="index.php">← Back to Student List</a>
    </div>
</div>

</body>
</html>