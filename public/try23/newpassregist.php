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
$pass= getParam('pass', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でパスワードを入力してください。');


try{
	$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
							 PDO::ATTR_EMULATE_PREPARES => false);

	$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
								"laravel", "laravel", $opt);

	//★ToDo パスワードのハッシュ化

	//★ToDo ユーザーテーブル上のパスワードを更新


	echo "パスワードの変更が完了しました<br>";

	//★ToDo メール送信内容を画面に表示

}catch(PDOException $e){
	echo "Error : " . $e->getMessage() . "\n";
}



?>