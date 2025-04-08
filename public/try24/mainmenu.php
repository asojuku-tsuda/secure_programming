<?php
//ログインしている場合はメニューページを表示
echo "ログイン成功です";

//ようこそ○○さんと表示
echo "<br>ようこそ" . $_SESSION['username'] . "さん";
echo "<br><a href='adminmenu.php'>管理者メニュー</a>";


?>