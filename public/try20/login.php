<?php
session_start();

//TokenManagerクラスの読み込み
require_once 'TokenManager.php';
//TokenManagerクラスのインスタンス生成
$tokenMng = new TokenManager();

$token = NULL;

//★ToDo cookieにトークンがあるか確認
//if(・・・){
	//★ToDo cookieにトークンがある場合、$tokenに代入
	
//}

//★ToDo TokenManagerクラスのisloginメソッドを呼び出し $tokenを渡す
//if(・・・){
	//★ToDo ログイン済みの場合、ログイン成功画面に遷移
	
//}else{
	//★ToDo ログインしていない場合、セッションを破棄
	
//}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
<title>自動ログイン演習</title>
</head>

<body>
<form method="post" action="logincheck.php">
email：<input name="email" type="text" /><br>
パスワード：<input name="pass" type="password" /><br>
<!-- ★ToDo ログインしたままにするチェックボックス -->

<input name="submit" type="submit" value="実行" />
</form>
</body>

</html>
