<?php
require_once '../db.php';
session_start();

$title = $_POST['title'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("INSERT INTO books (user_id, title) VALUES (?, ?)");
$stmt->execute([$user_id, $title]);

echo "Book created successfully!";
