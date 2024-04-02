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
            <h5>Management Accounts</h5>
          </nav>

          <hr />
          <!-- List of Mgt -->
          <div class="px-3">
                <div class="row">
                    <div class="col input-group mb-3">
                        <input type="text" class="form-control" id="searchMgtInput" onchange="searchMgt()" placeholder="Search" aria-describedby="button-addon2">
                    </div>
                    <div class="col-sm-1">
                      <a href="mgtmanagement.php" class="btn btn-dark px-4"><i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                    <div class="col-sm-1">
                      <a href="mgtaddmanagement.php" class="btn btn-dark px-4"><i class="bi bi-plus-lg"></i></a>
                    </div>  
                </div>
                
                <div class="card" style="height: 450px;">
                    <div class="card-body">
                        <div class="table-responsive" style="height: 420px;">
                            <table id="mgt-table" class="table table-bordered table-hover">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="mgtList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Search results will be displayed here -->
                <div id="search-results"></div>
            </div>
            <!-- End of List of Mgt -->
        </div>
      </div>

      
    </div>

    <!-- Delete Mgt Modal -->
    <div
            class="modal fade"
            id="delmgt"
            tabindex="-1"
            aria-labelledby="delmgt1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="delmgt1">
                    Delete Account
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                <form id="deleteMgtForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="hidden" id="deleteMgtId" name="userid">
                    <p class="pt-2">Are you sure you want to delete this account?</p>
                </div>
                <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Delete</button>
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                </div>
                </form>
              </div>
            </div>
          </div>

          <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <strong class="me-auto">Notification</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                Account deleted.
              </div>
            </div>
          </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

    <script>
      const myModal = document.getElementById("myModal");
      const myInput = document.getElementById("myInput");

      myModal.addEventListener("shown.bs.modal", () => {
        myInput.focus();
      });
    </script>

    <script>

                //---------------------------Search Mgt Results---------------------------//
                function searchMgt() {
                    const query = document.getElementById("searchMgtInput").value;
                    // Make an AJAX request to fetch search results
                    $.ajax({
                        url: 'search_mgt.php', // Replace with the actual URL to your search script
                        method: 'POST',
                        data: { query: query },
                        success: function(data) {
                            // Update the user-table with the search results
                            $('#mgt-table tbody').html(data);
                        }
                    });
                }

    </script>

    <script>
        // Function to display the delete modal with the correct user ID
        function displayDeleteModal(mgtId) {
          document.getElementById('deleteMgtId').value = mgtId;
          $('#delmgt').modal('show');
        }

        // Handle form submission for deleting a skill
        document.getElementById("deleteMgtForm").addEventListener("submit", function(event) {
          event.preventDefault(); // Prevent default form submission
          // Modal will handle deletion using JavaScript
        });
    </script>

    <script>
      // Function to load mgt from the database
      function loadMgt() {
            fetch("mgtload_mgt.php") // PHP script to load mgt
            .then(response => response.json())
            .then(mgts => {
                var mgtList = document.getElementById("mgtList");
                mgtList.innerHTML = ""; // Clear existing mgt
                mgts.forEach(mgt => {
                    var listItem = document.createElement("tr");
                    listItem.innerHTML = `
                      <tr>
                        <td>${mgt.userid}</td>
                        <td>${mgt.lastname}</td>
                        <td>${mgt.firstname}</td>
                        <td>${mgt.email}</td>
                        <td>${mgt.phone}</td>
                        <td><button onclick="viewMgt(${mgt.userid})" class="btn btn-dark">View</button>
                        <button onclick="displayDeleteModal(${mgt.userid})" class="btn btn-danger">Delete
                        </button></td>
                      </tr>
                    `;
                    mgtList.appendChild(listItem);
                });

                // Clear mgts input field
                document.getElementById("mgts").value = "";
            });
        }

        // view mgt 
        function viewMgt(mgtId) {
          window.location.href = "mgtviewmgt.php?userid=" + mgtId; // Redirect to mgtviewmgt.php with userid
        }

        // Submit the delete form when the modal's "Delete" button is clicked
        $('#delmgt').on('click', '#deleteMgtForm .btn-danger', function() {
          var mgtId = document.getElementById("deleteMgtId").value;
          deleteMgt(mgtId);
        });

        document.getElementById("deleteMgtForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the user ID from the hidden input field
        var mgtId = document.getElementById("deleteMgtId").value;

        fetch("mgtdelete_mgt.php", {
          method: "POST",
          body: new URLSearchParams({
            userid: mgtId
          }),
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          }
        })
        .then(response => response.text())
        .then(data => {
          // Close the modal after successful deletion
          $('#delmgt').modal('hide');
          loadMgt();

          // Show success toast
          var toastLiveExample = document.getElementById('liveToast');
          var toast = new bootstrap.Toast(toastLiveExample);
          toast.show();
        });
      });
        // Initial load of mgt when the page loads
        loadMgt();
    </script>
    
  </body>
</html>
