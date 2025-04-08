<?php
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ファイルオープン</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body class="cyberpunk-bg">
    <div class="login-box">
	<?php
  	$filename = filter_input(INPUT_GET, 'filename');
    readfile('openfile/' . $filename . '.html');
	?>
    <h2>上記ファイルを開きました</h2>
    </div>
  </body>
</html>
