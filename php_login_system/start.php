<?php include("common.php");
#Kellan Nealy
#Section AH
#Homework 5, start PHP file

#start page, prompts the user for login information, and redirects to "login.php"
session_start();
ensure_logged_out();

print_top_html();
?>

	<p>
		The best way to manage your tasks. <br />
		Never forget the cow (or anything else) again!
	</p>

	<p>
		Log in now to manage your to-do list. <br />
		If you do not have an account, one will be created for you.
	</p>

	<form id="loginform" action="login.php" method="post">
		<div><input name="name" type="text" size="8" autofocus="autofocus" /> <strong>User Name</strong></div>
		<div><input name="password" type="password" size="8" /> <strong>Password</strong></div>
		<div><input type="submit" value="Log in" /></div>
	</form>

	<p>
	<?php
	if (isset($_COOKIE["last_visit"])) { ?>
		<em>(last login from this computer was <?=$_COOKIE["last_visit"] ?>)</em>
	</p>
	<?php }

print_bottom_html();
?>