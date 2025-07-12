<?php
session_start();
require 'db.php';
$uid = $_SESSION['user_id'];
$kidId = $_GET['kid_id'];
$meals = $conn->query("SELECT * FROM meals WHERE kid_id = $kidId");
?>
<h2>Weekly Meal Plan</h2>
<ul>
<?php while($m = $meals->fetch_assoc()): ?>
  <li><b><?= $m['day'] ?> <?= $m['meal_time'] ?>:</b> <?= $m['items'] ?> (<?= $m['nutrition'] ?>)</li>
<?php endwhile; ?>
</ul>
