<?php
#Author: Kellan Nealy

#accepts form data from "start.php", creates or logs in the user, & redirects
#back to "start.php" or to "todolist.php", DOES NOT output any html content
session_start();
if (!is_logged_in()) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    # initial validation of login information using regex
    validate($username, $password);

    #connect to and query DB to check passed username/password
    $user_exists = false;
    $mysqli = new mysqli('127.0.0.1', 'prism_user', '890p890p', 'prism');

    if ($mysqli->connect_error) {
        die('Connect Error (' . $mysqli->connect_errno . ') '
                . $mysqli->connect_error);
    }
    
    #store user info from the query
    $user_info = array();
    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT UserId, TypeId, UserName, FirstName FROM users WHERE UserName = \"Shade777\" AND UserPassword = \"TGW1VU2E8R2BK26G5VAQG90392362K5F56L0MAZ9U9AF0X3AOU4Z03FEIJJH49XEM662K4K2\";")) {
        foreach ($result as $row) {
            foreach ($row as $element) {
                if ($element) {
                    echo $element . "<br />";
                    $user_exists = true;
                    $user_info[] = $element;
                } else {
                    $user_exists = false;
                    #to_login();
                }
            }
        }
        /* free result set */
        $result->close();
    }
    #todo: check if the user info stored correctly
    #todo: look at usertype to determine which landing page to load
    #todo: set the session variables (user_id, user_type, username, name)

    $_SESSION["username"] = $username;
    $time_expire = time() + 60*60*24*7;
    setcookie("last_visit", date("D y M d, g:i:s a", $time_expire));
    
    # can greet the student at landing page if session variables stored!!
    to_student_landing();
}

#validate uses regular expressions to validate input, redirects to start if invalid
function validate($username, $password) {
    #At least one letter or number for each regex
    $name_regex = "/^[a-z|0-9|A-Z]+$/";
    $password_regex = "/^[a-z|0-9|A-Z]+$/";
    if (preg_match($name_regex, $username) != 1 || preg_match($password_regex, $password) != 1) {
        to_login();
    } else {
        echo "VALID LOGIN INFORMATION <br />";
    }
}

#ensure_logged_in redirects the user to "start.php" if they AREN'T logged in
function is_logged_in() {
	return (isset($_SESSION["user_id"]));
}

#sends the user to "login.html" & kills the current page
function to_login() {
	header("Location:login.html");
    session_destroy();
	die();
}

#sends the user to "todolist.php" & kills the current page
function to_student_landing() {
	header("Location: student_landing.php");
	die();
}

#sends the user to "faculty_landing.php" & kills the current page
function to_faculty_landing() {
	header("Location: faculty_landing.php");
	die();
}

#sends the user to "admin_landing.php" & kills the current page
function to_admin_landing() {
	header("Location: admin_landing.php");
	die();
}
?>