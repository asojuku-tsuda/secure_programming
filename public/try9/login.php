<?php
  session_start();
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
  $sql = "SELECT * FROM user WHERE email = ? AND password = ?";
  $ps = $pdo->prepare($sql);
  $ps->bindValue(1, $useremail, PDO::PARAM_STR);
  $ps->bindValue(2, $userpwd, PDO::PARAM_STR);

  // SQLを実行し、結果を表示
  $ps->execute();

  //検索結果を一旦配列に
  $getArr = $ps->fetchAll();

  if(count($getArr) > 0) {
    // ログイン成功
    // セッションにユーザー情報を保存
    $_SESSION['user_id'] = $getArr[0]['id'];
    $_SESSION['email'] = $getArr[0]['email'];
    
    // GETパラメータ「url」の値を取得
    if(isset($_POST['url']) && !empty($_POST['url'])) {
      $redirect_url = $_POST['url'];
      // リダイレクト実行
      header("Location: " . $redirect_url);
      exit;
    } else {
      // urlパラメータがない場合はデフォルトページへリダイレクト
      header("Location: success.php");
      exit;
    }
  } else {
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