<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
        <label>あなたのIDとパスワードいただきました！</label>
        <label>ID:<?php echo $_POST["email"];?></label>
        <label>Password:<?php echo $_POST["password"];?></label>
    </div>
  </body>
</html>