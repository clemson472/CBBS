<html>
<head>
<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
<link rel="stylesheet media="screen" href="resources/css/style.css" type"text/css"/>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    $('form').submit(function() {
	    alert("hello");
        var data = $(this).serialize();

        $.post("rsvp-mailer.php", data, function() {
            $('#rsvp-wrapper').html("<div class='success'></div>");  
            $('.success').html("<p class='italic'>Thanks!</p>")   
            .hide()  
            .fadeIn(500, function() {  
                $('.success');  
            });  
        }

    return false;
    }
</script>
</head>
<body>

<?php include("../resources/templates/banner_log.html"); ?>
<?php include("../resources/templates/navbar_user.html"); ?>

<?php
    $myfilename = "event_des.html";
    if(file_exists($myfilename)){
      echo file_get_contents($myfilename);
    }
?>
<form method="post" action="user/rsvp.php" name="rsvp" id="rsvp-form">
<fieldset>
                <legend>RSVP</legend>

                    <ol>
                        <li>
                            <input id="accepts1" class="rsvps" name="rsvps" type="radio" value="Graciously_Accepts" />
                            <label for="accepts1">Graciously Accepts</label>
                        </li>
                        <li>
                            <input id="declines1" class="rsvps" name="rsvps" type="radio" value="Regretfully_Declines" />
                            <label for="declines1">Regretfully Declines</label>
                        </li>
                        <li>
                            <input id="accepts2" class="rsvps" name="rsvps" type="radio" value="Regretfully_Accepts" />
                            <label for="accepts2">Regretfully Accepts</label>
                        </li>
                        <li>
                            <input id="declines2" class="rsvps" name="rsvps" type="radio" value="Graciously_Declines" />
                            <label for="declines2">Graciously Declines</label>
                        </li>
                    </ol>
            </fieldset>
<div id="rsvp-wrapper">
    <fieldset>
     <button class="button" type="submit" value="send">RSVP!</button>
</fieldset>
</form>

<?php include("rsvpscript.php"); ?>

</body>
</html>
