<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <form action="output.php" method="GET">
        <label for="inputtext">タイトル:</label>
        <input type="text" id="inputtext" name="inputtext" placeholder="タイトルを入力">
        <label for="data1">データ入力:</label>
        <input type="text" id="data1" name="data1" placeholder="データを入力">
        <input type="text" id="data2" name="data2" placeholder="データを入力">
        <input type="text" id="data3" name="data3" placeholder="データを入力">
        <input type="text" id="data4" name="data4" placeholder="データを入力">
        <input type="text" id="data5" name="data5" placeholder="データを入力">
        <button type="submit">登録</button>
      </form>
    </div>
  </body>
</html>
