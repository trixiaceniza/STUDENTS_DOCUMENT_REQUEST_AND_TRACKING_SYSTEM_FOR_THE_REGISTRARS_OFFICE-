<?php
include '../Include/db.php';
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.php");
    exit();
}

$page = $_GET['page'] ?? 'home';

/* Allowed pages (security) */
$allowed = ['home','requests','schedule','documents'];
if(!in_array($page, $allowed)){
    $page = 'home';
}

// Handle add document
if(isset($_POST['add_document'])){
    $doc_name = $_POST['doc_name'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("INSERT INTO documents (name, status) VALUES (?, ?)");
    $stmt->bind_param("ss", $doc_name, $status);
    $stmt->execute();
    $stmt->close();
    header("Location: ?page=documents");
    exit();
}

// Handle edit document
if(isset($_POST['edit_document'])){
    $doc_id = $_POST['doc_id'];
    $doc_name = $_POST['doc_name'];
    $status = $_POST['status'];
    $stmt = $conn->prepare("UPDATE documents SET name=?, status=? WHERE id=?");
    $stmt->bind_param("ssi", $doc_name, $status, $doc_id);
    $stmt->execute();
    $stmt->close();
    header("Location: ?page=documents");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body {
    margin:0;
    font-family: Arial;
    background:#f1f2f6;
}

/* LAYOUT */
.container {
    display:flex;
}

/* SIDEBAR */
.sidebar {
    width:230px;
    height:100vh;
    background:#2f3542;
    color:#fff;
    position:fixed;
    padding:20px;
}

.sidebar h2 {
    text-align:center;
    margin-bottom:30px;
}

.sidebar a {
    display:block;
    padding:12px;
    margin-bottom:10px;
    text-decoration:none;
    color:#fff;
    border-radius:6px;
    transition:0.3s;
}

.sidebar a:hover {
    background:#57606f;
}

.sidebar a.active {
    background:#1e90ff;
}

/* CONTENT */
.content {
    margin-left:250px;
    padding:30px;
    width:100%;
}

/* CARD */
.card {
    background:#fff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 2px 8px rgba(0,0,0,0.1);
    margin-bottom:20px;
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
}

table th, table td {
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:left;
}

button {
    padding:8px 15px;
    background:#1e90ff;
    color:#fff;
    border:none;
    border-radius:5px;
    cursor:pointer;
    transition:0.3s;
}

button:hover {
    background:#0c7cd5;
}

input, select {
    padding:8px;
    width:100%;
    margin-bottom:10px;
    border-radius:5px;
    border:1px solid #ccc;
}

/* FORM MODAL */
.modal {
    display:none;
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    background:rgba(0,0,0,0.5);
    justify-content:center;
    align-items:center;
}

.modal-content {
    background:#fff;
    padding:20px;
    border-radius:10px;
    width:400px;
}
</style>
</head>
<body>

<div class="container">

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="?page=home" class="<?= $page=='home'?'active':'' ?>">🏠 Dashboard</a>
        <a href="?page=requests" class="<?= $page=='requests'?'active':'' ?>">📄 Student Request</a>
        <a href="?page=documents" class="<?= $page=='documents'?'active':'' ?>">📚 Manage Documents</a>
        <a href="../logout.php">🚪 Logout</a>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <?php
        switch($page){

            case 'requests':
                include __DIR__ . '/manage_request/view_req.php';
                break;

            case 'schedule':
                include __DIR__ . '/manage_request/set_sched.php';
                break;

            case 'documents':
                // Display documents table
                echo '<div class="card"><h2>Manage Documents</h2>';
                echo '<button onclick="openAddModal()">➕ Add New Document</button><br><br>';

                $res = $conn->query("SELECT * FROM documents ORDER BY id DESC");
                echo '<table>';
                echo '<tr><th>ID</th><th>Name</th><th>Status</th><th>Actions</th></tr>';
                while($row = $res->fetch_assoc()){
                    echo '<tr>';
                    echo '<td>'.$row['id'].'</td>';
                    echo '<td>'.$row['name'].'</td>';
                    echo '<td>'.$row['status'].'</td>';
                    echo '<td>
                        <button onclick="openEditModal('.$row['id'].', \''.$row['name'].'\', \''.$row['status'].'\')">Edit</button>
                    </td>';
                    echo '</tr>';
                }
                echo '</table></div>';
                break;

            default:
                echo "<h2>👨‍💼 Welcome Admin</h2>";
                echo "<p>Use the sidebar to manage requests, schedules, and documents.</p>";
        }
        ?>

    </div>
</div>

<!-- ADD DOCUMENT MODAL -->
<div class="modal" id="addModal">
    <div class="modal-content">
        <h3>Add New Document</h3>
        <form method="POST">
            <input type="text" name="doc_name" placeholder="Document Name" required>
            <select name="status" required>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
            <button type="submit" name="add_document">Add Document</button>
            <button type="button" onclick="closeAddModal()">Cancel</button>
        </form>
    </div>
</div>

<!-- EDIT DOCUMENT MODAL -->
<div class="modal" id="editModal">
    <div class="modal-content">
        <h3>Edit Document</h3>
        <form method="POST">
            <input type="hidden" name="doc_id" id="edit_doc_id">
            <input type="text" name="doc_name" id="edit_doc_name" required>
            <select name="status" id="edit_status" required>
                <option value="Available">Available</option>
                <option value="Not Available">Not Available</option>
            </select>
            <button type="submit" name="edit_document">Save Changes</button>
            <button type="button" onclick="closeEditModal()">Cancel</button>
        </form>
    </div>
</div>

<script>
// ADD DOCUMENT MODAL
function openAddModal(){
    document.getElementById('addModal').style.display = 'flex';
}
function closeAddModal(){
    document.getElementById('addModal').style.display = 'none';
}

// EDIT DOCUMENT MODAL
function openEditModal(id, name, status){
    document.getElementById('edit_doc_id').value = id;
    document.getElementById('edit_doc_name').value = name;
    document.getElementById('edit_status').value = status;
    document.getElementById('editModal').style.display = 'flex';
}
function closeEditModal(){
    document.getElementById('editModal').style.display = 'none';
}
</script>

</body>
</html>