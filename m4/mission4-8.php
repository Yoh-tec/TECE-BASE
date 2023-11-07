<?php
    // DB接続設定
    $dsn = 'mysql:dbname=tb250444db;host=localhost';
    $user = 'tb-250444';
    $password = '25aAWThVku';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    $id = 2;
    $sql = 'delete from tbtest where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    //表示するSQL
    $sql = 'SELECT * FROM tbtest';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].'<br>';
    echo "<hr>";
    }
?>