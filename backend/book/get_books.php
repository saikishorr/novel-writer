<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  echo json_encode([]);
  exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT id, title, content, created_at, updated_at FROM books WHERE user_id = ? ORDER BY updated_at DESC");
$stmt->execute([$user_id]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
