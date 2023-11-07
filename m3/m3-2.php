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
$log = "mission_3-2.txt";

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
    fclose($fp);
}

$data = file($log, FILE_IGNORE_NEW_LINES);
echo "-コメント欄-<br>";
if(count($data)!=0){
    foreach($data as $d){
         $ds = explode("<>",$d);
         echo "投稿番号: ".$ds[0]."<br>";
         echo "名前: ".$ds[1]."<br>";
         echo "コメント: ".$ds[2]."<br>";
         echo "投稿日時: ".$ds[3]."<br>";
         echo "<br>";
    }
}else{
         echo "コメントしてください。<br>";
}
?>