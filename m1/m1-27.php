<form method="post">
    <input name="num">
    <button type="submit">送信</button>
</form>
<?php
$name = "mission_1-27.txt";
if(!empty($_POST["num"])){
    $num = $_POST["num"];
    $fp = fopen($name,'a');
    fwrite($fp, $num.PHP_EOL);
    fclose($fp);
    echo "書き込み成功!<br>";
}
if(file_exists($name)){
    $lines = file($name, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        $n="";
        if($line%3==0){
            $n = $n. "Fizz";
        }
        if($line%5==0){
            $n = $n . "Buzz";

        }
        if(empty($n)){
            $n = $line;
        }
        echo $n." ";
    }
}
?>