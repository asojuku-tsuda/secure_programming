<?php
session_start();

unset($_SESSION['error']);

//★ToDo セッション内のトークンとPOSTされたトークンが一致するか確認
//★ToDo if(一致しない){

	//★ToDo エラーカウントをインクリメント

	//★ToDo tokeninput.phpにリダイレクト

//★ToDo }

$_SESSION['errorcount'] = 0;

?>
<style>
small{ color:red;}
</style>

<form action="newpassregist.php" method="post" id="signupform">
パスワード:<input type="password" name="pass"><br>
　　再入力:<input type="password" name="confirmpass"><br>
<small id="error"></small><br>
<input type="submit" value="登録" name="submitbtn" disabled>
</form>

<script>
//JavaScriptによるパスワードポリシーチェック


const $form = document.getElementById('signupform');
const $error = document.getElementById('error');

$form.addEventListener('change', update);
$form.addEventListener('input', update);

//パスワードポリシーチェックを行うメソッド
function update(e) {
  const type = e.target.type;
  const validity = e.target.validity;
  
  // フォームの子要素の取得
  const $password = $form.elements['pass'];  
  const $passwordConfirm = $form.elements['confirmpass'];
	const $submitbtn = $form.elements['submitbtn'];
	const $userid = $form.elements['userid'];
  
	var errorflg = false;

  // カスタムエラーを初期化
  $passwordConfirm.setCustomValidity('');

	//空白チェック
	if (!$password.value){

		$passwordConfirm.setCustomValidity('パスワードを入力してください');
		errorflg = true;
	}

  if ($password.value !== $passwordConfirm.value) {
    // パスワードと新しいパスワードが一致しない場合、カスタムエラーをセットする
    $passwordConfirm.setCustomValidity('パスワードが一致しません');
		errorflg = true;
  }

	//8桁、英数字混在チェック
	var result = $password.value.match(/^(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[._&])(?=.*?\d)[a-zA-Z._&\d]{8,}$/);
	if (result == null) {
    	$passwordConfirm.setCustomValidity('８文字以上の英字小文字、英字大文字、記号(._&)、数字を含めてください');
    	errorflg = true;
	}

	//エラーリストのチェック
	var errorList = ["abcd1234", "password1", "Password1", "aaaa1111", "asdf1234"];
	if (errorList.indexOf($password.value) != -1){
		$passwordConfirm.setCustomValidity('そのパスワードは使えません');
		errorflg = true;
	}

  // エラーメッセージを更新
  $error.textContent = $passwordConfirm.validationMessage;

	//登録ボタンの有効・無効化
	if(errorflg == true){
		$submitbtn.disabled = true;
	}else{
		$submitbtn.disabled = false;
	}
}
//★
</script>
