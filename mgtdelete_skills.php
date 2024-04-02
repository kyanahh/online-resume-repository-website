<?php
session_start();
require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["skill_id"])) {
  $skill_id = $_POST["skill_id"];

  $deleteQuery = "DELETE FROM user_skills WHERE id = '$skill_id'";
  if ($connection->query($deleteQuery)) {
    echo "Skill deleted.";
  } else {
    echo "Error deleting skill: " . $connection->error;
  }
} else {
  echo "Unauthorized access";
}
?>
