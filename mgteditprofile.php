<?php

session_start();

require("server/connection.php");

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["firstname"])){
      $textaccount = strtoupper($_SESSION["firstname"]);
      $lastname = strtoupper($_SESSION["lastname"]);
      $middlename = strtoupper($_SESSION["middlename"]); 
      $email = $_SESSION["email"];
      $regdate = $_SESSION["regdate"];
      $phone = $_SESSION["phone"];
      $bday = strftime("%B %d, %Y", strtotime($_SESSION["bday"]));
      $profilepic = $_SESSION["profilepic"];
      $gender = $_SESSION["gender"];
      $civilstatus = $_SESSION["civilstatus"];
      $street = $_SESSION["street"];
      $brgy = $_SESSION["brgy"];
      $city = $_SESSION["city"];
      $province = $_SESSION["province"];
        
    }else{
        $textaccount = "Account";
    }
}else{
    $textaccount = "Account";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["phone"];
    $lastname = $_POST["lastname"];
    $middlename = $_POST["middlename"];
    $gender = $_POST["gender"];
    $civilstatus = $_POST["civilstatus"];
    $street = $_POST["street"];
    $brgy = $_POST["brgy"];
    $city = $_POST["city"];
    $province = $_POST["province"];
  
    // Handle file upload for profile picture
    if(isset($_FILES["profilepic"]) && !empty($_FILES["profilepic"]["name"])) {
        $targetDirectory = "profile_pictures/";
        $targetFile = $targetDirectory . basename($_FILES["profilepic"]["name"]);
  
        // Check if the uploaded file is an image
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
            if (move_uploaded_file($_FILES["profilepic"]["tmp_name"], $targetFile)) {
                // Update the profile picture path in the database
                $updateQuery = "UPDATE users SET profilepic = '$targetFile', phone = '$phone',
                 lastname = '$lastname', gender = '$gender', middlename = '$middlename', civilstatus = '$civilstatus',
                 street = '$street', brgy = '$brgy', city = '$city', province = '$province' WHERE email = '$email'";
                if($connection->query($updateQuery)) {
                    $_SESSION["profilepic"] = $targetFile;
                    // Redirect to the profile page or wherever you want
                    header("Location: mgtprofile.php");
                    exit; // Ensure that no further code is executed after redirection
                } else {
                    $errorMessage = "Failed to update profile. Please try again later.";
                }
            } else {
                $errorMessage = "Failed to upload file.";
            }
        } else {
            $errorMessage = "Invalid file format. Please upload an image (jpg, jpeg, png, or gif).";
        }
    } else {
        // If no profile picture is uploaded, update only phone and gdrive
        $updateQuery = "UPDATE users SET phone = '$phone', lastname = '$lastname', gender = '$gender',
         middlename = '$middlename', civilstatus = '$civilstatus',
         street = '$street', brgy = '$brgy', city = '$city', province = '$province' WHERE email = '$email'";
        if($connection->query($updateQuery)) {
            // Redirect to the profile page or wherever you want
            header("Location: mgtprofile.php");
            $errorMessage = "Saved changes.";
            exit; // Ensure that no further code is executed after redirection
        } else {
            $errorMessage = "Failed to update profile. Please try again later.";
        }
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
            <h5>Edit Profile</h5>
          </nav>

          <hr />
          <div class="row overflow-auto" style="height: 480px;">
                        <?php
                            if (!empty($errorMessage)) {
                                echo "
                                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                    <strong>$errorMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                                ";
                            }
                        ?>
            <!-- Prof Pic --> 
            <div class="col-sm-3">
                <ul class="list-unstyled">
                <li class="d-flex justify-content-center">
                <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>" enctype="multipart/form-data">
                    <img src="<?php echo $profilepic; ?>" alt="avatar"
                    class="rounded-circle img-fluid border" style="width: 150px;">
                </li>
                <li>
                    <h5 class="my-3 text-center">Profile Picture</h5>
                </li>
                <li>
                    <input class="form-control" accept="image/*" type="file" id="profilepic" name="profilepic" value="<?php echo $profilepic; ?>" />
                </li>
                </ul>

            </div>

            <!-- Profile Settings --> 
                <div class="col-sm-6">
                        <!-- Fname and Bday  -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $textaccount; ?>" disabled>
                        </div>
                        <div class="col mb-3">
                            <label for="bday" class="form-label">Birth Date</label>
                            <input type="text" class="form-control" id="bday" value="<?php echo $bday; ?>" disabled>
                        </div>
                        </div>
                        <!-- MName and Email -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="middlename" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middlename" name="middlename" value="<?php echo $middlename; ?>">
                        </div>
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" disabled>
                        </div>

                        </div>
                        <!-- Lastname & Phone  -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
                        </div>
                        <div class="col mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
                        </div>
                        </div>
                        <!-- Gender & CS -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select">
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male" <?php echo ($gender === "Male") ? "selected" : ""; ?>>Male</option>
                            <option value="Female" <?php echo ($gender === "Female") ? "selected" : ""; ?>>Female</option>
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="civilstatus" class="form-label">Civil Status</label>
                            <select id="civilstatus" name="civilstatus" class="form-select">
                            <option value="" disabled selected>Select Civil Status</option>
                            <option value="Single" <?php echo ($civilstatus === "Single") ? "selected" : ""; ?>>Single</option>
                            <option value="Married" <?php echo ($civilstatus === "Married") ? "selected" : ""; ?>>Married</option>
                            <option value="Separated" <?php echo ($civilstatus === "Separated") ? "selected" : ""; ?>>Separated</option>
                            <option value="Divorced" <?php echo ($civilstatus === "Divorced") ? "selected" : ""; ?>>Divorced</option>
                            <option value="Widowed" <?php echo ($civilstatus === "Widowed") ? "selected" : ""; ?>>Widowed</option>
                            </select>
                        </div>
                        </div>
                        <!-- Street & Brgy  -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="street" class="form-label">House No./Street/Subdivision</label>
                            <input type="text" class="form-control" id="street" name="street" value="<?php echo $street; ?>">
                        </div>
                        <div class="col mb-3">
                            <label for="brgy" class="form-label">Barangay</label>
                            <input type="text" class="form-control" id="brgy" name="brgy" value="<?php echo $brgy; ?>">
                        </div>
                        </div>
                        <!-- City & Province  -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>">
                        </div>
                        <div class="col mb-3">
                            <label for="province" class="form-label">Province</label>
                            <input type="text" class="form-control" id="province" name="province" value="<?php echo $province; ?>">
                        </div>
                        </div>
                        <!-- Reg Date -->
                        <div class="row">
                        <div class="col mb-3">
                            <label for="regdate" class="form-label">Registered Date</label>
                            <input type="text" class="form-control" id="regdate" value="<?php echo $regdate; ?>" disabled>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col d-grid gap-2">
                            <button type="submit" class="btn btn-primary text-white fw-bold">Update My Profile</button>
                        </div>
                        </div>
                        <hr>
                        <div class="row px-2">
                        <a href="mgtpassword.php" class="btn btn-primary fw-bold">Change Password</a>
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
  </body>
</html>
