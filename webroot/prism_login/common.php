<?php

# call this function BEFORE you populate the list_view element
function populate_banner() {
    echo "<div id=\"banner\"> <h1 id=\"site_title\">P R I S M </h1>";
    
    #print buttons in banner
    if ($_SESSION["user_type"] == "Faculty" || $_SESSION["user_type"] == "Admin") {
        echo "<a href=\"list_view.php?nav=students\"><button id=\"studentlist\">Students</button></a>";
    }
    if ($_SESSION["user_type"] == "Admin") {
        echo "<a href=\"list_view.php?nav=users\"><button id=\"userlist\">Users</button></a>";
    }
    echo "<a href=\"list_view.php?nav=internships\"><button id=\"internshiplist\">Internships</button></a>";
    echo "<a href=\"list_view.php?nav=orgs\"><button id=\"orglist\">Organizations</button></a>";
    
    #print user details in banner
    echo "<span id=\"userinfo\"><strong>" . $_SESSION["user_type"] . "</strong>";
    echo "&emsp;" . $_SESSION["username"] . " | " . $_SESSION["name"] . "</span>";
    echo "<a id=\"logout\"href=\"logout.php\">L O G O U T</a>";
    echo "</div>";
}

#is_logged_in returns whether or not the user is logged in by checking session vars
function is_logged_in() {
	return (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"])
        && isset($_SESSION["username"]) && isset($_SESSION["name"]));
}

#sends the user to "login.html" & kills the current page
function to_login() {
	header("Location: logout.php");
	die();
}
?>