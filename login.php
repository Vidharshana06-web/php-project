<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $u = $_POST['username'];
    $p = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $u);
    $stmt->execute();
    $stmt->bind_result($id, $hash);
    $stmt->fetch();
    if (password_verify($p, $hash)) {
        $_SESSION['user_id'] = $id;
        header("Location: dashboard.php");
    } else {
        echo "Login failed";
    }
}
?>
<form method="POST">
  Username: <input name="username"><br>
  Password: <input type="password" name="password"><br>
  <button>Login</button>
</form>
