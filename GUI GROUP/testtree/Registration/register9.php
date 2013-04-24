<html>
    
    <head>
        <base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
		  <link rel="stylesheet media="screen" href="resources/css/style.css" type"text/css"/>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>User Registration</title>
    </head>
    
    <body>
    	  <?php include("../resources/templates/banner_nolog.html"); ?>
        <h4>Invite a Mentor</h4>
        <p>Select Mentor Location
                <select>
                    <option value="all">Select All</option>
                    <option value="location 1">Location 1</option>
                    <option value="location 2">Location 2</option>
                </select>
                <input type="button" value="Go" /> 
        </p>
        <table border='1'>
            <tr>
                <th>Choose</th>
                <th>Full Name</th>
                <th>Compatibility</th>
                <th>Title</th>
                <th>Major</th>
                <th>Organization</th>
                <th>Location/Home State</th>
            </tr>
        </table>
        <p>
            <input type="button" value="Show Me 5 New Mentors" /> 
        </p>
        <p><br/><a href="Registration/register8.php">Previous</a></p>
        <p><a href="Registration/register10.php">Next</a></p>
    </body>
    
</html>