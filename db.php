<?php
$conn = new mysqli("localhost", "root", "", "kids_meal_planner");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
