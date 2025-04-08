<?php
session_start();
require_once 'TokenManager.php';

$tokenMng = new TokenManager();

$token = NULL;

//★ToDo cookieにトークンがあるか確認
//if(・・・){
	//★ToDo cookieにトークンがある場合、$tokenに代入
	
//}

//★ToDo TokenManagerクラスのisloginメソッドを呼び出し $tokenを渡す
//if(・・・){
	//★ToDo ログインしていない場合、ログイン画面に遷移
	
//}

echo "ログイン成功です";
?>