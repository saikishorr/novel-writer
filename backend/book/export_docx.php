<?php
require '../../vendor/autoload.php';
require '../db.php';
session_start();

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized.");
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$book_id = $_GET['book_id'] ?? null;

if (!$book_id) {
    die("No book specified.");
}

$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? AND user_id = ?");
$stmt->execute([$book_id, $user_id]);
$book = $stmt->fetch();

if (!$book) {
    die("Book not found or permission denied.");
}

$phpWord = new PhpWord();
$section = $phpWord->addSection();

// Header Info
$section->addTitle($book['title'], 1);
$section->addText("Author: $username");
$section->addText("Created: " . date('d M Y, h:i A', strtotime($book['created_at'])));
$section->addText("Last Modified: " . date('d M Y, h:i A', strtotime($book['updated_at'])));
$section->addTextBreak(1);

// Parse HTML content
\PhpOffice\PhpWord\Shared\Html::addHtml($section, $book['content'], false, false);

// Download .docx
$filename = preg_replace('/[^A-Za-z0-9_\-]/', '_', $book['title']) . '.docx';
header("Content-Description: File Transfer");
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');

$writer = IOFactory::createWriter($phpWord, 'Word2007');
$writer->save("php://output");
exit;
