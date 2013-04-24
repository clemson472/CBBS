<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<title>TinyMCE Test</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8"/>

<!-- OF COURSE YOU NEED TO ADAPT NEXT LINE TO YOUR tiny_mce.js PATH -->
<script type="text/javascript" src="../jscripts/tiny_mce/tiny_mce.js"></script>

<script type="text/javascript">
tinyMCE.init({
        theme : "advanced",
        mode : "textareas",
        plugins : "fullpage",
        theme_advanced_buttons3_add : "fullpage"
});
</script>

</head>
<body>
<!-- OF COURSE YOU NEED TO ADAPT ACTION TO WHAT PAGE YOU WANT TO LOAD WHEN HITTING "SAVE" -->
<form method="post" action="show.php">
        <p>     
                <textarea name="content" cols="50" rows="15">


		<?php

		$myFile = ".htaccess";
		$fh = fopen($myFile, 'r') or die("can't open file");
		$contents = fread($fh, filesize($myFile));
		echo $contents;
		fclose($fh);


		?>


		</textarea>
                <input type="submit" value="Save" />
        </p>
</form>

</body>
</html>
