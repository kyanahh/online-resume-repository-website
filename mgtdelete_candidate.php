<?php
session_start();
require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["userid"])) {
    $userid = $_POST["userid"];

    $deleteQuery = "DELETE FROM users WHERE userid = '$userid'";
    if ($connection->query($deleteQuery)) {
        echo "User account deleted successfully.";
    } else {
        echo "Error deleting account: " . $connection->error;
    }
}
?>
