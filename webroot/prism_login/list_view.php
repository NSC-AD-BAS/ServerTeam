<?php
include "Internship_List.php";
include "common.php";
#Author: Kellan Nealy

#accepts form data from ITSELF, PRINTS the listview with plain-text search
#if the form on this page for plain-text search is selected.  Otherwise
#prints the standard listview with all INTERNSHIPS.


#Handles the session, and only operates on an active session
#prints the correct listview based on the user_type session variable
function populate_landing_page() {
    session_start();
    if (is_logged_in()) {
        
        # populate banner with user details using session variables
        populate_banner();
        
        #check to see if the user clicked a nav button
        if (isset($_GET['nav'])) {
            $nav = $_GET['nav'];
        } else {
            $nav = "";
        }
        
        echo "<div id=\"list_view\">";
        if (($_SESSION["user_type"] == "Student" && $nav == "") || $nav == "internships" ) {
            populate_internships();
            
        } else if (($_SESSION["user_type"] == "Student" && $nav == "") || $nav == "orgs" ) {
            populate_orgs();
        
        } else if (($_SESSION["user_type"] == "Faculty" && $nav == "")
            || ($_SESSION["user_type"] == "Faculty" || $_SESSION["user_type"] == "Admin")
            && $nav == "students") {
                
            populate_students();
        } else if($_SESSION["user_type"] == "Admin" ) {
            
            populate_users();
        }
        echo "</div>";
        
    } else {
        to_login();
    }
}

# call this function inside of the list_view element
function populate_internships() {
    
    //Do stuff to render the page
    $rows = get_all_internships_detail(0, 15);
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = 0;
    }
    $desc = get_job_description($rows[$id]['InternshipId']);?>
    
    <table>
        <br />
        <tr>
            <td><strong>Title</strong></td>
            <td><strong>Organization</strong></td>
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
    
    <?php
    #$mysqli = get_db_connection_kellan();
    
    /* Select queries return a resultset */
    # first two values in internship are internship_id and org_id
    # slots available, date posted, start date printed on 2nd line of element
    /*
    if ($result = $mysqli->query("SELECT * FROM internship_list")) {

        echo "<p id=\"query_stats\">";
        printf("Select returned %d internships.\n", $result->num_rows);
        echo "</p><br /><ul>";
        foreach ($result as $row) {
            echo "<li>Internship: <br />";
            foreach ($row as $element) {
            echo $element . "&emsp;";
            }
            echo "</li></br >";
        }
        echo "</ul>";
        # close result set
        $result->close();
    }
    $mysqli->close();
    */
}

# call this function inside of the list_view element
function populate_orgs() {
        $mysqli = get_db_connection_kellan();
        /* Select queries return a resultset */
        if ($result = $mysqli->query("SELECT * FROM org_list")) {

            echo "<div id=\"list_view\">";
            echo "<p id=\"query_stats\">";
            printf("Select returned %d organizations.\n", $result->num_rows);
            echo "</p><br /><ul>";
            foreach ($result as $row) {
                echo "<li>&emsp;&emsp;&emsp;<strong>Organization: <strong/><br />";
                foreach ($row as $element) {
                    echo "<a href='organizationDetailView.php?value=10'>";
                    echo $element . "&emsp;";
                }
                echo "</a></li></br >";
            }
            echo "</ul></div>";
            /* free result set */
            $result->close();
        }
        $mysqli->close();
}

# call this function inside of the list_view element
function populate_users() {
    $mysqli = get_db_connection_kellan();
    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT * FROM user_list")) {

        echo "<p id=\"query_stats\">";
        printf("Select returned %d users.\n", $result->num_rows);
        echo "</p><br /><ul>";
        foreach ($result as $row) {
            echo "<li>&emsp;&emsp;&emsp;<strong>User: </strong><br />";
            foreach ($row as $element) {
            echo $element . "&emsp;";
            }
            echo "</li></br >";
        }
        echo "</ul>";
        # close result set
        $result->close();
    }
    $mysqli->close();
}

# call this function inside of the list_view element
function populate_students() {
    $mysqli = get_db_connection_kellan();
    /* Select queries return a resultset */
    if ($result = $mysqli->query("SELECT * FROM student_list")) {
        
        echo "<p id=\"query_stats\">";
        printf("Select returned %d students.\n", $result->num_rows);
        echo "</p><br /><ul>";
        foreach ($result as $row) {
            echo "<li>&emsp;&emsp;&emsp;<strong>Student: </strong><br />";
            foreach ($row as $element) {
            echo $element . "&emsp;";
            }
            echo "</li></br >";
        }
        echo "</ul>";
        # close result set
        $result->close();
    }
    $mysqli->close();
}

#uses internally stored credentials to create and return DB connection
#as a Mysqli PHP object.  For use on prism.tekbot.net unless you hard-code.
function get_db_connection_kellan() {
    include '../../include/db_connect.php';
    //create and verify connection
    $mysqli_obj = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli_obj->connect_error) {
        die('DB Connection Error: ' . $mysqli_obj->connect_errno . $mysqli_obj->connect_error);
    }
    return $mysqli_obj;
}
?>

<!DOCTYPE html>
<head>
    <title>Welcome!</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
    
    <script type="text/javascript">
    
            window.onload = function() {
                alert("hi" + <?php
                echo $_SESSION["username"];
                ?>
                );
            }
    </script>
</head>
<body>
    <?php
        populate_landing_page();
    ?>
</body>
</html>
