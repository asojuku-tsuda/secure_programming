<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>シリアライズテスト</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <?php
      $data = array("メラ"=>30,"メラミ"=>60,"バギ"=>30,"ベギラマ"=>60);
      $ex = var_export($data, true);
      $b64 = base64_encode($ex);
    ?>
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <form action="eval.php" method="GET">
        <p>呪文情報をシリアライズ化して送ります</p>
        <input type="hidden" name="indata"
          value="<?php echo htmlspecialchars($b64); ?>">
        <button type="submit">送信する</button>
      </form>
    </div>
  </body>
</html>
