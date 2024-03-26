<?php
session_start();

require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $selectQuery = "SELECT * FROM users WHERE usertypeid = 1 
    ORDER BY userid DESC";
    $result = $connection->query($selectQuery);

    $mgts = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mgts[] = $row;
        }
    }

    echo json_encode($mgts);
} else {
    echo "Unauthorized access";
}
?>
