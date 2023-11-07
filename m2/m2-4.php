<form method="post">
    <input name="comment" value="コメント">
    <button type="submit">送信</button>
</form>
<?php
$filename = "mission_2-4.txt";

$fp = fopen($filename, "a");

if(!empty($_POST["comment"])){
    $comment = $_POST["comment"];
    fwrite($fp, $comment.PHP_EOL);

    $comments = file($filename, FILE_IGNORE_NEW_LINES);
    echo "-コメント欄-<br>";
    foreach($comments as $comment){
        echo $comment."<br>";
    }
    fclose($fp);
    }
?>