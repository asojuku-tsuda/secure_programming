<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <h2>
<?php
echo "あなたが入力した値<br>";
echo "名前：" . $_GET['username'] . "<br>";
echo "住所：" . $_GET['useraddress']. "<br>";
echo "メールアドレス：" . $_GET['usermail'];
?>
    </h2>
    </div>
  </body>
</html>
