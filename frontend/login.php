<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Novel Writer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">

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

.login-container {
  background-color: #fff;
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  width: 100%;
  max-width: 400px;
}
    .login-container h2 {
      margin-bottom: 20px;
      color: #2c3e50;
      text-align: center;
    }

    .login-container label {
      display: block;
      margin-top: 15px;
      margin-bottom: 5px;
      font-weight: 600;
      color: #333;
    }

    .login-container input {
      width: 100%;
      padding: 10px 12px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .login-container .error-msg {
      color: #e74c3c;
      font-size: 14px;
      margin-top: 5px;
    }

    .login-container button {
      width: 100%;
      margin-top: 20px;
      padding: 12px;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .login-container button:hover {
      background-color: #2980b9;
    }

    .login-container p {
      text-align: center;
      margin-top: 20px;
    }

    .login-container a {
      color: #3498db;
      text-decoration: none;
    }

    .login-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Login to Novel Writer</h2>
    <form action="../backend/auth/login.php" method="POST">
      <label>Username or Email:</label>
      <input type="text" name="username" required>

      <label>Password:</label>
      <input type="password" name="password" required>

      <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
        <div class="error-msg">❌ Login failed. Please check your credentials.</div>
      <?php endif; ?>

      <button type="submit">🔐 Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
  </div>
</body>


</body>
</html>
