<?php
for($i=0;$i<=99;$i=$i+1){
    $set="";
    if($i%3==0){
        $set=$set."Fizz";
    }
    if($i%5==0){
        $set=$set."Buzz";
    }
    if($set==""){
        $set = $i;
    }
    echo $set ."<br>";
}?>