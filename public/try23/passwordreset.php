<?php
session_start();
unset($_SESSION['mail']);
unset($_SESSION['token']);
unset($_SESSION['errorcount']);
?>

<h2>パスワードをお忘れですか？</h2>
<p>下記にメールアドレスを入力してください。</p>

<?php
	if(isset($_SESSION['error'])){
		echo "<p>※" . $_SESSION['error'] . "</p>"; 
	}
?>
<form action="tokeninput.php" method="post">
メールアドレス:<input type="text" name="mail"><br>
<input type="submit" value="認証キー送信">
</form>