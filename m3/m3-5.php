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
$log = "mission_3-5.txt";

$fp = fopen($log, "a");
$data = file($log, FILE_IGNORE_NEW_LINES);

if(!empty($_POST["mode"])){
    if($_POST["mode"]=="post"){
        if(empty($_POST["edit_num"])){
            if(!empty($_POST["password"])){
                $comment_num = count($data) + 1;
                if(!empty($_POST["name"])){
                    $name = $_POST["name"];
                }else{
                    $name = "unknown";
                }
                $comment = $_POST["comment"];
                $comment_date = date("Y/m/d h:m:s");
                $password = $_POST["password"];
                $save_comment = $comment_num."<>".$name."<>".$comment."<>".$comment_date."<>".$password."<>";
                fwrite($fp, $save_comment.PHP_EOL);
                fclose($fp);
            }else{
                echo "please type your password.";
            }
        }else{
            $now_index = $_POST["edit_num"];
            $fp_re = fopen($log, "w");
            //$fp_re = fopen($log, "w");
            foreach($data as $d){
                $ds = explode("<>",$d);
                if($ds[0]!=$now_index){
                    $re_d = $ds[0]."<>".$ds[1]."<>".$ds[2]."<>".$ds[3]."<>".$ds[4]."<>";
                    //fwrite($fp_re, $d.PHP_EOL);
                }else{
                    $re_d = $ds[0]."<>".$_POST["name"]."<>".$_POST["comment"]."<>".$ds[3]."<>".$_POST["password"]."<>";
                    //fwrite($fp_re, $re_d.PHP_EOL);
                }
                fwrite($fp_re, $re_d.PHP_EOL);

            }

            fclose($fp_re);
        }
    }else if($_POST["mode"]=="delete"){
        $delete_index = $_POST["delete"];
        $box = array();
        foreach($data as $d){
            $ds = explode("<>",$d);
            array_push($box, $ds);
        }
        $auth_pass = $_POST["delete_auth_pass"];
        if($auth_pass == $box[$delete_index-1][4]){
            $fp_de = fopen($log, "w");
            foreach($box as $b){
                if($b[0]<$delete_index){
                    $re_b = $b[0]."<>".$b[1]."<>".$b[2]."<>".$b[3]."<>".$b[4]."<>";
                    fwrite($fp_de, $re_b.PHP_EOL);
                }else if($b[0]>$delete_index){
                    $re_d = ($b[0]-1)."<>".$b[1]."<>".$b[2]."<>".$b[3]."<>".$b[4]."<>";
                    fwrite($fp_de, $re_d.PHP_EOL);
                }
            }
            fclose($fp_de);
        }else{
            echo "You need a password";
        }
    }else if($_POST["mode"]=="edit"){
        $change_index = $_POST["change"];
        $box = array();
        foreach($data as $d){
            $ds = explode("<>",$d);
            array_push($box, $ds);
        }
        $change_box = $box[$change_index-1];
        $auth_pass = $_POST["change_auth_pass"];
        if($auth_pass==$change_box[4]){
            $default_comment = $change_box[2];
            $default_name = $change_box[1];
            $now_index = $_POST["edit_num"];
        }else{    
            echo "You need a password";
        }
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
        echo "<input name='password' value='変更後のパスワードを入力してください'><br>";
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