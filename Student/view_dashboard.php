<?php
session_start();
include '../Include/db.php';

if(!isset($_SESSION['role']) || $_SESSION['role']!='student'){
    header("Location:index.php");
    exit();
}

$page = $_GET['page'] ?? 'home';
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Dashboard</title>

<style>
body {
    margin:0;
    font-family: Arial;
}

/* SIDEBAR */
.sidebar {
    width:220px;
    height:100vh;
    background:#1e272e;
    color:#fff;
    position:fixed;
    padding-top:20px;
}

.sidebar h3 {
    text-align:center;
    margin-bottom:20px;
}

.sidebar a {
    display:block;
    color:#fff;
    padding:12px;
    text-decoration:none;
    transition:0.3s;
}

.sidebar a:hover {
    background:#485460;
}

/* ACTIVE LINK */
.sidebar a.active {
    background:#0fbcf9;
}

/* CONTENT */
.content {
    margin-left:220px;
    padding:30px;
    background:#f5f6fa;
    min-height:100vh;
}

/* CARD STYLE */
.card {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,0.1);
    width:400px;
}

/* FORM */
select, button {
    padding:10px;
    width:100%;
    margin-top:10px;
}
button {
    background:#0fbcf9;
    color:white;
    border:none;
    cursor:pointer;
}
button:hover {
    background:#0097e6;
}
</style>

</head>
<body>

<div class="sidebar">
    <h3>Student</h3>

    <a href="?page=home" class="<?= $page=='home'?'active':'' ?>">🏠 Dashboard</a>
    <a href="?page=view_req.php" class="<?= $page=='view_req.php'?'active':'' ?>">📄 Request</a>
    <a href="?page=schedule" class="<?= $page=='schedule'?'active':'' ?>">📅 View Schedule</a>
    <a href="../logout.php">🚪 Logout</a>
</div>

<
<div class="content">

<?php
switch($page){

    case 'view_req.php':
        ?>
        <div class="card">
            <h2>📄 Request Document</h2>
            <?php if(isset($success_msg)) echo "<p class='success-msg'>{$success_msg}</p>"; ?>
            <form method="POST">
                <select name="doc" required>
                    <option value="">-- Select Document --</option>
                    <?php
                    // Fetch available documents from admin's documents table
                    $res = $conn->query("SELECT * FROM documents WHERE status='Available'");
                    while($row = $res->fetch_assoc()){
                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                    }
                    ?>
                </select>
                <button name="submit">Request</button>
            </form>
        </div>
        <?php
        break;

    case 'schedule':
        include __DIR__ . '/view_sched.php';
        break;

    default:
        echo "<div class='card'><h2>👨‍🎓 Welcome Student</h2>";
        echo "<p>Select a menu from the sidebar to request documents or view your schedule.</p></div>";
}
?>

</div>
</body>
</html>