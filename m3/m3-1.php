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
    <input name="name" value="名前を入力">
    <input name="comment" value="コメント">
    <button type="submit">送信</button>
</form>
<?php
$log = "mission_3-1.txt";

$fp = fopen($log, "a");
$data = file($log, FILE_IGNORE_NEW_LINES);

if(!empty($_POST["comment"])){
    $comment_num = count($data) + 1;
    if(!empty($_POST["name"])){
        $name = $_POST["name"];
    }else{
        $name = "unknown";
    }
    $comment = $_POST["comment"];
    $comment_date = date("Y/m/d h:m:s");
    
    $save_comment = $comment_num."<>".$name."<>".$comment."<>".$comment_date;
    fwrite($fp, $save_comment.PHP_EOL);
    
    echo "-コメント欄-<br>";
    $data = file($log, FILE_IGNORE_NEW_LINES);
    
    foreach($data as $d){
        echo $d."<br>";
    }
    fclose($fp);

    }else{
        echo "コメントしてください。<br>";
    }
?>