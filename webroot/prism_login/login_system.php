<?php
#Author: Kellan Nealy

# accepts POST form data from "login.html", logs in the user, & redirects
# to "student_landing.php", "faculty_landing.php", or "admin_landing.php"
# DOES NOT output any html content

#IMPORTANT: If you try to login to an existing session it will send you
#back to login after destroying that session.  No errors passed yet

session_start();
if (!is_logged_in()) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    # initial validation of login information using regex
    validate($username, $password);
    #connect to and query DB to check passed username/password
    $mysqli = get_db_connection();
    $user_exists = false;
    echo "creds: " . $username . " " . $password; 
    #store user info from the query
    $user_info = array();
    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT UserId, TypeId, UserName, FirstName FROM users WHERE UserName = \"$username\" AND UserPassword = \"$password\";")) {
        foreach ($result as $row) {
            foreach ($row as $element) {
                if ($element) {
                    echo $element . "<br />";
                    $user_exists = true;
                    $user_info[] = $element;
                }
            }
        }
        /* close result set */
        $result->close();
    } else {
            $user_exists = false;
            echo "user credentials query failed";
            #to_login();
    }
    echo $user_exists;
    #print this for debugging
    print_r($user_info);
    #todo: check if the user info stored correctly
    #todo: look at usertype to determine which landing page to load
    #todo: set the session variables (user_id, user_type, username, name)

    $_SESSION["user_id"] = $user_info[0];
    $type_id = $user_info[1];
    $_SESSION["user_type"] = get_user_type($type_id);
    $_SESSION["username"] = $user_info[2];
    $_SESSION["name"] = $user_info[3];
    #store cookie so we can see time of last visit! this is an extra feature
    $time_expire = time() + 60*60*24*7;
    setcookie("last_visit", date("D y M d, g:i:s a", $time_expire));
    
    # can greet the user at landing page if session variables stored!!
    # The following code navigates to the proper landing page
    /*
    if ($type_id == 1) {
        to_student_landing();
    } else if ($type_id == 2) {
        to_admin_landing();
    } else if ($type_id == 3) {
        to_faculty_landing();
    }
    */
    
} else {
    # user already has a session, so lets assume they
    # want to end it and login again
    session_destroy();
    session_regenerate_id(true);
    to_login();
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

#Gets the user_type as a string from the typeIDs stored in the DB
function get_user_type($TypeId) {
    if ($TypeId == 1) {
        return "Student";
    } else if ($TypeId == 2) {
        return "Admin";
    } else if ($TypeId == 3) {
        return "Faculty";
    } else {
        return "";
    }
}

#is_logged_in returns whether or not the user is logged in by checking session vars
function is_logged_in() {
	return (isset($_SESSION["user_id"]) && isset($_SESSION["user_type"])
        && isset($_SESSION["username"]) && isset($_SESSION["name"]));
}

#sends the user to "login.html" & kills the current page
function to_login() {
	header("Location: login.html");
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
