<?php

require("server/connection.php");

if (isset($_POST['query'])) {
    $query = mysqli_real_escape_string($connection, $_POST['query']);
    if (!empty($query)) {
        $sql = "SELECT * FROM users WHERE usertypeid = 1 AND (lastname LIKE '%$query%' OR 
        firstname LIKE '%$query%' OR 
        email LIKE '%$query%' OR phone LIKE '%$query%')";
    } else {
        $sql = "SELECT * FROM users WHERE usertypeid = 1 ORDER BY userid DESC";
    }
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows > 0) {
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo '<td>' . $row['userid'] . '</td>';
            echo '<td>' . $row['lastname'] . '</td>';
            echo '<td>' . $row['firstname'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td>' . $row['phone'] . '</td>';
            echo '<td class="d-flex align-items-center">
            <button class="btn btn-primary me-2">Edit</button>
            <button class="btn btn-danger">Delete</button></td>';
            echo '</tr>';
            $count++;
        }        
    } else {
        echo '<tr><td colspan="5">No user found.</td></tr>';
    }
}

?>
