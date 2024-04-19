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

if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];

    $query = "SELECT * FROM users WHERE userid = '$userid'";

    $res = $connection->query($query);

    if ($res && $res->num_rows > 0) {
        $row = $res->fetch_assoc();

        $userid1 = $row["userid"];
        $firstname = $row["firstname"];
        $middlename = $row["middlename"];
        $lastname = $row["lastname"];
        $birthdate = strftime("%B %d, %Y", strtotime($row["bday"]));
        $gender = $row["gender"];
        $civilstatus = $row["civilstatus"];
        $phone = $row["phone"];
        $emailadd = $row["email"];
        $regdate = $row["regdate"];
        $gdrive = $row["gdrive"];
        $street = $row["street"];
        $brgy = $row["brgy"];
        $city = $row["city"];
        $province = $row["province"];

    } else {
        $errorMessage1 = "User not found.";
    }
} else {
    $errorMessage1 = "User ID is missing.";
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
            <h5>Candidate Account (User)</h5>
          </nav>

          <hr />
            <!-- userid Firstname, lastname -->
            <div class="row">
                <div class="col-sm-4 mb-3">
                <label for="firstname" class="form-label">UserID</label>
                <input
                  type="text"
                  class="form-control"
                  id="userid"
                  name="userid"
                  value="<?php echo $userid; ?>"
                  disabled
                />
                </div>
                <div class="col mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="firstname"
                  name="firstname"
                  value="<?php echo $firstname; ?>"
                  disabled
                />
              </div>
              <div class="col mb-3">
                <label for="lastname" class="form-label">Last Name</span></label>
                <input
                  type="text"
                  class="form-control"
                  id="lastname"
                  name="lastname"
                  value="<?php echo $lastname; ?>"
                  disabled
                />
              </div>
            </div>
            <!-- middlename, bday, gender -->
            <div class="row">
              <div class="col mb-3">
                <label for="middlename" class="form-label">Middle Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="middlename"
                  name="middlename"
                  value="<?php echo $middlename; ?>"
                  disabled
                />
              </div>
              <div class="col mb-3">
                <label for="birthdate" class="form-label">Birthday</label>
                <input type="text" class="form-control" id="birthdate" name="birthdate"
                value="<?php echo $birthdate; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" id="gender" name="gender" 
                value="<?php echo $gender; ?>" disabled>
              </div>
            </div>
            <!-- civilstats, email, phone -->
            <div class="row">
              <div class="col mb-3">
                <label for="civilstatus" class="form-label">Civil Status</label>
                <input type="text" class="form-control" id="civilstatus" name="civilstatus" 
                value="<?php echo $civilstatus; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="emailadd" class="form-label">Email address</label>
                <input type="text" class="form-control" id="emailadd" name="emailadd" value="<?php echo $emailadd; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" disabled>
              </div>
            </div>
            <!-- street, brgy, city -->
            <div class="row">
              <div class="col mb-3">
                <label for="street" class="form-label">Street</label>
                <input type="text" class="form-control" id="street" name="street" value="<?php echo $street; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="brgy" class="form-label">Barangay</label>
                <input type="text" class="form-control" id="brgy" name="brgy" value="<?php echo $brgy; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="city" class="form-label">City</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" disabled>
              </div>
            </div>
            <!-- province, gdrive, regdate -->
            <div class="row">
              <div class="col mb-3">
                <label for="province" class="form-label">Province</label>
                <input type="text" class="form-control" id="province" name="province" value="<?php echo $province; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="gdrive" class="form-label">Google Drive</label>
                <input type="text" class="form-control" id="gdrive" name="gdrive" value="<?php echo $gdrive; ?>" disabled>
              </div>
              <div class="col mb-3">
                <label for="regdate" class="form-label">Registered Date</label>
                <input type="text" class="form-control" id="regdate" name="regdate" value="<?php echo $regdate; ?>" disabled>
              </div>
            </div>
            <div class="d-flex justify-content-end">
              <a class="btn btn-dark px-4 me-2" href="mgtusers.php">Back</a>
            </div>
        </div>
      </div>

      
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  </body>
</html>
