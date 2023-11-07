<form method="post">
    <input name="comment" value="コメント">
    <button type="submit">送信</button>
</form>
<?php
if(!empty($_POST["comment"])){
    $comment = $_POST["comment"];
    echo $comment."を受け付けました";
}?>