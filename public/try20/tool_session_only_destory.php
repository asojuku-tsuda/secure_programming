<html>
<head>
</head>
<body>
    
<?php
//TokenManager.phpの読み込み
require_once 'TokenManager.php';

//セッション開始
session_start();


//セッションを破棄
$_SESSION = array();
session_destroy();

echo "セッションのみ破棄しました";

?>
</body>
</html>
