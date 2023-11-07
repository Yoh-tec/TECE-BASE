<style>
    .html{
        margin:1100px;
    }
    .name{
        font-size:15px;
    }
    .log{
        font-size:10px;
        color:gray;
    }
    .comment{
        font-size:20px;
    }
</style>
<?php

// DB接続設定
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

//テーブルmission5の作成SQL
/*
id : 投稿番号
name : ユーザ名
comment : コメント
time : 投稿日時 
password : パスワード
*/
$sql_create = "CREATE TABLE IF NOT EXISTS mission5"
." ("
. "id INT AUTO_INCREMENT PRIMARY KEY,"
. "name CHAR(32),"
. "comment TEXT,"
. "time CHAR(32),"
. "password CHAR(32)"
.");";
$stmt = $pdo->query($sql_create);

//データの抽出 $resultsに行を1要素とした配列を格納SQL
$sql_Get = 'SELECT * FROM mission5'; 
$stmt = $pdo->query($sql_Get);
$results = $stmt->fetchAll(); 

if(!empty($_POST["mode"])){
    if($_POST["mode"]=="post"){
        if(empty($_POST["edit_num"])){

            //新規作成
            if(!empty($_POST["password"])){
                if(!empty($_POST["name"])){
                    $name = $_POST["name"];
                }else{
                    $name = "unknown";
                }
                $comment = $_POST["comment"];
                $time = date("Y/m/d h:m:s");
                $password = $_POST["password"];

                //データの挿入SQL
                $sql_insert = "INSERT INTO mission5 (name, comment, time, password) VALUES (:name, :comment, :time, :password)";
                $stmt = $pdo->prepare($sql_insert);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
                $stmt->bindParam(':time', $time, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->execute();

            }else{
                echo "please type your password.";
            }
        }else{

            //編集
            $id = $_POST["edit_num"];
            $name = $_POST["name"];
            $comment = $_POST["comment"];
            $time = $results[$id-1]["time"];
            $password = $_POST["password_new"];
            
            //更新SQL
            $sql_update = "UPDATE mission5 SET name=:name,comment=:comment,time=:time,password=:password WHERE id=:id";
            $stmt = $pdo->prepare($sql_update);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
            $stmt->bindParam(':time', $time, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }else if($_POST["mode"]=="delete"){
        
        //削除
        $delete_index = $_POST["delete"];
        $auth_pass = $_POST["delete_auth_pass"];
        if($auth_pass == $results[$delete_index-1]["password"]){
            $sql_drop = 'DROP TABLE mission5';
            $stmt = $pdo->query($sql_drop);
            $stmt = $pdo->query($sql_create);
            foreach($results as $b){
                if($b["id"]!=$delete_index){
                    $sql_insert = "INSERT INTO mission5 (name, comment, time, password) VALUES (:name, :comment, :time, :password)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $b["name"], PDO::PARAM_STR);
                    $stmt->bindParam(':comment', $b["comment"], PDO::PARAM_STR);
                    $stmt->bindParam(':time', $b["time"], PDO::PARAM_STR);
                    $stmt->bindParam(':password', $b["password"], PDO::PARAM_STR);
                    $stmt->execute();
                }
            }
        }else{
            echo "You need a password";
        }
    }else if($_POST["mode"]=="edit"){

        //編集パスワードチェック
        $change_index = $_POST["change"];
        $auth_pass = $_POST["change_auth_pass"];
        if($auth_pass==$results[$change_index-1]["password"]){
            $default_comment = $results[$change_index-1]["comment"];
            $default_name = $results[$change_index-1]["name"];
            $now_index = $_POST["edit_num"];
        }else{    
            echo "You need a password";
        }
    }else if($_POST["mode"]=="reset"){
            //データベースのリセット
            //dropSQL
            $sql_drop = 'DROP TABLE mission5';
            $stmt = $pdo->query($sql_drop);
            $stmt = $pdo->query($sql_create);
    }
}
?>
<h1>mission3-5</h1><hr>
<form method="post">
    <h2>入力フォーム</h2>
    <?php 

    if(isset($default_name)){
        echo "<input name='name' value=$default_name><br>";
        echo "<input name='comment' value=$default_comment><br>";
    }else{
        echo "<input name='name' value='名前'><br>";
        echo "<input name='comment' value='コメント'><br>";
    }
    if(isset($change_index)){
        echo "<input name='edit_num' type='hidden' value=$change_index>";
        echo "<input name='password_new' value='変更後のパスワードを入力してください'><br>";
    }else{
        echo "<input name='edit_num' type='hidden'>";
        echo "<input name='password' value='パスワードを入力してください'><br>";

    }?>
    <button type="submit" name="mode" value="post">送信</button>

<hr>
    <h2>削除フォーム</h2>
    削除対象番号 : <input name="delete">
    パスワード：<input name="delete_auth_pass">
    <button type="submit" name="mode" value="delete">削除</button>
    
<hr>
    <h2>編集フォーム</h2>
    編集対象番号 : <input name="change">
    パスワード : <input name="change_auth_pass">
    <button type="submit" name="mode" value="edit">編集</button>

<hr>
    <button type="submit" name="mode" value="reset">リセット</button>
</form>

<?php
echo "-コメント欄-<br>";

//データベース取得SQL
$stmt = $pdo->query($sql_Get);
$results = $stmt->fetchAll(); 

if(!empty($results)){
    foreach($results as $d){
         echo "投稿番号: ".$d["id"]."<br>";
         echo "名前: ".$d["name"]."<br>";
         echo "コメント: ".$d["comment"]."<br>";
         echo "投稿日時: ".$d["time"]."<br>";
         echo "<br>";
    }
}else{
         echo "コメントしてください。<br>";
}?>