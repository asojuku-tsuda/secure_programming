<?php
    session_start();

    // セッションにuser_idとnicknameが存在しなければ、ログイン画面にリダイレクトする
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['nickname'])) {
      header('Location: login.html');
      exit();
    }
  ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>掲示板入力</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <form action="post_message.php" method="POST">
        <label for="message">Message:</label>
        <input type="text" id="message" name="message" placeholder="Message...">
        <button type="submit">投稿</button>
      </form>
    </div>
  </body>
</html>
