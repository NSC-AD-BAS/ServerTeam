<?php include("common.php");
#Kellan Nealy
#Section AH
#Homework 5, logout PHP file

#logs the user out of their account, and destroys their session
session_start();
ensure_logged_in();
session_destroy();
session_regenerate_id(true);
to_start();
?>
