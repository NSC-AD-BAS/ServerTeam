<?php

function get_all_internships_detail() {
    //Include library files outside of webroot
    include '../include/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    } 

    $sql = "SELECT * FROM internship_detail LIMIT 10";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) { 
        $output[] = $row;
    }

    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_all_internships_formatted($data) {
    echo "<table>";
        echo "<tr><td>Title</td><td>Organization</td><td>Address 1</td><td>Address 2</td><td>City</td><td>State</td></tr>";
        foreach ($data as $d) {
            echo "<tr>";
            echo "<td><a href=#" . $d['InternshipId']. ">" . $d['Position Title'] . "</td><td>" . $d['Organization'] . "</td><td>" . $d['Address 1'] . "</td><td>" . $d['Address 2'] . "</td><td>" . $d['City']. "</td><td>" . $d['State'] . "</td>";
            echo "</tr>";
        }
    echo "</table>";
}


get_all_internships_formatted(get_all_internships_detail());

?>
