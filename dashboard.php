<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
require 'db.php';
$uid = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO kids (user_id, name, age, preferences) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $uid, $_POST['name'], $_POST['age'], $_POST['preferences']);
    $stmt->execute();
}
$kids = $conn->query("SELECT * FROM kids WHERE user_id = $uid");
?>
<h2>Kids</h2>
<form method="POST">
  Name: <input name="name"><br>
  Age: <input name="age" type="number"><br>
  Preferences: <textarea name="preferences"></textarea><br>
  <button>Add Kid</button>
</form>

<ul>
<?php while($k = $kids->fetch_assoc()): ?>
  <li><?= $k['name'] ?> (<?= $k['age'] ?> yrs)</li>
<?php endwhile; ?>
</ul>
<a href="mealplanner.php">Go to Meal Planner</a>
