# ✍️ Novel Writer

**Novel Writer** is a PHP-based web application that allows users to write, edit, save, and export their novels. It's a minimal, clean writing platform designed for simplicity, focus, and functionality.

---

## 🚀 Features

- 🔐 User registration and login with full name
- ✏️ Rich text editing using **CKEditor 5**
- 💾 Auto-save content every 30 seconds
- 📦 Export book content to `.docx` using **PHPWord**
- 📚 Book dashboard: create, edit, rename, and delete books
- 🌐 Responsive landing page with login/register buttons
- 🌙 Light/Dark mode toggle on dashboard
- ❌ Login error and field validation messages
- 🖼️ Hero section with background image

---

## 🧱 Tech Stack

| Technology | Usage                            |
|------------|----------------------------------|
| PHP        | Core backend logic               |
| MySQL      | User and book database           |
| CKEditor   | WYSIWYG editor for book content  |
| PHPWord    | DOCX export support              |
| HTML/CSS   | Frontend pages and styling       |
| JavaScript | Auto-save, fetch, dark mode etc. |

---

## 📁 Project Structure

```
/frontend
│
├── login.php              # User login form
├── register.php           # User registration form (with full name)
├── write.php              # Rich text editor with auto-save + export
├── dashboard.php          # Lists user's books with edit/delete

/backend
│
├── auth/
│   ├── login.php          # Handles user login
│   ├── register.php       # Handles user registration
│   └── logout.php         # Session logout logic
│
├── book/
│   ├── create_book.php    # API to create a new book
│   ├── get_books.php      # Fetch all books for current user
│   ├── save_content.php   # Save content during auto-save
│   ├── export_docx.php    # Generate and download .docx using PHPWord
│   ├── update_title.php   # Rename book title
│   └── delete_book.php    # Delete a book
│
└── db.php                 # PDO connection setup

/session
└── check_session.php      # Session validation for protected pages

/vendor
└── (PHPWord installed via Composer)

└── index.php              # Landing page with hero + features
```

---

## 🛠️ Setup Instructions

### 1. 📦 Requirements

- PHP 8+
- MySQL / MariaDB
- Composer

### 2. 📥 Clone the repository

```
git clone https://github.com/yourusername/novel-writer.git
cd novel-writer
```
### 3. ⚙️ Configure database

- Create a MySQL database (e.g., novel_writer)
- Import schema (users and books tables)
- Update backend/db.php with your DB credentials
```
$pdo = new PDO("mysql:host=localhost;dbname=novel_writer", "root", "");
```
### 4. 🧩 Install PHPWord
```
composer require phpoffice/phpword
```
This will generate the /vendor folder.

## 📦 Future Improvements

- 📊 Word count tracker
- 🖼️ Image support inside books
- 🧾 Export to PDF
- 📱 Mobile PWA support
- ✨ Editor themes (dark paper, serif/sans font toggle)
- 👤 User profile + avatar upload

## 📄 License
MIT License — free to use and modify.

## 👋 Author
Built with ❤️ by Saikishor Rasala

