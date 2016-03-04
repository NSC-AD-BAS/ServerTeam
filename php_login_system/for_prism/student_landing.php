<?php

/*    Using "mysqli" instead of "mysql" that is obsolete.
*     Utilisation de "mysqli" � la place de "mysql" qui est obsol�te.
* Change the value of parameter 3 if you have set a password on the root userid
* Changer la valeur du 3e param�tre si vous avez mis un mot de passe � root
*/
$mysqli = new mysqli('127.0.0.1', 'prism_user', '890p890p', 'prism');

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}
echo 'Connection OK <br />';

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM internships")) {
    printf("Select returned %d internships.\n", $result->num_rows);
	foreach ($result as $row) {
		echo "Internship: <br />";
		foreach ($row as $element) {
		echo $element . "<br />";
		}
	}
    /* free result set */
    $result->close();
}
$mysqli->close();

?>
</body>
</html>