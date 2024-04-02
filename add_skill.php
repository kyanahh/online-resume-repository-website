<?php
session_start();
require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $skill_name = ucwords($_POST["skill_name"]);

    $insertQuery = "INSERT INTO user_skills (userid, skill_name) VALUES ('$userid', '$skill_name')";
    if ($connection->query($insertQuery)) {
        echo "Skill added successfully.";
    } else {
        echo "Error adding skill: " . $connection->error;
    }
}
?>