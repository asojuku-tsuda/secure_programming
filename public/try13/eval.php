<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>結果表示</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <p>
<?php
$data = $_GET['indata'];
$str = base64_decode($data);
eval('$data ='. $str . ";");
var_dump($data);
?>
    </p>
    </div>
  </body>
</html>