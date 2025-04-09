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
// データベース接続情報
$user = 'laravel';
$password = 'laravel';

try {
  // データベースに接続
  $dsn = "mysql:host=db;dbname=laravel;charset=utf8";
  $pdo = new PDO($dsn, $user, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
  // 検索条件に基づいてSQLを作成
  $useremail = $_POST['email'];
  $userpwd = $_POST['password'];
  $sql = "SELECT * FROM user WHERE email = '$useremail' AND password = '$userpwd'";

  // SQLを実行し、結果を表示
  $ps = $pdo->query($sql);
  
  if($ps->rowCount() > 0){
    echo "<h2>ログイン成功です</h2>";
  }else{
    echo "<h2>ログイン失敗です</h2>";
  }
  
} catch (PDOException $e) {
  echo 'データベースにアクセスできませんでした。'.$e->getMessage();
  exit;
}
	?>
    </div>
  </body>
</html>
