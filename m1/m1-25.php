<?php

$name = "mission_1-25.txt";

$text = "Hello World";
$fp = fopen($name,'a');
fwrite($fp, $text.PHP_EOL);
fclose($fp);
echo "書き込み成功!<br>";
/*
$text = "Hello php";
$fp = fopen($name,'w');
fwrite($fp, $text.PHP_EOL);
fclose($fp);
echo "書き込み成功!<br>";*/
?>