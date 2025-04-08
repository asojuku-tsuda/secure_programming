<html>
<head>
</head>
<body>
    
<?php
//TokenManager.phpの読み込み
require_once 'TokenManager.php';

//セッション開始
session_start();

//トークンを削除
$tokenMng = new TokenManager();

$tokenMng->delete_auth_token($_SESSION['id']);

//セッションを破棄
$_SESSION = array();
session_destroy();

echo "ログアウトしました";

?>
</body>
</html>
