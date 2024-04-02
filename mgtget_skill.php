<?php
session_start();
require("server/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["skill_id"])) {
  $skillId = $_GET["skill_id"];

  $selectQuery = "SELECT * FROM user_skills WHERE id = '$skillId'";
  $result = $connection->query($selectQuery);

  if ($result->num_rows > 0) {
    $skill = $result->fetch_assoc();
    echo json_encode($skill);
  } else {
    echo "Skill not found";
  }
} else {
  echo "Unauthorized access";
}
