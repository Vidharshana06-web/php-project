<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = $_POST['username'];
    $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $u, $p);
    $stmt->execute();
    header("Location: login.php");
}
?>
<form method="POST">
  Username: <input name="username"><br>
  Password: <input type="password" name="password"><br>
  <button>Register</button>
</form>
