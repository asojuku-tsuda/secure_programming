<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SignUp Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
	<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $username = $_POST['username'];
      $kana = $_POST['userkana'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $addr = $_POST['addr'];
     

      // パスワードのチェック
      if (mb_ereg_match('(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[._&])[a-zA-Z\d._&]+', $password)) {

        // データベースへの接続情報
        $dsn = 'mysql:host=db;dbname=laravel;charset=utf8';
        $db_user = 'laravel';
        $db_password = 'laravel';
        try {
          // データベースへの接続
          $db = new PDO($dsn, $db_user, $db_password);

          // エラーモードを設定して例外をスローするようにする
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          // ユーザーの新規登録
          $stmt = $db->prepare("INSERT INTO User (name, kana, email, password, address) VALUES (?, ?, ?, ?, ?)");
          $stmt->bindParam(1, $username, PDO::PARAM_STR);
          $stmt->bindParam(2, $kana, PDO::PARAM_STR);
          $stmt->bindParam(3, $email, PDO::PARAM_STR);
          $stmt->bindParam(4, $password, PDO::PARAM_STR);
          $stmt->bindParam(5, $addr, PDO::PARAM_STR);
          $stmt->execute();

          echo "<h2>登録が完了しました</h2>";
        } catch (PDOException $e) {
          echo "エラー: " . $e->getMessage();
        }

      } else {
        // パスワードに問題がある場合はエラーメッセージをセッションに保存してsignup.phpにリダイレクト
        $error_message = 'パスワードは小文字英字、大文字英字、数字、記号（._&）を少なくとも1つ含む必要があります。';
        session_start();
        $_SESSION['error_message'] = $error_message;
        $_SESSION['email'] = $email;
        header("Location: signup.php");
        exit;
      }
    } else {
      // POSTでない場合はsignup.phpにリダイレクト
      header("Location: signup.php");
      exit;
    }
	?>
    </div>
  </body>
</html>
