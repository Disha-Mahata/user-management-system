<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $stmt = $conn->prepare("INSERT INTO users (name,email,password,role_id) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi", $name, $email, $password, $role);
    $stmt->execute();

    header("Location: dashboard.php");
}
?>

<h2>Add User</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role">
        <option value="1">Admin</option>
        <option value="2">User</option>
    </select><br><br>

    <button name="submit">Add User</button>
</form>
