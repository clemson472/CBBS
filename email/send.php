<?php
	$to       = $_POST["as_values_recipient"];
	$subject  = $_POST["title"];
	$message  = $_POST["content"];
	$headers  = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: ' . 'test@clemson.edu' . "\r\n";
	$headers .= 'Reply-To' . 'no-reply@clemson.edu' . "\r\n";
	$headers .= 'Cc: ' . $_POST["cc"] . "\r\n";
	$headers .= 'Bcc: ' . $_POST["bcc"] . "\r\n";

	echo mail($to, $subject, $message, $headers);
?>
