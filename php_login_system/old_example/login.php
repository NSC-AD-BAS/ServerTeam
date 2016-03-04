<?php include("common.php");
#Author: Kellan Nealy

#accepts form data from "start.php", creates or logs in the user, & redirects
#back to "start.php" or to "todolist.php", DOES NOT output any html content
session_start();
ensure_logged_out();

$name = $_POST["name"];
$password = $_POST["password"];
validate($name, $password);
$users_info = file("users.txt");
$user_exists = false;

#iterate through "users.txt" to check passed username/password
foreach ($users_info as $info) {
	list($other_name, $other_pass) = explode(":", $info);
	$other_pass = trim($other_pass);
	if ($name == $other_name) {
		if ($password == $other_pass) {
			$user_exists = true;
			break;
		} else {
			#if same username but different password, redirect
			to_start();
		}
	}
}

if (!$user_exists) {	
	file_put_contents("users.txt", $name . ":" . $password . "\n", FILE_APPEND);
}

$_SESSION["name"] = $name;
$time_expire = time() + 60*60*24*7;
setcookie("last_visit", date("D y M d, g:i:s a", $time_expire));
to_todolist();

#validate uses regular expressions to validate input, redirects to start if invalid
function validate($name, $password) {
	$name_regex = "/^[a-z][a-z|0-9]{2,7}$/";
	$password_regex = "/^[0-9].{4,10}[^0-9|^a-z|^A-Z]$/";
	if (preg_match($name_regex, $name) != 1 || preg_match($password_regex, $password) != 1) {
		to_start();
	}
}
?>
