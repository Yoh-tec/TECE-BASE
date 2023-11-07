<?php
    // DB接続設定
    $dsn = 'mysql:dbname=tb250444db;host=localhost';
    $user = 'tb-250444';
    $password = '25aAWThVku';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

    //bindParamの引数（:nameなど）は4-2でどんな名前のカラムを設定したかで変える必要がある。
    $id = 1; //変更する投稿番号
    $name = "ryo";
    $comment = "ずっと真夜中でいいのに"; //変更したい名前、変更したいコメントは自分で決めること
    $sql = 'UPDATE tbtest SET name=:name,comment=:comment WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    //表示させるSQL
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