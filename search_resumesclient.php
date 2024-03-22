<?php

require("server/connection.php");

if (isset($_POST['query'])) {
  $query = mysqli_real_escape_string($connection, $_POST['query']);
    if (!empty($query)) {
        $sql = "SELECT users.userid, users.lastname, users.firstname, user_skills.skill_name 
        FROM users
        INNER JOIN user_skills ON users.userid = user_skills.userid
        WHERE (users.firstname LIKE '%$query%' OR
               users.lastname LIKE '%$query%' OR
               user_skills.skill_name LIKE '%$query%')";

               
    } else {

        $firstquery = "SELECT userid, lastname, firstname FROM users";

        $fRes = $connection->query($firstquery);

        $sql = "SELECT users.userid, users.lastname, users.firstname, GROUP_CONCAT(user_skills.skill_name SEPARATOR ', ') 
        AS Skills FROM users 
        LEFT JOIN user_skills ON users.userid = user_skills.userid WHERE users.usertypeid = 3  
        GROUP BY users.userid";

        $result = $connection->query($sql);

        while ($row = $fRes->fetch_assoc()) {
            $query = "SELECT * FROM users INNER JOIN user_skills ON users.userid = user_skills.userid  
            WHERE users.userid = " . $row["userid"];
            $result = $connection->query($query);
            echo "<tr>";
            echo "<td>" . $row['userid'] . "</td>";
            echo "<td>" . $row['lastname'] . "</td>";
            echo "<td>" . $row['firstname'] . "</td>";

            // Improved skill display logic
            $skillz = "";
            while ($rows = $result->fetch_assoc()) {
            $skillz .= ucwords($rows["skill_name"]) . ", ";
            }
            $skillz = rtrim($skillz, ", "); // Remove trailing comma
            echo "<td>" . $skillz . "</td>";

            echo "</tr>";
        }
    }
 
    $result = $connection->query($sql);
 
  if ($result->num_rows > 0) {
    $count = 1;
    while ($row = $result->fetch_assoc()) {
      // Use the retrieved data within the loop
      echo "<tr>";
      echo '<td>' . $count . '</td>';
      echo "<td>" . $row['lastname'] . "</td>";
      echo "<td>" . $row['firstname'] . "</td>";
      // Improved skill display logic
      $skillz = "";
      while ($rows = $result->fetch_assoc()) {
        $skillz .= ucwords($rows["skill_name"]) . ", ";
      }
      $skillz = rtrim($skillz, ", "); // Remove trailing comma
      echo "<td>" . $skillz . "</td>";

      echo "</tr>";
    }
  } else {
    echo '<tr><td colspan="5">No records.</td></tr>';
  }
}
 

?>
