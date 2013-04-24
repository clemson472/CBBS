<?php

FOREACH($_COOKIE AS $key => $value) 
{
     SETCOOKIE($key,$value,TIME()-10000);
}

?>



<html lang="en-US">
    <head>
        <title>Logout</title>
    </head>
    <body>
	To finish logging out, close all your web browser windows.
    </body>
</html>

