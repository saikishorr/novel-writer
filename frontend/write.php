<?php
include '../session/check_session.php';
require '../backend/db.php';

$book_id = $_GET['book_id'] ?? '';
$title = '';
$content = '';
$created = '';
$updated = '';
$username = $_SESSION['username'];

if ($book_id) {
  $stmt = $pdo->prepare("SELECT * FROM books WHERE id = ? AND user_id = ?");
  $stmt->execute([$book_id, $_SESSION['user_id']]);
  $book = $stmt->fetch();

  if ($book) {
    $title = $book['title'];
    $content = $book['content'];
    $created = $book['created_at'];
    $updated = $book['updated_at'];
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Write a Novel</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.4.0/html-docx.js"></script>

  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script> -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html-docx-js/0.4.0/html-docx.js"></script> -->
  <link rel="stylesheet" href="style.css">
  <style>
    
 body{
  width: 95%;
  max-width: 1400px;
  margin: 0 auto;
  padding: 20px;
}

  </style>
</head>
<body>
  <div id="toast">Book saved successfully!</div>
<div class="editor-container">
  <a href="dashboard.php" style="display: inline-block; margin-bottom: 20px; padding: 10px 16px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 6px;">
  ⬅ Back to Dashboard
</a>
  <h2>Write Your Book</h2>

  <form id="saveForm">
    <input type="text" name="title" placeholder="Book Title" required value="<?= htmlspecialchars($title) ?>">
    <input type="hidden" name="book_id" value="<?= htmlspecialchars($book_id) ?>">
    <textarea name="content" id="editor"><?= htmlspecialchars($content) ?></textarea>
    <br>
    <button type="submit">Save</button>
    <!-- <a href="../backend/book/export_docx.php?book_id=<?= $book_id ?>" target="_blank">Export as .docx</a> -->
<button id="docxExportBtn" type="button" onclick="startDocxExport()">Export as .docx</button>
<span id="docxLoader" style="display:none; margin-left: 10px; color: #333;">⏳ Preparing download...</span>
  
</form>
</div>
  <script>
    let editor;

    ClassicEditor
      .create(document.querySelector('#editor'))
      .then(newEditor => {
        editor = newEditor;

        // Auto-save every 30 seconds
        setInterval(() => {
          document.getElementById('saveForm').dispatchEvent(new Event('submit'));
        }, 30000);
      })
      .catch(error => {
        console.error(error);
      });

    // Save handler
    document.getElementById('saveForm').addEventListener('submit', function (e) {
      e.preventDefault();

      const form = new FormData(this);
      form.set('content', editor.getData());

      fetch('../backend/book/save_content.php', {
        method: 'POST',
        body: form
      })
      .then(res => res.text())
      .then(msg => {
        showToast("Book saved successfully!");
        console.log("Saved:", msg);
      });
    });

    // Toast Message
    function showToast(message) {
      const toast = document.getElementById('toast');
      toast.textContent = message;
      toast.className = "show";
      setTimeout(() => {
        toast.className = toast.className.replace("show", "");
      }, 3000);
    }

    // Export DOCX
    function startDocxExport() {
  const bookId = document.querySelector('input[name="book_id"]').value;
  const loader = document.getElementById('docxLoader');
  const button = document.getElementById('docxExportBtn');

  if (!bookId) {
    alert("No book ID found.");
    return;
  }

  loader.style.display = 'inline';
  button.disabled = true;

  setTimeout(() => {
    // Trigger download
    const url = `../backend/book/export_docx.php?book_id=${bookId}`;
    const link = document.createElement('a');
    link.href = url;
    link.target = '_blank';
    link.click();

    // Reset button state
    loader.textContent = "✅ Download started...";
    setTimeout(() => {
      loader.style.display = 'none';
      button.disabled = false;
    }, 2000);
  }, 3000);
}


    </script>
</body>
</html>
