<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
    <?php
    // エラーメッセージがセッションに保存されていれば表示する
    session_start();
    if (isset($_SESSION['error_message'])) {
        echo '<p style="color: red;">' . $_SESSION['error_message'] . '</p>';
        unset($_SESSION['error_message']); // セッションからエラーメッセージを削除
    }

    ?>
      <form action="login_check.php" method="POST">
        <label for="email">E-Mail:</label>
        <input type="text" id="email" name="email" placeholder="Enter your e-mail...">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password...">
        <button type="submit">Login</button>
      </form>
    </div>
  </body>
</html>
