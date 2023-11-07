<?php
$name = "mission_1-25.txt";
if(file_exists($name)){
    $lines = file($name, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        echo $line."<br>";
    }
}

$text = "Hello Python";
$fp = fopen($name,'a');
fwrite($fp, $text.PHP_EOL);
fclose($fp);
echo "書き込み成功!<br>";

if(file_exists($name)){
    $lines = file($name, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        echo $line."<br>";
    }
}

$text = "This is last";
$fp = fopen($name,'a');
fwrite($fp, $text.PHP_EOL);
fclose($fp);
echo "書き込み成功!<br>";
if(file_exists($name)){
    $lines = file($name, FILE_IGNORE_NEW_LINES);
    foreach($lines as $line){
        echo $line."<br>";
    }
}
?>