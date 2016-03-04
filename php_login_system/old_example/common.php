<?php
#Author: Kellan Nealy

#prints common html for other pages & can redirect/kill pages
#print_top_html prints the common top html content for pages
function print_top_html() { ?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8" />
			<title>Remember the Cow</title>
			<link href="https://webster.cs.washington.edu/css/cow-provided.css" type="text/css" rel="stylesheet" />
			<link href="cow.css" type="text/css" rel="stylesheet" />
			<link href="https://webster.cs.washington.edu/images/todolist/favicon.ico" type="image/ico" rel="shortcut icon" />
		</head>

		<body>
			<div class="headfoot">
				<h1>
					<img src="https://webster.cs.washington.edu/images/todolist/logo.gif" alt="logo" />
					Remember<br />the Cow
				</h1>
			</div>

			<div id="main">
<?php }

#print_bottom_html prints the common bottom html content for pages
function print_bottom_html() { ?>
			</div>

			<div class="headfoot">
				<p>
					&quot;Remember The Cow is nice, but it's a total copy of another site.&quot; - PCWorld<br />
					All pages and content &copy; Copyright CowPie Inc.
				</p>

				<div id="w3c">
					<a href="https://webster.cs.washington.edu/validate-html.php">
						<img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML" /></a>
					<a href="https://webster.cs.washington.edu/validate-css.php">
						<img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
				</div>
			</div>
		</body>
	</html>
<?php } 

#ensure_logged_in redirects the user to "start.php" if they AREN'T logged in
function ensure_logged_in() {
	if (!isset($_SESSION["name"])) {
		to_start();
	}
}

#ensure_logged_out redirects the user to "todolist.php" if they ARE logged in
function ensure_logged_out() {
	if (isset($_SESSION["name"])) {
		to_todolist();
	}
}

#to_start sends the user to "start.php" & kills the current page
function to_start() {
	header("Location: start.php");
	die();
}

#to_todolist sends the user to "todolist.php" & kills the current page
function to_todolist() {
	header("Location: todolist.php");
	die();
}
?>
