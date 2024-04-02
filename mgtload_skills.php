<?php
session_start();

require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $selectQuery = "SELECT users.userid, users.lastname, 
    users.firstname, user_skills.id, user_skills.skill_name FROM users 
    INNER JOIN user_skills ON users.userid = user_skills.userid 
    WHERE users.usertypeid = 3";

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
