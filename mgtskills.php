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
            <h5>Candidate Skills</h5>
          </nav>

          <hr />
          <!-- List of User Logs -->
          <div class="px-3">
                <div class="row d-flex">
                    <div class="col input-group mb-3">
                        <input type="text" class="form-control" id="searchSkillsInput" onchange="searchSkills()" placeholder="Search" aria-describedby="button-addon2">
                    </div>
                    <div class="col-sm-1">
                      <a href="mgtskills.php" class="btn btn-dark px-4"><i class="bi bi-arrow-clockwise"></i></a>
                    </div>
                    <div class="col-sm-1">
                      <a href="mgtaddskills.php" class="btn btn-dark px-4"><i class="bi bi-plus-lg"></i></a>
                    </div>                     
                </div>
                
                <div class="card" style="height: 450px;">
                    <div class="card-body">
                        <div class="table-responsive" style="height: 420px;">
                            <table id="skills-table" class="table table-bordered table-hover">
                                <thead class="table-light" style="position: sticky; top: 0;">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">User ID</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Skills</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="skillsList">

                                </tbody>                                
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Search results will be displayed here -->
                <div id="search-results"></div>
            </div>
            <!-- End of List of Skills -->
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
                Skill deleted.
              </div>
            </div>
          </div>

          <!-- Delete Skills Modal -->
          <div
            class="modal fade"
            id="delskill"
            tabindex="-1"
            aria-labelledby="delskill1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="delskill1">
                    Delete Skill
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                <form id="deleteSkillForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="hidden" id="deleteSkillId" name="skill_id">
                    <p class="pt-2">Are you sure you want to delete this skill?</p>
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

          <!-- Edit Skills Modal -->
          <div
            class="modal fade"
            id="editskill"
            tabindex="-1"
            aria-labelledby="editskill1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="editskill1">
                    Edit Skill
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                <form id="editSkillForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                    <input type="text" id="editSkillId" name="skill_id" value="<?php echo $skill_id; ?>">
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

                //---------------------------Search Skills Results---------------------------//
                function searchSkills() {
                    const query = document.getElementById("searchSkillsInput").value;
                    // Make an AJAX request to fetch search results
                    $.ajax({
                        url: 'search_mgtskills.php', // Replace with the actual URL to your search script
                        method: 'POST',
                        data: { query: query },
                        success: function(data) {
                            // Update the user-table with the search results
                            $('#skills-table tbody').html(data);
                        }
                    });
                }

            </script>

    <script>
        // Function to display the delete modal with the correct skill ID
        function displayDeleteModal(skillId) {
          document.getElementById('deleteSkillId').value = skillId;
          $('#delskill').modal('show');
        }

        // Handle form submission for deleting a skill
        document.getElementById("deleteSkillForm").addEventListener("submit", function(event) {
          event.preventDefault(); // Prevent default form submission
          // Modal will handle deletion using JavaScript
        });


        // Function to display the edit modal with the correct skill ID
        function displayEditModal(skillId) {
        fetch(`mgtget_skill.php?skill_id=${skillId}`)
          .then(response => response.json())
          .then(skill => {
            document.getElementById('editSkillId').value = skill.id;
            document.getElementById('editSkillName').value = skill.skill_name;
            $('#editskill').modal('show');
          });
      }
        
        // Submit the edit form when the modal's "Save" button is clicked
        $('#editskill').on('submit', '#editSkillForm', function(event) {
          event.preventDefault(); // Prevent default form submission
          editSkill();
        });
    </script>

    <script>
      // Function to load mgt from the database
      function loadSkills() {
            fetch("mgtload_skills.php") // PHP script to load skills
            .then(response => response.json())
            .then(skills => {
                var skillsList = document.getElementById("skillsList");
                skillsList.innerHTML = ""; // Clear existing skills
                skills.forEach(skill => {
                    var listItem = document.createElement("tr");
                    listItem.innerHTML = `
                      <tr>
                        <td>${skill.id}</td>
                        <td>${skill.userid}</td>
                        <td>${skill.lastname}</td>
                        <td>${skill.firstname}</td>
                        <td>${skill.skill_name}</td>
                        <td class='d-flex align-items-center'>
                        <button onclick="displayEditModal(${skill.id})" class="btn btn-primary me-2">Edit
                        </button>
                        <button onclick="displayDeleteModal(${skill.id})" class="btn btn-danger">Delete
                        </button></td>
                      </tr>
                    `;
                    skillsList.appendChild(listItem);
                });

                // Clear skills input field
                document.getElementById("skills").value = "";
            });
        }

        // Submit the delete form when the modal's "Delete" button is clicked
        $('#delskill').on('click', '#deleteSkillForm .btn-danger', function() {
          var skillId = document.getElementById("deleteSkillId").value;
          deleteSkill(skillId);
        });

        document.getElementById("deleteSkillForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent default form submission

        // Get the user ID from the hidden input field
        var skillId = document.getElementById("deleteSkillId").value;

        fetch("mgtdelete_skills.php", {
          method: "POST",
          body: new URLSearchParams({
            skill_id: skillId
          }),
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          }
        })
        .then(response => response.text())
        .then(data => {
          // Close the modal after successful deletion
          $('#delskill').modal('hide');
          loadSkills();

          // Show success toast
          var toastLiveExample = document.getElementById('liveToast');
          var toast = new bootstrap.Toast(toastLiveExample);
          toast.show();
        });
      });

      // EDIT SKILL 
      function editSkill() {
        var skillId = document.getElementById("editSkillId").value;
        var skillName = document.getElementById("editSkillName").value;

        fetch("mgtedit_skills.php", {
          method: "POST",
          body: new URLSearchParams({
            skill_id: skillId,
            skill_name: skillName
          }),
          headers: {
            "Content-Type": "application/x-www-form-urlencoded"
          }
        })
        .then(response => response.text())
        .then(data => {
          // Close the modal after successful edit
          $('#editskill').modal('hide');
          loadSkills();

          // Show success toast
          var toastLiveExample = document.getElementById('liveToast');
          var toast = new bootstrap.Toast(toastLiveExample);
          toast.show();
          toast.text = "Changes saved.";
        });
      }

        // Initial load of skills when the page loads
        loadSkills();
    </script>

  </body>
</html>
