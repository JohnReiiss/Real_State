<?php
include('../includes/db.php');

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM property WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);

$properties = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
