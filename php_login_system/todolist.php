<?php include("common.php");
#Author: Kellan Nealy

#front-end html-outputting page that prompts the user to update their todo list
#reroutes to "submit.php" to process updates, and to "logout.php" to end session
session_start();
ensure_logged_in();
$name = $_SESSION["name"];

print_top_html();
?>

	<h2>To-Do List For <?=$name ?></h2>

	<ul id="todolist">
	
		<?php #if this user already has a todo list, iterate/print with htmlspecialchars
		$filename = "todo_{$name}.txt";
		if (file_exists($filename)) {
			$todo_list = file($filename);
			for($i = 0; $i < count($todo_list); $i++) { 
				$item = htmlspecialchars($todo_list[$i]); ?>
			
				<li>
					<form action="submit.php" method="post">
						<input type="hidden" name="action" value="delete" />
						<input type="hidden" name="index" value="<?=$i ?>" />
						<input type="submit" value="Delete" />
					</form>
					<?=$item ?>
				</li>
			
			<?php }
		}?>

		<li>
			<form action="submit.php" method="post">
				<input type="hidden" name="action" value="add" />
				<input name="item" type="text" size="25" autofocus="autofocus" />
				<input type="submit" value="Add" />
			</form>
		</li>
	</ul>

	<div>
		<a href="logout.php"><strong>Log Out</strong></a>
		<em>(logged in since <?=$_COOKIE["last_visit"] ?>)</em>
	</div>
	
<?php
print_bottom_html();
?>
