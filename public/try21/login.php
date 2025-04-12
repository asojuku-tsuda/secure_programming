<?php
session_start();
unset($_SESSION['post']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<title>2段階入力</title>
</head>

<body>
<?php
	if(isset($_SESSION['error'])){
		echo "<h3>" . $_SESSION['error'] . "</h3><br>";
		unset($_SESSION['error']);
	}
?>
<form method="post" action="logincheck.php">
メールアドレス：<input name="mail" type="text" /><br>
パスワード:<input type="password" name="pass" id="password"><br>
<input type="submit" value="ログイン">
</form>
</body>

</html>
