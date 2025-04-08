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
      $email = $_POST['email'];
      $password = $_POST['password'];

      echo '登録が完了しました';
      
    } else {
      // POSTでない場合はsignup.phpにリダイレクト
      header("Location: signup.php");
      exit;
    }
	?>
    </div>
  </body>
</html>
