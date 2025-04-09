<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
        IDまたはパスワードが違います。再度入力してください。
      <form action="login_huck.php" method="POST">
        <label for="email">E-Mail:</label>
        <input type="text" id="email" name="email" placeholder="Enter your e-mail...">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password...">
        <button type="submit">Login</button>
      </form>
    </div>
  </body>
</html>