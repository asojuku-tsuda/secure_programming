<?php
session_start();

// セッションにuser_idとnicknameが存在するか確認する
if (!isset($_SESSION['user_id']) || !isset($_SESSION['nickname'])) {
    header("Location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>BBS</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      
	<?php
  try {
   
    // データベースに接続し、bbsテーブルにデータを挿入する
    // user_idとnicknameはセッションから取得する
    $pdo = new PDO("mysql:host=db;dbname=laravel;charset=utf8", "laravel", "laravel");

    // メッセージを取得するSQLを実行
    $sql = "SELECT nickname, message FROM bbs";
    $stmt = $pdo->query($sql);

    // メッセージを表示
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $nickname = htmlspecialchars($row['nickname'], ENT_QUOTES, 'UTF-8');
        $message = htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8');
        echo "<p>{$nickname}: {$message}</p>";
    }

  } catch (PDOException $e) {
    echo 'データベースにアクセスできませんでした。'.$e->getMessage();
    exit;
  }
	?>
    </div>
  </body>
</html>
