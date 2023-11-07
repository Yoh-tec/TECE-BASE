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



$log = "mission_3-4.txt";

$fp = fopen($log, "a");
$data = file($log, FILE_IGNORE_NEW_LINES);

if(!empty($_POST["mode"])){
    if($_POST["mode"]=="post"){
        if(empty($_POST["edit_num"])){
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
        }else{
            $now_index = $_POST["edit_num"];
            $fp_re = fopen($log, "w");
            foreach($data as $d){
                $ds = explode("<>",$d);
                if($ds[0]!=$now_index){
                    fwrite($fp_re, $d.PHP_EOL);
                }else{
                    $re_d = $ds[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$ds[3];
                    fwrite($fp_re, $re_d.PHP_EOL);
                }
        }
        fclose($fp_re);
        }
    }else if(!empty($_POST["delete"])){
        if($_POST["mode"]=="delete"){
        $fp_de = fopen($log, "w");
        $delete_index = $_POST["delete"];
        foreach($data as $d){
            $ds = explode("<>",$d);
            if($ds[0]<$delete_index){
                fwrite($fp_de, $d.PHP_EOL);
            }else if($ds[0]>$delete_index){
                $re_d = ($ds[0]-1)."<>".$ds[1]."<>".$ds[2]."<>".$ds[3];
                fwrite($fp_de, $re_d.PHP_EOL);
            }}}
        fclose($fp_de);
    }else if(!empty($_POST["change"])){
        if($_POST["mode"]=="edit"){
        $change_index = $_POST["change"];
        foreach($data as $d){
            $ds = explode("<>",$d);
            if($ds[0]==$change_index){
                $default_comment = $ds[2];
                $default_name = $ds[1];
        }
        /*
        $fp_re = fopen($log, "w");
        $change_index = $_POST["change"];
        foreach($data as $d){
            $ds = explode("<>",$d);
            if($ds[0]!=$change_index){
                fwrite($fp_re, $d.PHP_EOL);
            }else{
                $re_d = $ds[0]."<>".$ds[1]."<>".$_POST["comment"]."<>".$ds[3];
                fwrite($fp_re, $re_d.PHP_EOL);
            }
        }
        fclose($fp_re);*/
    }}}}

?>
<h1>mission3-4</h1><hr>
<form method='post'>
<h2>入力フォーム</h2>

<?php
if(isset($change_index)){
    echo "<input name='edit_num' type='hidden' value=$change_index>";
}else{
    echo "<input name='edit_num' type='hidden'>";
}
if(!isset($default_name)){
    echo "<input name='name' value='名前'><br>";
    echo "<input name='comment' value='コメント'><br>";
}

if(isset($change_index)){
    echo "<input name='edit_num' type='hidden' value=$change_index>";
}else{
    echo "<input name='edit_num' type='hidden'>";
}
if(isset($default_name)){
    echo "<input name='name' value=$default_name><br>";
    echo "<input name='comment' value=$default_comment><br>";
}

?>
<button type='submit' name='mode' value='post'>送信</button>
<hr>
<h2>削除フォーム</h2>
削除対象番号 : <input name='delete'>
<button type='submit' name='mode' value='delete'>削除</button>

<hr>
<h2>編集フォーム</h2>
編集対象番号 : <input name='change'>
<button type='submit' name='mode' value='edit'>編集</button>
</form>


<?php 
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
}?>
