<!DOCTYPE html>
<head>
    <title>Welcome!</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
#Author: Kellan Nealy

#accepts form data from ITSELF, PRINTS the listview with plain-text search
#if the form on this page for plain-text search is selected.  Otherwise
#prints the standard listview with all STUDENTS.


/*    Using "mysqli" instead of "mysql" that is obsolete.
*     Utilisation de "mysqli" � la place de "mysql" qui est obsol�te.
* Change the value of parameter 3 if you have set a password on the root userid
* Changer la valeur du 3e param�tre si vous avez mis un mot de passe � root
*/
session_start();
if (is_logged_in()) {
    $mysqli = get_db_connection();
    
    echo "<div id=\"banner\"> <h1>P R I S M </h1> <span id=\"userinfo\">" . $_SESSION["username"] . " | " . $_SESSION["name"] . "<a id=\"logout\"href=\"logout.php\">L O G O U T</a></span></div>";

    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT * FROM student_list")) {

        echo "<div id=\"list_view\">";
        echo "<p id=\"query_stats\">";
        printf("Select returned %d students.\n", $result->num_rows);
        echo "</p><br /><ul>";
        foreach ($result as $row) {
            echo "<li>Student: <br />";
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
    
    echo "<button action=\"logout.php\" value=\"L O G O U T\" \>";
} else {
    to_login();
}

#is_logged_in returns whether or not the user is logged in by checking session vars
function is_logged_in() {
	return (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"])
        && isset($_SESSION["username"]) && isset($_SESSION["name"]));
}

#uses internally stored credentials to create and return DB connection
#as a Mysqli PHP object.  For use on prism.tekbot.net unless you hard-code.
function get_db_connection() {
    include '../../include/db_connect.php';
    //create and verify connection
    $mysqli_obj = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli_obj->connect_error) {
        die('DB Connection Error: ' . $mysqli_obj->connect_errno . $mysqli_obj->connect_error);
    }
    return $mysqli_obj;
}
?>
</body>
</html>
