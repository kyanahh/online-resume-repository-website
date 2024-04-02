<?php
session_start();

require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $selectQuery = "SELECT * FROM users WHERE usertypeid = 2 
    ORDER BY userid DESC";
    $result = $connection->query($selectQuery);

    $clients = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $clients[] = $row;
        }
    }

    echo json_encode($clients);
} else {
    echo "Unauthorized access";
}
?>
