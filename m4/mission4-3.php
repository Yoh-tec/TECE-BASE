<?php
//毎回接続は必要。
//$dsnの式の中にスペースを入れないこと！

// DB接続設定
$dsn = 'mysql:dbname=データベース名;host=localhost';
$user = 'ユーザ名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql ='SHOW TABLES';
$result = $pdo -> query($sql);
foreach ($result as $row){
    echo $row[0];
    echo '<br>';
}
echo "<hr>";

?>