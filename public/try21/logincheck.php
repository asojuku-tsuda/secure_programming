<?php
session_start();
require_once "AccountLock.php";
?>

<html>
<head>
</head>
<body>

<?php
function getParam($key, $pattern, $error){
	//POSTのパラメータを取り出す
	$val = filter_input(INPUT_POST, $key);

	//文字エンコーディング(Shift-JIS)のチェック
	if(! mb_check_encoding($val, 'Shift_JIS')){
		die('文字エンコーディングが不正です');
	}

	//文字エンコーディング変換
	$val = mb_convert_encoding($val, 'UTF-8', 'Shift_JIS');

	//引数で受け取ったパターンでチェック
	if(preg_match($pattern, $val) !== 1) {
		die($error);
	}
	return $val;
}

$email = getParam('mail', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でメールアドレスを入力してください。');
$pass = getParam('pass', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でパスワードを入力してください。');


header('Content-Type: text/html; charset=UTF-8');
try{
	$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
				PDO::ATTR_EMULATE_PREPARES => false);

	$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
	   			  "laravel", "laravel", $opt);
	$sql = "SELECT * FROM user WHERE email = ?";
	$ps = $db->prepare($sql);
	$ps->bindValue(1, $email, PDO::PARAM_STR);

	$ps->execute();

	if($ps->rowCount()== 0)	{
		$_SESSION['error'] ="そのユーザーは存在しません";
		header('Location: login.php');
		exit();
	}

	while($row = $ps->fetch()){
		if(AccountLock::isLockAccount($row) == true){
			$_SESSION['error'] = "アカウントがロックされています。しばらく時間を置いてログインしてください";
			header('Location: login.php');
			exit();

		}elseif(password_verify($pass, $row['password'])){
			//セッションを再発行
			session_regenerate_id(true);
			$_SESSION['userid'] = $row['id'];
			unset($_SESSION['error']);

			echo "<h3>ログイン成功</h3>";
	
			echo "<p>氏名：" . $row['name'] . "</p><br>";
			echo "<p>住所：" . $row['address'] . "</p>";
			
			//エラーをリセットする
			AccountLock::errorReset($row);

		}else{
				$_SESSION['error'] = "パスワードが間違っています。";
				//エラーをインクリメント
				AccountLock::incrementErrorCount($row);
				header('Location: logincheck.php');

		}
		
	}

}catch(PDOException $e){
	$_SESSION['error'] = $e->getMessage();
	header('Location: logincheck.php');
	exit();
}
?>


</body>
</html>