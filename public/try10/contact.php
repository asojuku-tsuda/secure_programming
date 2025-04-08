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
	$from = filter_input(INPUT_POST, 'from');
	$title = filter_input(INPUT_POST, 'title');
	$content = filter_input(INPUT_POST, 'content');

	mb_language('Japanese');
	mb_send_mail("abc@asojuku.ac.jp", $title,
							 "問い合わせメールです\n" . $content,
							 "From:" . $from);
	?>
    <p>送信しました</p>
    </div>
  </body>
</html>
