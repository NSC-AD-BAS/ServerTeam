<?php

function get_job_description($id) {
    $conn = db_connect();

    $sql = "SELECT Description FROM internships WHERE InternshipId = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_array()) { 
        $output[0] = $row;
    }

    $output = implode(" ",$output[0]);
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

//Handy Helper Functions
function db_connect() {
    include '../include/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = 0;
}

$desc = get_job_description($id);

?>
<tr><td>Internship Description</td></tr>
<tr><td> 
    <?php
    echo $desc;
    ?>
</td></tr>

