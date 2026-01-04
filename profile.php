<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}

if (isset($_POST['upload'])) {
    $file = $_FILES['profile'];
    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $allowed = ['jpg','jpeg','png'];

    if (in_array($ext, $allowed) && $file['size'] < 2000000) {
        $path = "uploads/" . time() . $file['name'];
        move_uploaded_file($file['tmp_name'], $path);

        $stmt = $conn->prepare("UPDATE users SET profile_pic=? WHERE user_id=?");
        $stmt->bind_param("si", $path, $_SESSION['user_id']);
        $stmt->execute();
    }
}

$result = $conn->query("SELECT * FROM users WHERE user_id=".$_SESSION['user_id']);
$user = $result->fetch_assoc();
?>

<h2>My Profile</h2>

<img src="<?= $user['profile_pic'] ?>" width="150"><br><br>
<b>Name:</b> <?= $user['name'] ?><br>
<b>Email:</b> <?= $user['email'] ?><br><br>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="profile" required><br><br>
    <button name="upload">Upload Profile Picture</button>
</form>

<br>
<a href="dashboard.php">Back</a>

