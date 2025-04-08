<?php
$file='shoppinglist.txt';
if (file_exists($file)) {
	$filedata = file_get_contents($file);
	$str = base64_decode($filedata);
	eval('$board=' . $str . ';');
}else{
	$board=[];
}

if(in_array($_POST['item'], $board)){
	$delidx = array_search($_POST['item'], $board);
	array_splice($board, $delidx, 1);
}else{
	$board[]=$_POST['item'];
}

$ex = var_export($board, true);
$b64 = base64_encode($ex);

file_put_contents($file, $b64);

foreach ($board as $message) {
	echo '<p>', $message, '</p><hr>';
}

?>