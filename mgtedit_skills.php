<?php
session_start();
require("server/connection.php");

$skillId = $_POST["skill_id"];
$skillName = $_POST["skill_name"];

$sql = "UPDATE user_skills SET skill_name = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $skillName, $skillId);

if ($stmt->execute()) {
    echo "Skill edited successfully!";
  } else {
    echo "Error editing skill: " . $conn->error;
  }
  
  $stmt->close();
  $conn->close();
  

?>
