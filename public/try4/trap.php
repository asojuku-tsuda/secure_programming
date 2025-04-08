<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ユーザー登録完了</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <h2>君のクレジット番号はいただいた！<br>
<?php
echo "カード名義：" . $_POST['username'] . "<br>";
echo "カード番号：" . $_POST['cardno'] . "<br>";
echo "hacking@xxx.comに送信完了しました。"
?>
    </h2>
    </div>
  </body>
</html>
