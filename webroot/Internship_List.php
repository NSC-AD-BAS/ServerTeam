<?php

//TODO: 
// -Pagination: 
//  Counter global, results per page link, dynamic LIMIT in main query
//  NEXT and PREVIOUS links
// -Sorting:
//  Allow user to sort by column

function get_all_internships_detail($start, $end) {
    $conn = db_connect();

    $sql = "SELECT * FROM internship_detail where InternshipId between $start and $end";
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

function create_internship_detail_link($internshipId, $linkTitle) {
    return "<a href=Internship_Detail.php?id=" . $internshipId. ">" . $linkTitle . "</a>";
}

function create_internship_desc_link($internshipId, $linkTitle) {
    return "<a href=?id=" . $internshipId. ">" . $linkTitle . "</a>";
}

function create_intership_row_html($row) {
    return "<tr><td>" 
    . create_internship_detail_link($row['InternshipId'], $row['Position Title']). "</td><td>"  
    . $row['Organization'] . "</td><td>" 
    . $row['Address 1'] . "</td><td>" 
    . $row['Address 2'] . "</td><td>" 
    . $row['City'] . "</td><td>" 
    . $row['State'] . "</td><td>" 
    . create_internship_desc_link($row['InternshipId'], "More Info"). "</td></tr>";
}

//Do stuff to render the page
$rows = get_all_internships_detail(0, 10);
if (isset($_GET['id'])) {
  $id = $_GET['id'];
} else {
  $id = 0;
}

$desc = get_job_description($rows[$id]['InternshipId']);

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <table>
        <tr>
            <td>Title</td>
            <td>Organization</td>
            <td>Address 1</td>
            <td>Address 2</td>
            <td>City</td>
            <td>State</td>
            <td>Description</td>
        </tr>
        <?php foreach ($rows as $row) {
            echo create_intership_row_html($row);
        }
        ?>
    </table>
    <br>
    <br>
    <table>
    <tr>Internship Description</tr>
        <tr><td> 
            <?php
            echo $desc;
            ?>
        </td></tr>
    </table>
</body>
