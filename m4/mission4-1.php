<?php
//毎回接続は必要。
//$dsnの式の中にスペースを入れないこと！

// ・データベース名：tb250444db
// ・ユーザー名：tb-250444
// ・パスワード：25aAWThVku

// DB接続設定
$dsn = 'mysql:dbname=tb250444db;host=localhost';
$user = 'tb-250444';
$password = '25aAWThVku';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
?>