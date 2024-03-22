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
            <h5>Profile</h5>
          </nav>

          <hr />
          <div class="row ps-5">
            <!-- Col 1 -->
            <div
              class="card p-5 mt-2 col-sm-3 d-flex justify-content-center text-center align-self-start"
            >
              <ul class="list-unstyled">
                <li>
                  <img
                    src="<?php echo $profilepic; ?>"
                    class="rounded-circle img-fluid border"
                    style="width: 200px"
                  />
                </li>
                <li>
                  <h5 class="mt-3">
                    <?php echo $textaccount; ?>
                    <?php echo $lastname; ?>
                  </h5>
                  <h6 class="mb-4" style="color: gray">Management</h6>
                  <hr />
                </li>
              </ul>
            </div>
            <!-- Col 2 -->
            <div class="card col-sm-8 p-4 ms-3 mt-2" style="height: 480px;">
              <ul class="col list-unstyled overflow-auto">
                <!-- Name -->
                <li>
                  <h6 class="fw-bold">Name</h6>
                </li>
                <li>
                  <h6>
                    <?php echo $textaccount; ?>
                    <?php echo $middlename; ?>
                    <?php echo $lastname; ?>
                  </h6>
                  <hr />
                </li>
                <!-- Birthdate -->
                <li>
                  <h6 class="fw-bold">Birthdate</h6>
                </li>
                <li>
                  <h6><?php echo $bday; ?></h6>
                  <hr />
                </li>
                <!-- Gender -->
                <li>
                  <h6 class="fw-bold">Gender</h6>
                </li>
                <li>
                  <h6><?php echo $gender; ?></h6>
                  <hr />
                </li>
                <!-- Civil Status -->
                <li>
                  <h6 class="fw-bold">Civil Status</h6>
                </li>
                <li>
                  <h6><?php echo $civilstatus; ?></h6>
                  <hr />
                </li>
                <!-- Email -->
                <li>
                  <h6 class="fw-bold">Email</h6>
                </li>
                <li>
                  <h6><?php echo $email; ?></h6>
                  <hr />
                </li>
                <!-- Phone -->
                <li>
                  <h6 class="fw-bold">Contact Number</h6>
                </li>
                <li>
                  <h6><?php echo $phone; ?></h6>
                  <hr />
                </li>
                <!-- Street -->
                <li>
                  <h6 class="fw-bold">Street</h6>
                </li>
                <li>
                  <h6><?php echo $street; ?></h6>
                  <hr />
                </li>
                <!-- Brgy -->
                <li>
                  <h6 class="fw-bold">Barangay</h6>
                </li>
                <li>
                  <h6><?php echo $brgy; ?></h6>
                  <hr />
                </li>
                <!-- City -->
                <li>
                  <h6 class="fw-bold">City</h6>
                </li>
                <li>
                  <h6><?php echo $city; ?></h6>
                  <hr />
                </li>
                <!-- Province -->
                <li>
                  <h6 class="fw-bold">Province</h6>
                </li>
                <li>
                  <h6><?php echo $province; ?></h6>
                  <hr />
                </li>
                <!-- Buttons -->
                <li class="d-flex justify-content-center mt-4">
                  <a href="mgteditprofile.php" class="btn btn-primary fw-bold col-sm-5"
                    >EDIT PROFILE</a
                  >
                </li>
                <li class="d-flex justify-content-center mt-2">
                  <a
                    href="mgtpassword.php"
                    class="btn btn-primary fw-bold col-sm-5"
                    >CHANGE PASSWORD</a
                  >
                </li>
                <!-- End -->
              </ul>
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
