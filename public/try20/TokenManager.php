<?php

class TokenManager{

	//DBに接続しPDOオブジェクトを返す
	public function connectDB(){
		$opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
								PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
								PDO::ATTR_EMULATE_PREPARES => false);

		$db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
								"laravel", "laravel", $opt);
		return $db;
	}

	//トークンをチェックをする関数
	private function check_auth_token($token){
		//★ToDo DB接続

		//★ToDo SQL文作成 トークンを条件にautologinテーブルを検索


		//★ToDo 検索結果を取得
		//foreach(検索結果を１行ずつ取得){
			//★ToDo トークンの有効期限が現在時刻より大きい場合
			//if(現在時刻より有効期限が大きい場合){
				//★ToDo ユーザーIDを返す
				
			//}
		//}

		//★ToDo falseを返す
	}


	//ログイン中であるか確認する関数
	public function islogin($token){
		//★ToDo セッションがある場合
		//if(・・・){
			//★ToDo trueを返す

		//}

		//★ToDo check_auth_tokenメソッドを呼び出し、自動ログインできるか確認

		//★ToDo 自動ログインできた場合
		//if (・・・){

			//★ToDo セッションにユーザーIDを格納

			//★ToDo delete_auth_tokenメソッドを呼び出し、トークンを削除

			//★ToDo 現在時刻を取得

			//★ToDo 7日間の秒数を取得

			//★ToDo 現在時刻に7日間の秒数を足した値を$expiresに代入

			//★ToDo set_auth_tokenメソッドを呼び出し、新しいトークンを発行

			//★ToDo 新しいトークンをcookieに保存

			//★ToDo trueを返す
		//}

		//★ToDo falseを返す

	}

	//トークンを発行する関数
	public function set_auth_token($id, $expires){
		$isSuccess = false;

		do{
				try{
					//★ToDo トークンを生成 24バイトのランダムな文字列を生成

					//★ToDo DB接続

					//★ToDo SQL文作成 トークンをautologinテーブルに保存


					//★ToDo $isSuccessにtrueを代入

					//★ToDo トークンを返す

			}catch(PDOException $e){
				echo "Error : " . $e->getMessage() . "\n";
			}

		}while($isSuccess == false); //$isSuccessがfalseの場合は繰り返す
		
	}

	//トークンを削除する関数　idを条件にautologinテーブルからトークンを削除
	public function delete_auth_token($id){

			try{
				//★ToDo DB接続

				//★ToDo SQL文作成 トークンをautologinテーブルから削除

		}catch(PDOException $e){
			echo "Error : " . $e->getMessage() . "\n";
		}
		
	}
}

?>