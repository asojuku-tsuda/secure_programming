<?php
class AccountLock{

	//アカウントロック確認
	//true：ロック中　false:ロック中でない
	public static function isLockAccount($row){
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
	public static function incrementErrorCount($row){
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
	public static function errorReset($row){
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


}
?>