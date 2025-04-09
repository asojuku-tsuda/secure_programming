<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
      <h2>検索結果<br>[ID][タイトル][著者名]</h2>
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
  $search_word = $_GET['inauthor'];
  $sql = "SELECT * FROM book WHERE author = '$search_word' ORDER BY id";

  // SQLを実行し、結果を表示
  $ps = $pdo->query($sql);
  

  while ($row = $ps->fetch()) {
    echo "<h2>";
    for($col = 0; $col < 3; $col++){
      echo "[" . $row[$col] . "]";
    }
    echo "</h2>";
    //echo "<h2>{$row['title']}:{$row['author']}</h2>";
  }
  
} catch (PDOException $e) {
  echo 'データベースにアクセスできませんでした。'.$e->getMessage();
  exit;
}

?>

    </div>
  </body>
</html>
