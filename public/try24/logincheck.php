<?php
    //DBに接続
    try{
        $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                     PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                                     PDO::ATTR_EMULATE_PREPARES => false);
    
        $db = new PDO("mysql:host=db;dbname=laravel;charset=utf8",
                                    "laravel", "laravel", $opt);
    

        //POSTのパラメータを取り出す
        $email = filter_input(INPUT_POST, 'email');
        $pass = filter_input(INPUT_POST, 'pass');

        //Userテーブルからemailをキーに検索
        $sql = "SELECT * FROM User WHERE email = ?";
        $ps = $db->prepare($sql);
        $ps->bindValue(1, $email, PDO::PARAM_STR);
        $ps->execute();
        $result = $ps->fetch();

        //emailが存在しない場合
        if(!$result){
            die('emailが存在しません');
        }

        //パスワードのチェック
        if(!password_verify($pass, $result['password'])){
            die('パスワードが間違っています');
        }

        //ログイン成功
        session_start();

        //セッションにIDを保存
        $_SESSION['id'] = $result['id'];

        //セッションにemailを保存
        $_SESSION['post'] = $email;

        //セッションにユーザー名を保存
        $_SESSION['username'] = $result['name'];

        //mainmenu.phpにリダイレクト
        header('Location: mainmenu.php');

    }catch(PDOException $e){
        echo "Error : " . $e->getMessage() . "\n";
    }
        
?>