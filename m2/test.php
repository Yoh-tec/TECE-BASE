<style>
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
<form method="post">
    <h2>0ちゃんねる</h2>
    <input name="name" value="名前を入力">
    <input name="comment" value="コメント">
    <button type="submit">送信</button>
</form>
<?php
$comment_data = "comments.txt";
$log_data = "log.txt";
$name_data = "name.txt";

$fp1 = fopen($comment_data, "a");
$fp2 = fopen($log_data, "a");
$fp3 = fopen($name_data, "a");

if(!empty($_POST["comment"])){
    fwrite($fp1, $_POST["comment"].PHP_EOL);
    fwrite($fp2, date("m/d h:m").PHP_EOL);
    if(!empty($_POST["name"])){
        fwrite($fp3, $_POST["name"].PHP_EOL);
    }else{
        fwrite($fp3, "名無し".PHP_EOL);
    }

    $comments = file($comment_data, FILE_IGNORE_NEW_LINES);
    $log = file($log_data, FILE_IGNORE_NEW_LINES);
    $names = file($name_data, FILE_IGNORE_NEW_LINES);
    $comments = array_reverse($comments);
    $log = array_reverse($log);
    $names = array_reverse($names);

    $size = count($comments);
    
    echo "-コメント欄-<br>";
    for($i=0;$i<$size;$i=$i+1){
        echo "<span class='name'>".$names[$i]."さん</span> 　<span class='log'>".$log[$i]."</span><br><hr>";
        echo "<sapn class='comment'>".$comments[$i]."</span><br><br>";
    }
    fclose($fp1);
    fclose($fp2);
    fclose($fp3);

    }else{
        echo "コメントしてください。<br>";
    }
?>