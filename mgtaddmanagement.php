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

$usertype = 1;

$firstname = $lastname = $middlename = $emailadd = $birthdate = $gender =  $civilstatus = $phone = 
$password = $confirmpassword = $errorMessage = $successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname =  ucwords($_POST["firstname"]);
    $lastname =  ucwords($_POST["lastname"]);
    $lastname =  ucwords($_POST["middlename"]);
    $birthdate = $_POST["birthdate"];
    $gender = $_POST["gender"];
    $civilstatus = $_POST["civilstatus"];
    $phone = $_POST["phone"];
    $emailadd = $_POST["emailadd"];
    $password = $_POST["password"];

        // Check if the email already exists in the database
        $emailExistsQuery = "SELECT * FROM users WHERE email = '$emailadd'";
        $emailExistsResult = $connection->query($emailExistsQuery);

        if ($emailExistsResult->num_rows > 0) {
            $errorMessage = "User already exists";
        } else {
            // Insert the user data into the database
            $regdate = date("Y-m-d H:i:s");
            $insertQuery = "INSERT INTO users (firstname, lastname, middlename, bday, gender, civilstatus, 
            phone, email, password, usertypeid, regdate) 
            VALUES ('$firstname', '$lastname', '$middlename', '$birthdate', '$gender', '$civilstatus', 
            '$phone', '$emailadd', '$password', '$usertype', '$regdate')";
            $result = $connection->query($insertQuery);

            if (!$result) {
                $errorMessage = "Invalid query " . $connection->error;
            } else {
                header("Location: mgtmanagement.php");
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
            <h5>Add Management Account</h5>
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
            <!-- Firstname, middlename, lastname -->
            <div class="row">
              <div class="col mb-3">
                <label for="firstname" class="form-label">First Name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="firstname"
                  name="firstname"
                  value="<?php echo $firstname; ?>"
                  required
                />
              </div>
              <div class="col mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="middlename"
                  name="middlename"
                  value="<?php echo $middlename; ?>"
                />
              </div>
              <div class="col mb-3">
                <label for="lastname" class="form-label">Last Name<span class="text-danger">*</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="lastname"
                  name="lastname"
                  value="<?php echo $lastname; ?>"
                  required
                />
              </div>
            </div>
            <!-- bday, gender, civilstats -->
            <div class="row">
              <div class="col mb-3">
                <label for="birthdate" class="form-label">Birthday<span class="text-danger">*</span></label>
                <input type="date" class="form-control" id="birthdate" name="birthdate" placeholder="Birthday" 
                value="<?php echo $birthdate; ?>" required>
              </div>
              <div class="col mb-3">
                <label for="gender" class="form-label">Gender<span class="text-danger">*</label>
                <select id="gender" name="gender" class="form-select" required>
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
            <!-- Phone, email, password -->
            <div class="row">
              <div class="col mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>">
              </div>
              <div class="col mb-3">
                <label for="emailadd" class="form-label">Email address<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="emailadd" name="emailadd" placeholder="Email address" value="<?php echo $emailadd; ?>" required>
              </div>
              <div class="col mb-3">
                <label for="password" class="form-label">Temporary Password<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Temporary Password" value="<?php echo $password; ?>" required>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <a class="btn btn-danger px-4 me-2" href="mgtmanagement.php">Cancel</a>
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
