<?php
// header("Location: ../../frontend/login.php?error=1");
// exit;

require_once '../db.php';
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->execute([$username, $username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
  $_SESSION['user_id'] = $user['id'];
  $_SESSION['username'] = $user['username'];
  header('Location: ../../frontend/dashboard.php');
} else {
  echo "Login failed!";
}
