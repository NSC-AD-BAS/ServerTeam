<?php
//Include library files outside of webroot
include '../include/db_connect.php';
//include '../include/other_stuff_here'

//create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if (!$conn) {
    die("Connect Failed: " . mysqli_connect_error());
}

$sql = "SELECT NumOfEmployees, OrganizationName FROM organizations";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "Org Name: " . $row["OrganizationName"]. " - Num Employees: " .$row["NumOfEmployees"]. "<br>";
    }
} else {
    echo "0 results";
}

mysqli_close($conn);
?>
