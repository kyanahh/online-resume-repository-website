<?php
session_start();
require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $skill_id = $_POST["skill_id"];

    $deleteQuery = "DELETE FROM user_skills WHERE id = '$skill_id' AND userid = '$userid'";
    if ($connection->query($deleteQuery)) {
        echo "Skill deleted successfully.";
    } else {
        echo "Error deleting skill: " . $connection->error;
    }
}
?>
