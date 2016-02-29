<?php

function get_all_internships_detail() {
    $conn = db_connect();

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

function get_all_internships_formatted($data) {
    //Get the Job Description of the selected Internship 
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = $data[0]['InternshipId'];
    }
    $desc = get_job_description($id);

    //Display the Internship Table
    echo "<head><link rel=\"stylesheet\" type=\"text/css\" href=\"style.css\"></head>";
    echo "<table>";
        echo "<tr><td>Title</td><td>Organization</td><td>Address 1</td><td>Address 2</td><td>City</td><td>State</td></tr>";
        foreach ($data as $d) {
            echo "<tr>";
            echo "<td><a href=?id=" . $d['InternshipId']. ">" . $d['Position Title'] . "</td><td>" . $d['Organization'] . "</td><td>" . $d['Address 1'] . "</td><td>" . $d['Address 2'] . "</td><td>" . $d['City']. "</td><td>" . $d['State'] . "</td>";
            echo "</tr>";
        }
    echo "</table>";
    echo "<br>";
    echo "<br>";
    echo "<table>";
        echo "<tr>Internship Details</tr>";
            echo "<tr><td>" . $desc . "</td></tr>";
    echo "</table>";
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

//Do stuff to render the page
get_all_internships_formatted(get_all_internships_detail());

?>
