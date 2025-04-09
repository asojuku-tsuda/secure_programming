<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <form action="user_success.php" method="POST">
        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" placeholder="Input your name..." value="<?php echo $_POST['username']; ?>">
        <button type="submit">Regist</button>
      </form>
    </div>
  </body>
</html>
