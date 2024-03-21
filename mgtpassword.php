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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  $oldpassword = $_POST["oldpassword"];
  $newpassword = $_POST["newpassword"];
  $confirmpassword = $_POST["confirmpassword"];

  $result = $connection->query("SELECT password FROM users WHERE email = '$email'");
  $record = $result->fetch_assoc();
  $stored_password = $record["password"];
  if ($oldpassword == $stored_password) {

    if($newpassword !== $confirmpassword){
      $_SESSION["error_message"] = "Passwords do not match";
    } else {
      $connection->query("UPDATE users SET password = '$newpassword' WHERE email = '$email'");
      $_SESSION["success_message"] = "Password changed successfully";
    }
  } else {
    $_SESSION["error_message"] = "Old password does not match";
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
              class="sidebar-link collapsed"
              data-bs-toggle="collapse"
              data-bs-target="#settings"
              aria-expanded="false"
              aria-controls="settings"
            >
              <i class="fas fa-cog pe-2"></i>
              <span class="topic">Settings </span>
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
            <h5>Change Password</h5>
          </nav>

          <hr />
          <div class="row">
            <!-- Profile Settings --> 
            <div class="col-sm-6">
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>">
                        <div class="row mt-2">
                            <div class="col input-group">
                                <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleOldPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col input-group">
                                <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row my-2">
                            <div class="col input-group">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="text-danger">
                            <?php
                                if (isset($_SESSION["success_message"])) {
                                    echo "<label>" . $_SESSION["success_message"] . "</label>";
                                    unset($_SESSION["success_message"]);
                                } elseif (isset($_SESSION["error_message"])) {
                                    echo "<label>" . $_SESSION["error_message"] . "</label>";
                                    unset($_SESSION["error_message"]);
                                }
                            ?>
                        </div>
                        <div class="row">
                            <div class="col d-grid gap-2">
                                <button type="submit" class="btn btn-primary text-white mt-3 fw-bold">Change Password</button>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col d-grid gap-2">
                                <a class="btn btn-danger text-white fw-bold" href="mtgprofile.php">Cancel</a>
                            </div>
                        </div>
                    </form>
                
            </div>
          </div>
        </div>
      </div>

      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>

        // Toggle password visibility for old password
        document.getElementById("toggleOldPassword").addEventListener("click", function () {
            const oldPasswordInput = document.getElementById("oldpassword");
            if (oldPasswordInput.type === "password") {
                oldPasswordInput.type = "text";
            } else {
                oldPasswordInput.type = "password";
            }
        });

        // Toggle password visibility for new password
        document.getElementById("toggleNewPassword").addEventListener("click", function () {
            const newPasswordInput = document.getElementById("newpassword");
            if (newPasswordInput.type === "password") {
                newPasswordInput.type = "text";
            } else {
                newPasswordInput.type = "password";
            }
        });

        // Toggle password visibility for confirm password
        document.getElementById("toggleConfirmPassword").addEventListener("click", function () {
            const confirmPasswordInput = document.getElementById("confirmpassword");
            if (confirmPasswordInput.type === "password") {
                confirmPasswordInput.type = "text";
            } else {
                confirmPasswordInput.type = "password";
            }
        });

      </script>
  </body>
</html>
