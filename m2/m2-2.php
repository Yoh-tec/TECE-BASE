<form method="post">
    <input name="comment" value="コメント">
    <button type="submit">送信</button>
</form>
<?php
$filename = "mission_2-2.txt";
$fp = fopen($filename, "a");
if(!empty($_POST["comment"])){
    $comment = $_POST["comment"];
    if($comment=="勝ち"||$comment=="win"){
        fwrite($fp, $comment."<br>".PHP_EOL);
        echo "次は負けない!";
    }else if($comment=="負け"||$comment=="lose"){
        fwrite($fp, $comment."<br>".PHP_EOL);
        echo "残念!次頑張ろう！";
    }else{
        fwrite($fp, $comment."<br>".PHP_EOL);
        echo $comment."を受け付けました";
    }
    
}?>