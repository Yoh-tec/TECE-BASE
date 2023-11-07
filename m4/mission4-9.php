<?php

    // DB接続設定
    $dsn = 'mysql:dbname=tb250444db;host=localhost';
    $user = 'tb-250444';
    $password = '25aAWThVku';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //テーブルを削除する
    $sql = 'DROP TABLE tbtest';
    $stmt = $pdo->query($sql);

    //テーブルの表示を行う。
    $sql ='SHOW CREATE TABLE tbtest';
    $result = $pdo -> query($sql);
    foreach ($result as $row){
        echo $row[1];
    }
    echo "<hr>";
?>