<?php
include '../Include/db.php';

// Check if 'id' exists in URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

}

if(isset($_POST['submit'])){
    $schedule = $_POST['schedule'];

    $stmt = $conn->prepare("UPDATE requests SET release_schedule=? WHERE id=?");
    $stmt->bind_param("si", $schedule, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: view_req.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Set Document Release Schedule</title>
    <style>
        /* Card container */
        .card {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 30px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #555;
            text-align: left;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #45a049;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Set Document Release Schedule</h2>

    <form method="POST">
        <label>Select Release Date:</label>
        <input type="date" name="schedule" required>
        <button type="submit" name="submit">Set Schedule</button>
    </form>
</div>

</body>
</html>