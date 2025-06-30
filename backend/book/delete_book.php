<?php
require_once '../db.php';
session_start();

$id = $_GET['id'] ?? null;
$user_id = $_SESSION['user_id'];

if ($id) {
  $stmt = $pdo->prepare("DELETE FROM books WHERE id = ? AND user_id = ?");
  $stmt->execute([$id, $user_id]);
  echo "Book deleted successfully.";
} else {
  echo "Invalid request.";
}
