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
#prints the standard listview with all INTERNSHIPS.


#Handles the session, and only operates on an active session
#prints the correct listview based on the user_type session variable
session_start();
if (is_logged_in()) {
    echo "<div id=\"banner\"> <h1>P R I S M </h1>";
    #print buttons in banner
    if ($_SESSION["user_type"] == "Faculty" || $_SESSION["user_type"] == "Admin") {
        echo "<button id=\"studentlist\">Students</button>";
    }
    echo "<button id=\"internshiplist\">Internships</button>";
    echo "<button id=\"orglist\">Organizations</button>";
    
    #print user details in banner
    echo "<span id=\"userinfo\">" . $_SESSION["user_type"] . "&emsp;" . $_SESSION["username"] . " | " . $_SESSION["name"];
    echo "</span></div>";
    echo "<a id=\"logout\"href=\"logout.php\">L O G O U T</a>";
    
    if ($_SESSION["user_type"] == "Student") {
        populate_internships();
    } else if ($_SESSION["user_type"] == "Faculty") {
        populate_students();
    } else if($_SESSION["user_type"] == "Admin") {
        populate_users();
    }
    
} else {
    to_login();
}

function populate_internships() {
    $mysqli = get_db_connection();
    
    /* Select queries return a resultset */
    # first two values in internship are internship_id and org_id
    # slots available, date posted, start date printed on 2nd line of element
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
}

function populate_users() {
    $mysqli = get_db_connection();
    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT * FROM user_list")) {

        echo "<div id=\"list_view\">";
        echo "<p id=\"query_stats\">";
        printf("Select returned %d users.\n", $result->num_rows);
        echo "</p><br /><ul>";
        foreach ($result as $row) {
            echo "<li>User: <br />";
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
}

function populate_students() {
    $mysqli = get_db_connection();
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
