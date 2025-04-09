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

unset($_SESSION['error']);


$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
						 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
						 PDO::ATTR_EMULATE_PREPARES => false);

$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
							"laravel", "laravel", $opt);

//★ToDo セッションにメールアドレスがあるか確認
//★ToDo if(セッションにメアドが無い){

	//★ToDo メアドをPOSTから取得
	

	try{ //★ToD そのメールアドレスがDBに存在するか確認

		//★ToDo DBを検索

		//★ToDo if(検索結果が0件){

			//★ToDo エラーをセッションに設定

			//★ToDo passwordreset.phpにリダイレクト

		//★ToDo }

		//★ToDo セッションにメアドを設定
		
		//★ToDo セッションのエラーカウントを０に設定

	}catch(PDOException $e){
		echo "Error : " . $e->getMessage() . "\n";
	}
	
//★ToDo }


try{//パスワードリセットロック確認

		//★ToDo セッション内のエラーカウントが3以上か確認
		//★ToDo if(3以上){

			//★ToDo パスワードリセットロックテーブルにロック情報を挿入

		//★ToDo }

		//本来はこの時点でパスワードリセット機能をロックしたことをメール通知する

		//★ToDo パスワードリセットロックテーブルからメールアドレスを検索

		//★ToDo foreach(検索結果をループ){
			//★ToDo 現在時刻を取得

			//★ToDo パスワードリセットロックテーブルのロック時間を取得し、30分後（アンロック時間）を計算

			//★ToDo 現在時刻がアンロック時間より小さいか確認
			//★ToDo if(小さい){

				//★ToDo エラーをセッションに設定(現在パスワードのリセットは利用できません。しばらくたってからお試しください。)

				//★ToDo passwordreset.phpにリダイレクト

			//★ToDo }

		//★ToDo }

}catch(PDOException $e){
		echo "Error : " . $e->getMessage() . "\n";
}


$token="";

//★ToDo セッションにトークンがあるか確認
//★ToDo if(セッションにトークンが無い){

	//★ToDo トークンを生成

	//★ToDo セッションにトークンを設定

//★ToDo }else{

	//★ToDo セッションからトークンを取得

//★ToDo }

//★ToDo メール送信内容を画面に表示する

//★ToDo 失敗回数を画面に表示する

?>
<br><br>
<h2>メールで送信した認証キーを入力してください</h2>
<form action="newpassinput.php" method="post">
	認証キー：<input type="text" name="token">
	<input type="submit" value="認証">
</form>

