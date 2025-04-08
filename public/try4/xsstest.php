<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <h2>検索キーワード：
<?php
echo $_GET['keyword'];
?>
    </h2>
    </div>
  </body>
</html>
