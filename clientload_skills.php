<?php

require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["userid"])) {
    $userid = $_GET["userid"];

    $selectQuery = "SELECT id, skill_name FROM user_skills WHERE userid = '$userid'";
    $result = $connection->query($selectQuery);

    $skills = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $skills[] = $row;
        }
    }

    echo json_encode($skills);
} else {
    echo "Unauthorized access";
}


?>