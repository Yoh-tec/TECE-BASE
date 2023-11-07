<form method="post">
    <input name="comment" value="コメント">
    <button type="submit">送信</button>
</form>
<?php
$filename = "mission_2-3.txt";
$fp = fopen($filename, "a");
if(!empty($_POST["comment"])){
    $comment = $_POST["comment"];
    fwrite($fp, $comment."\n".PHP_EOL);
    echo $comment."を受け付けました";
    }
?>