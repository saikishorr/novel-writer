<?php
require_once '../db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
  echo "Unauthorized";
  exit;
}

$user_id = $_SESSION['user_id'];
$title = $_POST['title'] ?? '';
$content = $_POST['content'] ?? '';
$book_id = $_POST['book_id'] ?? '';

if ($book_id) {
  // Check if the book exists and belongs to the user
  $check = $pdo->prepare("SELECT id FROM books WHERE id = ? AND user_id = ?");
  $check->execute([$book_id, $user_id]);

  if ($check->rowCount() > 0) {
    // Update existing book
    $stmt = $pdo->prepare("UPDATE books SET title = ?, content = ?, updated_at = NOW() WHERE id = ? AND user_id = ?");
    $stmt->execute([$title, $content, $book_id, $user_id]);
    echo "Book updated!";
    exit;
  }
}

// Else, insert new book
$stmt = $pdo->prepare("INSERT INTO books (user_id, title, content) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $title, $content]);
echo "New book saved!";
