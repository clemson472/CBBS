<?php 

$rsvps = $_POST['rsvps'];

$formcontent="RSVP  : $rsvps   \n";

$recipient = "tgadde@g.clemson.edu";

$subject = "RSVP";
$mailheader = "RSVP \r\n";

mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
include ("Thanks.html");

?>



