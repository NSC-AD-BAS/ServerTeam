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

function create_internship_desc_button($internshipId, $linkTitle) {
    return "<input type=\"submit\" onclick=\"populate_description(" 
        . $internshipId 
        . ")\" value=\"" 
        . $linkTitle
        . "\">";
}

function create_intership_row_html($row) {
    return "<tr><td>" 
    . create_internship_detail_link($row['InternshipId'], $row['Position Title']). "</td><td>"  
    . $row['Organization'] . "</td><td>" 
    . $row['Address 1'] . "</td><td>" 
    . $row['Address 2'] . "</td><td>" 
    . $row['City'] . "</td><td>" 
    . $row['State'] . "</td><td>" 
    . create_internship_desc_button($row['InternshipId'], "MoreInfo") . "</td></tr>";
}

//Do stuff to render the page
$rows = get_all_internships_detail(0, 10);

?>

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
