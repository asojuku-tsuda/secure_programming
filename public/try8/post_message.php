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
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">

	<?php
  try {
    // POSTで送信されたmessageを受け取る
    $message = $_POST['message'];

    // データベースに接続し、bbsテーブルにデータを挿入する
    // user_idとnicknameはセッションから取得する
    $db = new PDO("mysql:host=db;dbname=laravel;charset=utf8", "laravel", "laravel");
    $sql = "INSERT INTO bbs (user_id, nickname, message) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $_SESSION['user_id']);
    $stmt->bindParam(2, $_SESSION['nickname']);
    $stmt->bindParam(3, $message);
    $stmt->execute();

    echo "<h2>書込みが完了しました</h2>";
    echo "<a href='bbs.php'>掲示板を見る</a>";
  } catch (PDOException $e) {
    echo 'データベースにアクセスできませんでした。'.$e->getMessage();
    exit;
  }
	?>
    </div>
  </body>
</html>
