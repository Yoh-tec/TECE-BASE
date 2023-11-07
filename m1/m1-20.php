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
$str = $_POST["comment"];
echo $str
?>
</body>
</html>