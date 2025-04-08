<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Sign Up Page</title>
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
    
    // 入力されたメールアドレスがセッションに保存されていれば取得する
    $email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
    unset($_SESSION['email']); // セッションからメールアドレスを削除
    ?>

      <form action="signup_check.php" method="POST">
        <label for="email">E-Mail:</label>
        <input type="text" id="email" name="email" value="<?php echo $email; ?>" placeholder="Enter your E-Mail..." required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" placeholder="Enter your password...">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" placeholder="Enter your Name..." >
        <label for="userkana">Kana:</label>
        <input type="text" id="userkana" name="userkana" placeholder="Enter your Name Kana..." >
        <label for="addr">Address:</label>
        <input type="text" id="addr" name="addr" placeholder="Enter your Address..." >
        <button type="submit">新規登録</button>
      </form>
    </div>
  </body>
</html>
