<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Novel Writer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600&display=swap" rel="stylesheet">
  
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      align-items: center;
      justify-content: center;
    }


  </style>
</head>
<body>

  <div class="register-container">
    <h2>Create an Account</h2>

    <form action="../backend/auth/register.php" method="POST">
      <label>Full Name:</label>
      <input type="text" name="fullname" required>

      <label>Username:</label>
      <input type="text" name="username" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <?php if (isset($_GET['error'])): ?>
        <div class="error-msg">❌ <?= htmlspecialchars($_GET['error']) ?></div>
      <?php endif; ?>

      <button type="submit">📝 Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>

</body>
</html>
