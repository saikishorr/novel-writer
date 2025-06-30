<?php
require_once '../db.php';

$username = $_POST['username'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
// $stmt->execute([$username, $email, $password]);
$pdo->prepare("INSERT INTO users (fullname, username, email, password) VALUES (?, ?, ?, ?)")
    ->execute([$fullname, $username, $email, $password]);

header('Location: ../../frontend/login.php');
