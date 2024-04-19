<?php

session_start();

require("server/connection.php");

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["firstname"])){
        $textaccount = $_SESSION["firstname"];
        $email = $_SESSION["email"];
        
    }else{
        $textaccount = "Account";
    }
}else{
    $textaccount = "Account";
}

$userid = $skill = $errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid =  $_POST["userid"];
    $skill =  ucwords($_POST["skill"]);

    // Check if the userid already exists in the database
    $useridExistsQuery = "SELECT * FROM users WHERE userid = '$userid' AND usertypeid = 3";
    $useridExistsResult = $connection->query($useridExistsQuery);

    if ($useridExistsResult->num_rows > 0) {

        // Insert the skill data into the database
        $insertQuery = "INSERT INTO user_skills (userid, skill_name) 
        VALUES ('$userid', '$skill')";
        $result = $connection->query($insertQuery);

        if (!$result) {
            $errorMessage = "Invalid query " . $connection->error;
        } else {
            header("Location: mgtskills.php");
        }
    } else {
        $errorMessage = "User ID does not exist or User is not a candidate";
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, 
				initial-scale=1.0"
    />
    <title>VocoEase</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styleadmin.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />
  </head>

  <body>
    <div class="container-fluid p-0 d-flex h-100">
      <div
        id="bdSidebar"
        class="d-flex flex-column flex-shrink-0 p-3 bg-dark offcanvas-md offcanvas-start"
      >
        <a
          href="dashboard.php"
          class="navbar-brand rounded d-flex justify-content-center bg-light py-3"
          ><img src="img/logoname.png" alt="VocoEase" style="height: 50px"
        /></a>
        <ul class="mynav nav nav-pills flex-column mb-auto mt-3">
          <li class="nav-item mb-1">
            <a href="dashboard.php">
              <i class="fa-solid fa-home"></i>
              Dashboard
            </a>
          </li>

          <li class="nav-item mb-1">
            <a href="mgtusers.php">
              <i class="fa-solid fa-users"></i>
              Candidates
            </a>
          </li>

          <li class="nav-item mb-1">
            <a href="mgtskills.php">
              <i class="fa-solid fa-wrench"></i>
              Candidate Skills
            </a>
          </li>
          <li class="nav-item mb-1">
            <a href="mgtclients.php">
              <i class="fa-solid fa-suitcase"></i>
              Clients
            </a>
          </li>
          <li class="nav-item mb-1">
            <a href="mgtmanagement.php">
              <i class="fa-solid fa-user-tie"></i>
              Management
            </a>
          </li>
          <li class="nav-item mb-1">
            <a href="mgtuserlogs.php">
              <i class="fa-solid fa-book"></i>
              User Logs
            </a>
          </li>

          <li class="sidebar-item nav-item mb-1">
            <a
              href="#"
              class="sidebar-link collapsed d-flex justify-content-between"
              data-bs-toggle="collapse"
              data-bs-target="#settings"
              aria-expanded="false"
              aria-controls="settings"
            >
            <div class="d-flex align-items-center">
              <i class="fas fa-cog pe-2"></i>
              <span class="topic">Settings </span>
            </div>
              <i class="bi bi-chevron-down"></i>
            </a>
            <ul
              id="settings"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a href="mgtprofile.php" class="sidebar-link">
                  <i class="fa-regular fa-user"></i>
                  <span class="topic"> Profile</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="mgtpassword.php" class="sidebar-link">
                <i class="fa-solid fa-key"></i>
                  <span class="topic"> Change Password</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="logout.php" class="sidebar-link">
                  <i class="fas fa-sign-out-alt pe-2"></i>
                  <span class="topic">Log Out</span>
                </a>
              </li>
            </ul>
          </li>
        </ul>
        <hr />
        <div class="d-flex text-white pe-5">
          <i class="pe-3 fa-solid fa-user"></i>
          <span>
            <h6 class="mb-0"><?php echo $email; ?></h6>
          </span>
        </div>
      </div>

      <div class="bg-light flex-fill">
        <div class="p-2 d-md-none d-flex">
          <a href="#" data-bs-toggle="offcanvas" data-bs-target="#bdSidebar">
            <i class="fa-solid fa-bars"></i>
          </a>
          <span class="ms-3">GFG Portal</span>
        </div>
        <div class="p-4">
          <nav style="--bs-breadcrumb-divider: '>'; font-size: 14px">
            <h5>Add Skill</h5>
          </nav>

          <hr />
          <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>">
                <?php
                    if (!empty($errorMessage)) {
                        echo "
                        <div class='alert alert-warning alert-dismissible mt-2 fade show' role='alert'>
                            <strong>$errorMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                        ";
                    }
                ?>
            <!-- userid, skill -->
            <div class="row">
              <div class="col-sm-4 mb-3">
                <label for="userid" class="form-label">User ID<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="userid"
                  name="userid"
                  value="<?php echo $userid; ?>"
                  required
                />
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 mb-3">
                <label for="skill" class="form-label">Skill</label>
                <input
                  type="text"
                  class="form-control"
                  id="skill"
                  name="skill"
                  value="<?php echo $skill; ?>"
                />
              </div>
            </div>
            <div class="col-sm-4 d-flex justify-content-end pe-3">
              <a class="btn btn-danger px-4 me-2" href="mgtskills.php">Cancel</a>
              <button type="submit" class="btn btn-primary px-4">Submit</button>
            </div>
          </form>
        </div>
      </div>

      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  </body>
</html>
