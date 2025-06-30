<?php
include '../session/check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: '#editor'
  });
</script>
<style>
    * {
    box-sizing: border-box;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  }

  body {
    width: 95%;
    max-width: 1400px;
    margin: 0 auto;
    padding: 40px 20px;
    background-color: #f4f6f9;
    color: #333;
  }

  h2, h3 {
    color: #2c3e50;
    margin-bottom: 10px;
  }
</style>
    <script src="assets/editor/ckeditor.js"></script>
</head>
<body>
  <!-- <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2> -->
  

  <div class="dashboard-header">
  <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
  
  <div class="dashboard-actions">
    <a href="write.php" class="create-book">➕ Create New Book</a>
    <button onclick="toggleDarkMode()" id="modeToggle">🌙 Dark Mode</button>
  <!-- <a href="">Logout</a> -->
    <a href="../backend/auth/logout.php" class="logoutbtn">🚪 Logout</a>

  </div>
</div>
<!-- <a href="write.php">Write a New Book</a> | -->
<div class="search-bar">
  <input type="text" id="searchInput" placeholder="Search your books..." onkeyup="filterBooks()">
</div>

<h3>Your Books:</h3>
<div id="books"></div>

<script>
// Fetch & display books
fetch('../backend/book/get_books.php')
  .then(res => res.json())
  .then(data => {
    const container = document.getElementById('books');
    data.forEach(book => {
      const div = document.createElement('div');
      div.className = "book-card";
      div.setAttribute("data-title", book.title.toLowerCase());

      div.innerHTML = `
        <input type="text" value="${book.title}" data-id="${book.id}" onchange="updateTitle(this)">
        <div class="book-actions">
          <a href="write.php?book_id=${book.id}">✏️ Edit</a>
          <button onclick="deleteBook(${book.id})">🗑️ Delete</button>
        </div>
      `;
      container.appendChild(div);
    });
  });


// Toggle Dark Mode
function toggleDarkMode() {
  document.body.classList.toggle('dark-mode');
  const modeBtn = document.getElementById('modeToggle');
  modeBtn.textContent = document.body.classList.contains('dark-mode') ? '☀️ Light Mode' : '🌙 Dark Mode';
}
</script>

</body>
</html>
