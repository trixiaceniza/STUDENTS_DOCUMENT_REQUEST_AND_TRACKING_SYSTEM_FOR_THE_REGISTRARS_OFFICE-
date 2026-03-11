<?php
include 'database.php';

$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Students CRUD</title>
</head>

<body>

    <h2>Student List</h2>

    <a href="create.php">View Students</a>

    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>year&Section</th>
            <th>Course</th>
            <th>Address</th>
            <th>Document Request</th>
            <th>Actions</th>
        </tr>

        <?php while($row = $result->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['yr_sec']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['docu_req']; ?></td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>

        <?php } ?>

    </table>

</body>

</html>