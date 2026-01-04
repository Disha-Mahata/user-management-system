<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>

<h2>User Dashboard</h2>
<a href="add_user.php">Add User</a> |
<a href="profile.php">My Profile</a> |
<a href="logout.php">Logout</a>

<br><br>

<table border="1" cellpadding="10">
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>

<?php
$result = $conn->query("SELECT users.*, roles.role_name 
FROM users JOIN roles ON users.role_id = roles.role_id");

while ($row = $result->fetch_assoc()) {
?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['role_name'] ?></td>
    <td>
        <a href="edit.php?id=<?= $row['user_id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['user_id'] ?>" 
        onclick="return confirm('Are you sure?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>
