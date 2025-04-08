<?php
function getParam($key, $pattern, $error){
	//POSTのパラメータを取り出す
	$val = filter_input(INPUT_GET, $key);

	//文字エンコーディング(UTF-8)のチェック
	if(! mb_check_encoding($val, 'UTF-8')){
		die('文字エンコーディングが不正です');
	}

	//引数で受け取ったパターンでチェック
	if(preg_match($pattern, $val) !== 1) {
		$val = $error;
	}
	return $val;
}


$postnum = getParam('postnum', '/\A[0-9]{1,7}\z/', '7桁の郵便番号を入力してください');

$ary = ["8100001"=>"福岡市中央区天神",
		"8100002"=>"福岡市中央区西中洲",
		"8100003"=>"福岡県福岡市中央区春吉",
		"8100004"=>"福岡市中央区渡辺通",
		"8100005"=>"福岡市中央区清川"];

$chimei = "";
$result = -1;

if(array_key_exists($postnum, $ary)){
	$chimei = $ary[$postnum];
	$result = 0;
}

$retary = ["chimei"=>$chimei, "result"=>$result, "param"=>$postnum];

$retjson = json_encode($retary);

echo $retjson;

?>