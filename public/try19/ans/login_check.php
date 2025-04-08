<?php
  session_start();
?>
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

//PDOでデータベースに接続し、PDOクラスを返す関数
function connectDB(){
  $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
               PDO::ATTR_EMULATE_PREPARES => false);

  $db = new PDO("mysql:host=localhost;dbname=secpgdb;charset=utf8",
                "testuser", "Abcc&2291", $opt);
  return $db;
}

//アカウントロック確認
//true：ロック中　false:ロック中でない
function isLockAccount($row){
	$ret = false;
	date_default_timezone_set('Asia/Tokyo');

	//エラー回数が１０回以上
	if($row['errorcount'] >= 10){

		//現在時刻取得
		$nowTime = strtotime(date("Y/m/d H:i:s"));
		//最終エラー時刻取得
		$errortime = strtotime($row['errortime']);
		//最終エラー時刻に30分プラスし、アンロック時間を取得
		$unlocktime = $errortime+1800;

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
    //データベースに接続
		$db = connectDB();

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
    //データベースに接続
		$db = connectDB();

		$sql = "UPDATE User SET errorcount=0 , errortime=NULL WHERE id=?";
		$ps = $db->prepare($sql);
		$ps->bindValue(1, $row['id'], PDO::PARAM_STR);

		$ps->execute();
	}catch(PDOException $e){
		echo "Error : " . $e->getMessage() . "\n";
	}
}


$userid = getParam('email', '/\A[[:^cntrl:]]{1,100}\z/', '正しいIDを入力してください');
$pass = getParam('password', '/\A[[:^cntrl:]]{1,100}\z/', '100文字以内でパスワードを入力してください。');


header('Content-Type: text/html; charset=UTF-8');
try{
  //データベースに接続
	$db = connectDB();

	$sql = "SELECT * FROM user WHERE email = ?";
	$ps = $db->prepare($sql);
	$ps->bindValue(1, $userid, PDO::PARAM_INT);

	$ps->execute();

	if($ps->rowCount()== 0)	{
    $error_message = 'そのユーザーは存在しません';    
    $_SESSION['error_message'] = $error_message;
    header("Location: login.php");
    exit;
	}

	while($row = $ps->fetch()){
		
		if(isLockAccount($row) == true){
			$error_message = 'アカウントがロックされています。しばらく時間を置いてログインしてください';    
      $_SESSION['error_message'] = $error_message;
      header("Location: login.php");
      exit;
		}else if(password_verify($pass, $row['password'])){
			//セッションを再発行
			session_regenerate_id(true);
			$_SESSION['userid'] = $userid;

			echo "<h2>ログイン成功</h2>";
			
			//エラーをリセットする
			errorReset($row);

		}else{
 			//エラーをインクリメント
			incrementErrorCount($row);

      $error_message = 'ログイン失敗';    
      $_SESSION['error_message'] = $error_message;
      header("Location: login.php");
      exit;


		}
	}

}catch(PDOException $e){
	echo "Error : " . $e->getMessage() . "\n";
}

	?>
    </div>
  </body>
</html>
