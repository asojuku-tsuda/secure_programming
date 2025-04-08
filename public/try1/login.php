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
		if($_GET['username']=="asosys" &&
		    $_GET['password']=="abcc2291")
		{
			echo "<h2>ログイン成功だ！ようこそHACKの世界へ</h2>";
		}else{
			echo "<h2>ログイン失敗だ！もう一度確認しろ</h2>";
		}
	?>
    </div>
  </body>
</html>
