<?php
include 'config.php';
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM users WHERE user_id=$id");
$user = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $name = $_POST['name'];

    $stmt = $conn->prepare("UPDATE users SET name=? WHERE user_id=?");
    $stmt->bind_param("si", $name, $id);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>

<h2>Edit User</h2>
<form method="POST">
    <input type="text" name="name" value="<?= $user['name'] ?>" required><br><br>
    <button name="update">Update</button>
</form>
