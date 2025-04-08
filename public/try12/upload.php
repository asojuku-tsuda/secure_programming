<?php
define('UPLOADPATH', 'uploaddir');

$tmpfile = $_FILES["imgfile"]["tmp_name"];
$orgfile = $_FILES["imgfile"]["name"];
if(! is_uploaded_file($tmpfile)){
	die('ファイルがアップロードされていません');
}

if(! move_uploaded_file($tmpfile, UPLOADPATH . "/" . $orgfile)){
	die('ファイルをアップロードできません');
}
?>

<body>
<h3>今までにアップした画像</h3>
<?php
foreach(glob('uploaddir/{*.gif,*.jpg, *.png}',GLOB_BRACE) as $file){
    if(is_file($file)){
        echo '<img src="'. htmlspecialchars($file) . '" height="200px">';
    }
}

?>
</body>