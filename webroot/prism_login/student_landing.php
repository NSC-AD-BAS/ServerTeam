<!DOCTYPE html>
<head>
    <title>Welcome!</title>
</head>
<body>
<?php
#Author: Kellan Nealy

#accepts form data from ITSELF, PRINTS the listview with plain-text search
#if the form on this page for plain-text search is selected.  Otherwise
#prints the standard listview with all INTERNSHIPS.


/*    Using "mysqli" instead of "mysql" that is obsolete.
*     Utilisation de "mysqli" � la place de "mysql" qui est obsol�te.
* Change the value of parameter 3 if you have set a password on the root userid
* Changer la valeur du 3e param�tre si vous avez mis un mot de passe � root
*/
session_start();
if (is_logged_in()) {
    $mysqli = new mysqli('127.0.0.1', 'prism_user', '890p890p', 'prism');

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    echo 'Connection OK <br />';
    echo "<a href=\"logout.php\" style=\"float:right;\">L O G O U T</a>";

    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT * FROM internship_list")) {

        echo "<div id=\"list_view\">";
        echo "<p id=\"query_stats\">";
        printf("Select returned %d internships.\n", $result->num_rows);
        echo "</p><br /><ul>";
        foreach ($result as $row) {
            echo "<li>Internship: <br />";
            foreach ($row as $element) {
            echo $element . "&emsp;";
            }
            echo "</li></br >";
        }
        echo "</ul></div>";
        /* free result set */
        $result->close();
    }
    $mysqli->close();
    
} else {
    to_login();
}

#is_logged_in returns whether or not the user is logged in by checking session vars
function is_logged_in() {
	return (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"])
        && isset($_SESSION["username"]) && isset($_SESSION["name"]));
}

?>
</body>
</html>