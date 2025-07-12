<?php
session_start();
require 'db.php';
$uid = $_SESSION['user_id'];

$kids = $conn->query("SELECT * FROM kids WHERE user_id = $uid");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("INSERT INTO meals (kid_id, day, meal_time, items, nutrition) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $_POST['kid_id'], $_POST['day'], $_POST['meal_time'], $_POST['items'], $_POST['nutrition']);
    $stmt->execute();
}
?>
<h2>Plan Meal</h2>
<form method="POST">
  Kid:
  <select name="kid_id">
    <?php while ($k = $kids->fetch_assoc()): ?>
      <option value="<?= $k['id'] ?>"><?= $k['name'] ?></option>
    <?php endwhile; ?>
  </select><br>
  Day: <input name="day"><br>
  Time: <input name="meal_time"><br>
  Items: <textarea name="items"></textarea><br>
  Nutrition: <textarea name="nutrition"></textarea><br>
  <button>Save Meal</button>
</form>
