<html>
<head>
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
<?php
    $myfilename = "event_des.html";
    if(file_exists($myfilename)){
      echo file_get_contents($myfilename);
    }
?>
<form method="post" action="rsvp.php" name="rsvp" id="rsvp-form">
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

</body>
</html>
