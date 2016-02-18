<?php include("common.php");
#Author: Kellan Nealy

#logs the user out of their account, and destroys their session
session_start();
ensure_logged_in();
session_destroy();
session_regenerate_id(true);
to_start();
?>
