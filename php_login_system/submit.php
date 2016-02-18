<?php include("common.php");
#Kellan Nealy
#Section AH
#Homework 5, submit PHP file

#handles all of the form/file processing for the updates made to the user's todo list,
#always reroutes to "todolist.php" and DOES NOT output any html
session_start();
ensure_logged_in();

$name = $_SESSION["name"];
$filename = "todo_{$name}.txt";
validate_params();

$action = $_POST["action"];

#since query params are set, validate index & proceed to processing
if ($action == "delete") {
	$todo_list = file($filename);
	$max_index = count($todo_list);
	$index_to_delete = validate_index($_POST["index"], $max_index);
	
	#remove the item by iterating & ignoring POST index
	$updated_list = "";
	for ($i = 0; $i <= $max_index; $i++) {
		if ($i != $index_to_delete) {
			$updated_list .= $todo_list[$i];
		}
	}
	file_put_contents($filename, $updated_list);

} else if ($action == "add") {
	#using FILE_APPEND is good for creating the new file too!
	$item = $_POST["item"];
	file_put_contents($filename, $item . "\n", FILE_APPEND);
}
to_todolist();

#validate_params kills this page if any of the query parameters aren't set
function validate_params() {
	if (!isset($_POST["action"]) || ($_POST["action"] == "add" && !isset($_POST["item"]))
	|| ($_POST["action"] == "delete" && !isset($_POST["index"]))){
		die("Invalid parameters passed!");
	}
}

#validate_index returns index if valid, kills the page otherwise
function validate_index($index, $max_index) {
	if (preg_match("/^\d+$/", $index) == 1 && $index >= 0 && $index <= $max_index) {
		return $index;
	}
	die("Invalid parameters passed!");
}
?>
