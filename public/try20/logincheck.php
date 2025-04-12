<?php
require_once 'TokenManager.php';

session_start();

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

//アカウントロック確認関数
//true：ロック中　false:ロック中でない
//引数：Userテーブルのレコード
function isLockAccount($row){

	$ret = false;

	//タイムゾーンを日本に設定
	date_default_timezone_set('Asia/Tokyo');

	//エラー回数が5回以上
	if($row['errorcount'] >= 5){

		//現在時刻取得
		$nowTime = strtotime(date("Y/m/d H:i:s"));
		//最終エラー時刻取得
		$errortime = strtotime($row['errortime']);
		//最終エラー時刻に10分プラスし、アンロック時間を取得
		$unlocktime = $errortime+600;

		//現在時刻がアンロック時間より小さいか確認
		if( $nowTime <= $unlocktime){
			//ロック状態と設定
			$ret = true;
		}
	}

	return $ret;
}

//エラー回数を+1する
function incrementErrorCount($row){
	try{
		$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
								 PDO::ATTR_EMULATE_PREPARES => false);

		$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
								 "laravel", "laravel", $opt);
		$sql = "UPDATE User SET errorcount=?,errortime=? WHERE id=?";
		$ps = $db->prepare($sql);
		$ps->bindValue(1, $row['errorcount'] + 1, PDO::PARAM_INT);
		$ps->bindValue(2, date("Y/m/d H:i:s"), PDO::PARAM_STR);
		$ps->bindValue(3, $row['id'], PDO::PARAM_STR);

		$ps->execute();
	}catch(PDOException $e){
		echo "Error : " . $e->getMessage() . "\n";
	}
}

//エラーをリセットする
function errorReset($row){
	try{
		$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
								 PDO::ATTR_EMULATE_PREPARES => false);

		$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
								 "laravel", "laravel", $opt);
		$sql = "UPDATE User SET errorcount=0 WHERE id=?";
		$ps = $db->prepare($sql);
		$ps->bindValue(1, $row['id'], PDO::PARAM_STR);

		$ps->execute();
	}catch(PDOException $e){
		echo "Error : " . $e->getMessage() . "\n";
	}
}


$email = getParam('email', '/\A[[:^cntrl:]]{1,100}\z/', '正しいIDを入力してください');
$pass = getParam('pass', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でパスワードを入力してください。');


header('Content-Type: text/html; charset=UTF-8');
try{
	//DB接続
	$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
							 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
							 PDO::ATTR_EMULATE_PREPARES => false);
	$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
							 "laravel", "laravel", $opt);
	//SQL文作成 emailを条件にUserテーブルを検索
 	$sql = "SELECT * FROM User WHERE email = ?";
 	$ps = $db->prepare($sql);
 	$ps->bindValue(1, $email, PDO::PARAM_INT);

	$ps->execute();

	//検索結果が0件の場合
	if($ps->rowCount()== 0)	{
		//そのユーザーは存在しないと表示
		echo "<h3>そのユーザーは存在しません</h3>";
	}

	//検索結果を取得
	while($row = $ps->fetch()){
		
		if(isLockAccount($row) == true){
			echo "<h3>アカウントがロックされています。しばらく時間を置いてログインしてください</h3>";
		}else if(password_verify($pass, $row['password'])){
			//ログイン成功時の処理
			

			//セッションを再発行
			session_regenerate_id(true);
			$_SESSION['id'] = $row['id'];

			//★ToDo 自動ログインにチェックがある場合
			//if(チェックがある場合){
				//★ToDo 現在時刻取得
				
				//★ToDo 7日間の秒数を取得

				//★ToDo 有効期限を現在時刻+7日に設定

				//★ToDo TokenManagerクラスのset_auth_tokenメソッドを呼び出し

				//★ToDo Cookieにトークンを保存
			//}

			//エラーをリセットする
			errorReset($row);

			header('Location: loginsuccess.php');

		}else{
				echo "<h3>ログイン失敗</h3>";
				//エラーをインクリメント
				incrementErrorCount($row);
		}
	}

}catch(PDOException $e){
	echo "Error : " . $e->getMessage() . "\n";
}
?>


</body>
</html>