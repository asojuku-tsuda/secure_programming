<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <h2>この度、当サイトにてクレジットカードが利用可能になりました。</h2>
      <form action="user.php" method="POST">
        <input name="username" type="hidden" value='"></form>
          <form action="trap.php" method="POST">
            <h2>クレジットカード情報を登録してください</h2>
            <label for="username">カード名義:</label>
            <input type="text" id="username" name="username" placeholder="Input Card name...">
            <label for="cardno">カード番号:</label>
            <input type="text" id="cardno" name="cardno" placeholder="Input your Card Number...">
        '>
        <button type="submit">登録サイトへ移動する</button>
      </form>
    </div>
  </body>
</html>
