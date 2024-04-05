<?php
session_start();

require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $selectQuery = "SELECT * FROM users WHERE usertypeid = 3 
    ORDER BY userid DESC";
    $result = $connection->query($selectQuery);

    $candidates = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $candidates[] = $row;
        }
    }

    echo json_encode($candidates);
} else {
    echo "Unauthorized access";
}
?>
