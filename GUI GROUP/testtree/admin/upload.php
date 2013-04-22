<html>
<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
<link rel="stylesheet media="screen" href="resources/style.css" type"text/css"/>


<body>

<?php include("../resources/templates/banner_log.html"); ?>
<?php include("../resources/templates/navbar_admin.html"); ?>

"content goes here!"
<form action="resources/scripts/php/docUpload.php" method="post" enctype="multipart/form-data" name="docuploadform">
        <input type="hidden" name="MAX_FILE_SIZE" value="15000000">
        <input name="doc" type="file" id="doc" size="50">
	<input name="upload" type="submit" id="upload" value="Upload Document!">
</form>


</body>

</html>