<?php
require_once '../db.php';
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$title = $data['title'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("UPDATE books SET title = ? WHERE id = ? AND user_id = ?");
if ($stmt->execute([$title, $id, $user_id])) {
  echo "Title updated successfully!";
} else {
  echo "Failed to update title.";
}
