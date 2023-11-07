<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
</head>
<body>
<form method="post">
    <input type="text" name="comment">
    <button type="submut">送信</button>
</form>
<?php
    $num = $_POST["comment"];
    $set="";
    if($num%3==0){
        $set=$set."Fizz";
    }
    if($num%5==0){
        $set=$set."Buzz";
    }
    if($set==""){
        $set = $i;
    }
    echo $set;
?>
</body>
</html>
