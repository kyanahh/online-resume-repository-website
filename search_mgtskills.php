<?php

require("server/connection.php");

if (isset($_POST['query'])) {
    $query = mysqli_real_escape_string($connection, $_POST['query']);
    if (!empty($query)) {
        $sql = "SELECT users.userid, users.lastname, users.firstname, 
        GROUP_CONCAT(user_skills.skill_name SEPARATOR ', ') 
        AS Skills FROM users
        LEFT JOIN user_skills ON users.userid = user_skills.userid
        WHERE (users.usertypeid = 3 AND 
               (users.firstname LIKE '%$query%' OR
                users.lastname LIKE '%$query%')) 
        OR Skills LIKE '%$query%'
        GROUP BY users.userid";
    } else {
        // If the query is empty, retrieve all records where usertypeid = 1
        $sql = "SELECT users.userid, users.lastname, 
        users.firstname, GROUP_CONCAT(user_skills.skill_name SEPARATOR ', ') 
        AS Skills FROM users 
        LEFT JOIN user_skills ON users.userid = user_skills.userid 
        WHERE users.usertypeid = 3  
        GROUP BY users.userid";
    }
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows > 0) {
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo '<td>' . $row['lastname'] . '</td>';
            echo '<td>' . $row['firstname'] . '</td>';
            echo '<td>' . ucwords($row['Skills']) . '</td>';
            echo '</tr>';
            $count++; 
        }        
    } else {
        echo '<tr><td colspan="5">No results found.</td></tr>';
    }
}

?>
