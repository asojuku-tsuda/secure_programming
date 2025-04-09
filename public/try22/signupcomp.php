<?php
session_start();

function getParam($key, $pattern, $error){
	//POSTのパラメータを取り出す
	$val = filter_input(INPUT_POST, $key);

	//文字エンコーディング(UTF-8)のチェック
	if(! mb_check_encoding($val, 'UTF-8')){
		die('文字エンコーディングが不正です');
	}

	//引数で受け取ったパターンでチェック
	if(preg_match($pattern, $val) !== 1) {
		die($error);
	}
	return $val;
}

$email = getParam('userid', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でメールアドレスを入力してください。');
$pass= getParam('pass', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でパスワードを入力してください。');
$username = getParam('username', '/\A[[:^cntrl:]]{1,20}\z/u', '20文字以内でユーザー名を入力してください。');
$addr = getParam('addr', '/\A[[:^cntrl:]]{1,150}\z/u', '150文字以内で住所を入力してください。');


$hash = password_hash($pass, PASSWORD_DEFAULT);

header('Content-Type: text/html; charset=UTF-8');
try{
	$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
							 PDO::ATTR_EMULATE_PREPARES => false);

	$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
								"laravel", "laravel", $opt);
	$sql = "INSERT INTO User(email, password, name, address) VALUES (?, ?, ?, ?)";
	$ps = $db->prepare($sql);
	$ps->bindValue(1, $email, PDO::PARAM_STR);
	$ps->bindValue(2, $hash, PDO::PARAM_STR);
	$ps->bindValue(3, $username, PDO::PARAM_STR);
	$ps->bindValue(4, $addr, PDO::PARAM_STR);
	$ps->execute();

	echo "<h3>ユーザー登録が完了しました</h3><br>";

}catch(PDOException $e){
	echo "Error : " . $e->getMessage() . "\n";
}

?>