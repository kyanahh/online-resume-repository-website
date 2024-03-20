<?php

session_start();

require("server/connection.php");

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["firstname"])){
      $textaccount = strtoupper($_SESSION["firstname"]);
      $skills = $_SESSION["skills"];

    }else{
        $textaccount = "Account";
    }
}else{
    $textaccount = "Account";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $skills = $_POST["skills"];

  $updateQuery = "UPDATE users SET skills = '$skills' WHERE email = '$email'";
  if($connection->query($updateQuery)) {
      // Redirect to the profile page or wherever you want
      header("Location: settings.php");
      $errorMessage = "Saved changes.";
      exit; // Ensure that no further code is executed after redirection
  } else {
      $errorMessage = "Failed to upload skills. Please try again later.";
  }
 

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <style>
      .list-unstyled li::marker {
        content: none; /* Hide the marker (bullet) */
      }
    </style>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
    />
    <link
      rel="stylesheet"
      href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"
    />
    <title>VocoEase</title>
  </head>

  <body class="bg-light">
    <!-- Navbar-->
    <nav class="px-5 py-2 mx-auto bg-white navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <!-- Logo -->
        <div class="d-flex justify-content-start">
          <a class="navbar-brand" href="candidatelandingpage.php">
            <img style="height: 70px" src="img/logoname.png" alt="VocoEase" />
          </a>
        </div>

        <!-- Toggle button-->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar directory -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a
                class="nav-link active fw-bold me-4"
                aria-current="page"
                href="candidatelandingpage.php"
                >HOME</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-bold me-4" href="candidateabout.php"
                >ABOUT</a
              >
            </li>
            <li class="nav-item">
              <a
                class="nav-link active fw-bold me-4"
                href="candidateservices.php"
                >SERVICES</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-bold" href="candidatecontact.php"
                >CONTACT</a
              >
            </li>
          </ul>

          <!-- Dropdown / Account-->
          <div class="nav-item dropdown me-5">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              role="button"
              data-bs-toggle="dropdown"
              aria-expanded="false"
              >Account</a
            >
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="settings.php">Settings</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <li><hr class="dropdown-divider" /></li>
              <li>
                <a class="dropdown-item"
                  >Hi,
                  <?php echo $textaccount; ?></a
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>

    <div class="container-fluid my-5 pt-5 d-flex justify-content-center">
        <div class="card col-sm-8 p-4 ms-3 mt-4">
            <div class="card-title h3 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <a href="profile.php" class="text-decoration-none text-dark pe-3">
                    <i class="bi bi-arrow-left-circle fs-2"></i></a>Skills
                </div>
                <a class="text-decoration-none text-secondary" href="" role="button" data-bs-toggle="modal"
                data-bs-target="#addskill"><i class="bi bi-plus fs-1"></i></a>
            </div>
            <div class="card-body">
                <ul id="skillsList" class="list-unstyled">
                    
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="container-fluid" style="background-color: #001c31">
      <div class="row mx-5 p-5">
        <!-- 1st Col -->
        <div class="col-sm-5" style="color: #9fa6af">
          <h6 class="text-white">Contact Info</h6>
          <ul class="list-unstyled mt-3">
            <li>
              <div class="d-flex">
                <i class="bi bi-geo-alt me-3" style="font-size: x-large"></i>
                <pre style="font-family: Arial, Helvetica, sans-serif">
8 The Green, STE A Dover DE 19901
United States of America</pre
                >
              </div>
            </li>
            <li>
              <div class="d-flex">
                <i class="bi bi-telephone me-3" style="font-size: x-large"></i>
                <p
                  style="font-family: Arial, Helvetica, sans-serif"
                  class="mt-2"
                >
                  +1 (302) 608-6263
                </p>
              </div>
            </li>
          </ul>
        </div>

        <!-- 2nd Col -->
        <div class="col-sm-4">
          <h6 class="text-white">Quick Links</h6>
          <ul class="list-unstyled">
            <li>
              <a
                href="candidatelandingpage.php"
                class="text-decoration-none ms-2 mt2"
                style="color: #9fa6af"
                >Introduction</a
              >
            </li>
            <li>
              <a
                href="candidateabout.php"
                class="text-decoration-none ms-2 mt2"
                style="color: #9fa6af"
                >Organization Team</a
              >
            </li>
          </ul>
        </div>

        <!-- 3rd Col -->
        <div class="col-sm-3">
          <h6 class="text-white">Important Links</h6>

          <ul class="list-unstyled ms-3" style="color: #9fa6af">
            <!-- Button trigger modal 1 -->
            <li>
              <a
                role="button"
                data-bs-toggle="modal"
                data-bs-target="#privacypolicy"
              >
                Privacy Policy
              </a>
            </li>
            <!-- Button trigger modal 2 -->
            <li>
              <a
                role="button"
                data-bs-toggle="modal"
                data-bs-target="#cookiespolicy"
              >
                Cookies Policy
              </a>
            </li>
            <!-- Button trigger modal 3 -->
            <li>
              <a role="button" data-bs-toggle="modal" data-bs-target="#terms1">
                Terms and Conditions
              </a>
            </li>
          </ul>

          <!-- Add Skill Modal -->
          <div
            class="modal fade"
            id="addskill"
            tabindex="-1"
            aria-labelledby="addskill1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="addskill1">
                    Add Skill
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <form id="addSkillForm" method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>" enctype="multipart/form-data">
                  <div class="row px-3">
                    <input type="text" class="form-control" name="skills"  id="skills" placeholder="Enter skill name" required>
                    <p id="addSkillMessage" class="text-danger pt-2"></p>
                  </div>
                </div>
                <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Add Skill</button>
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

          <!-- Delete Skill Modal -->
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

          <!-- Modal 1 -->
          <div
            class="modal fade"
            id="privacypolicy"
            tabindex="-1"
            aria-labelledby="privacypolicy1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="privacypolicy1">
                    Privacy Policy
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <p class="fw-bold">Information We Collect</p>
                  <p>
                    – Personal Information: When you sign up or use our
                    services, we collect information such as your name, email
                    address, contact information, and billing details if
                    applicable. – Non-Personal Information: We may gather
                    non-personal information, including browser type, IP
                    address, device information, and usage data. This data is
                    collected to improve our services and user experience.
                  </p>
                  <p class="fw-bold pt-2">How We Use Your Information</p>
                  <p>
                    – To Provide and Maintain the Service: We use your personal
                    information to create and manage your account, provide
                    customer support, and fulfill requests for our services. –
                    To Improve and Customize the Service: We analyze user
                    behavior to enhance our service, personalize content, and
                    recommend features that may interest you. – To Communicate
                    with You: We may use your contact information to send you
                    updates, newsletters, promotional content, or respond to
                    your inquiries. You can opt out of these communications at
                    any time. – To Comply with Legal Obligations: We may use
                    your information to meet legal requirements, such as tax
                    reporting, fraud prevention, and responding to legal
                    requests or court orders.
                  </p>
                  <p class="fw-bold pt-2">Data Sharing</p>
                  <p>
                    – We do not sell, trade, or rent your personal information
                    to third parties. We may share your information with third
                    parties only in the following circumstances: – Service
                    Providers: We may share your information with trusted
                    service providers, subcontractors, and business partners who
                    assist us in delivering our services. These parties are
                    obligated to keep your information confidential and secure.
                    – Legal Compliance: We may share information if required to
                    comply with applicable laws, regulations, or legal
                    processes. – Business Transfers: If VocoEase PH undergoes a
                    merger, acquisition, or sale of all or part of its assets,
                    your information may be transferred as part of the deal. You
                    will be notified via email or a prominent notice on our
                    website of any change in ownership or use of your
                    information.
                  </p>
                  <p class="fw-bold pt-2">Cookies</p>
                  <p>
                    – We use cookies and similar tracking technologies to
                    collect information about your activities on our website.
                    Cookies are small text files stored on your device. They
                    help us provide and improve our services by, for example,
                    remembering your preferences, analyzing trends, and
                    monitoring the effectiveness of our marketing campaigns.
                  </p>
                  <p class="fw-bold pt-2">Security</p>
                  <p>
                    – We take reasonable steps to protect your information from
                    unauthorized access, disclosure, alteration, or destruction.
                    However, no method of data transmission over the internet is
                    100% secure, and we cannot guarantee the absolute security
                    of your data.
                  </p>
                  <p class="fw-bold pt-2">Third-Party Links</p>
                  <p>
                    – Our Service may contain links to third-party websites,
                    services, or advertisements. We are not responsible for the
                    privacy practices, content, or security of these sites.
                    Please review the privacy policies and terms of use of any
                    third-party websites you visit.
                  </p>
                  <p class="fw-bold pt-2">Children’s Privacy</p>
                  <p>
                    – VocoEase PH does not knowingly collect personal
                    information from individuals under the age of 13. If you
                    believe a child has provided us with personal information,
                    please contact us, and we will take appropriate steps to
                    delete that information.
                  </p>
                  <p class="fw-bold pt-2">Changes to Privacy Policy</p>
                  <p>
                    – We may update our Privacy Policy from time to time. Any
                    changes will be posted on this page, and the “Last Updated”
                    date at the top of the policy will be revised accordingly.
                    We encourage you to review our Privacy Policy periodically.
                  </p>
                  <p class="fw-bold pt-2">Contact Information</p>
                  <p>
                    – If you have questions, concerns, or requests related to
                    our Privacy Policy or your personal information, please
                    contact us at info@vocoease.ph.
                  </p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal 2 -->
          <div
            class="modal fade"
            id="cookiespolicy"
            tabindex="-1"
            aria-labelledby="cookiespolicy1"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="cookiespolicy1">
                    Cookies Policy
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <p class="fw-bold">Information We Collect</p>
                  <p>
                    – Personal Information: When you sign up or use our
                    services, we collect information such as your name, email
                    address, contact information, and billing details if
                    applicable. – Non-Personal Information: We may gather
                    non-personal information, including browser type, IP
                    address, device information, and usage data. This data is
                    collected to improve our services and user experience.
                  </p>
                  <p class="fw-bold pt-2">How We Use Your Information</p>
                  <p>
                    – To Provide and Maintain the Service: We use your personal
                    information to create and manage your account, provide
                    customer support, and fulfill requests for our services. –
                    To Improve and Customize the Service: We analyze user
                    behavior to enhance our service, personalize content, and
                    recommend features that may interest you. – To Communicate
                    with You: We may use your contact information to send you
                    updates, newsletters, promotional content, or respond to
                    your inquiries. You can opt out of these communications at
                    any time. – To Comply with Legal Obligations: We may use
                    your information to meet legal requirements, such as tax
                    reporting, fraud prevention, and responding to legal
                    requests or court orders.
                  </p>
                  <p class="fw-bold pt-2">Data Sharing</p>
                  <p>
                    – We do not sell, trade, or rent your personal information
                    to third parties. We may share your information with third
                    parties only in the following circumstances: – Service
                    Providers: We may share your information with trusted
                    service providers, subcontractors, and business partners who
                    assist us in delivering our services. These parties are
                    obligated to keep your information confidential and secure.
                    – Legal Compliance: We may share information if required to
                    comply with applicable laws, regulations, or legal
                    processes. – Business Transfers: If VocoEase PH undergoes a
                    merger, acquisition, or sale of all or part of its assets,
                    your information may be transferred as part of the deal. You
                    will be notified via email or a prominent notice on our
                    website of any change in ownership or use of your
                    information.
                  </p>
                  <p class="fw-bold pt-2">Cookies</p>
                  <p>
                    – We use cookies and similar tracking technologies to
                    collect information about your activities on our website.
                    Cookies are small text files stored on your device. They
                    help us provide and improve our services by, for example,
                    remembering your preferences, analyzing trends, and
                    monitoring the effectiveness of our marketing campaigns.
                  </p>
                  <p class="fw-bold pt-2">Security</p>
                  <p>
                    – We take reasonable steps to protect your information from
                    unauthorized access, disclosure, alteration, or destruction.
                    However, no method of data transmission over the internet is
                    100% secure, and we cannot guarantee the absolute security
                    of your data.
                  </p>
                  <p class="fw-bold pt-2">Third-Party Links</p>
                  <p>
                    – Our Service may contain links to third-party websites,
                    services, or advertisements. We are not responsible for the
                    privacy practices, content, or security of these sites.
                    Please review the privacy policies and terms of use of any
                    third-party websites you visit.
                  </p>
                  <p class="fw-bold pt-2">Children’s Privacy</p>
                  <p>
                    – VocoEase PH does not knowingly collect personal
                    information from individuals under the age of 13. If you
                    believe a child has provided us with personal information,
                    please contact us, and we will take appropriate steps to
                    delete that information.
                  </p>
                  <p class="fw-bold pt-2">Changes to Privacy Policy</p>
                  <p>
                    – We may update our Privacy Policy from time to time. Any
                    changes will be posted on this page, and the “Last Updated”
                    date at the top of the policy will be revised accordingly.
                    We encourage you to review our Privacy Policy periodically.
                  </p>
                  <p class="fw-bold pt-2">Contact Information</p>
                  <p>
                    – If you have questions, concerns, or requests related to
                    our Privacy Policy or your personal information, please
                    contact us at info@vocoease.ph.
                  </p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal 3 -->
          <div
            class="modal fade"
            id="terms1"
            tabindex="-1"
            aria-labelledby="terms2"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-4 fw-bold" id="terms2">
                    Terms & Conditions
                  </h1>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                  ></button>
                </div>
                <div class="modal-body">
                  <p class="fw-bold">Information We Collect</p>
                  <p>
                    – Personal Information: When you sign up or use our
                    services, we collect information such as your name, email
                    address, contact information, and billing details if
                    applicable. – Non-Personal Information: We may gather
                    non-personal information, including browser type, IP
                    address, device information, and usage data. This data is
                    collected to improve our services and user experience.
                  </p>
                  <p class="fw-bold pt-2">How We Use Your Information</p>
                  <p>
                    – To Provide and Maintain the Service: We use your personal
                    information to create and manage your account, provide
                    customer support, and fulfill requests for our services. –
                    To Improve and Customize the Service: We analyze user
                    behavior to enhance our service, personalize content, and
                    recommend features that may interest you. – To Communicate
                    with You: We may use your contact information to send you
                    updates, newsletters, promotional content, or respond to
                    your inquiries. You can opt out of these communications at
                    any time. – To Comply with Legal Obligations: We may use
                    your information to meet legal requirements, such as tax
                    reporting, fraud prevention, and responding to legal
                    requests or court orders.
                  </p>
                  <p class="fw-bold pt-2">Data Sharing</p>
                  <p>
                    – We do not sell, trade, or rent your personal information
                    to third parties. We may share your information with third
                    parties only in the following circumstances: – Service
                    Providers: We may share your information with trusted
                    service providers, subcontractors, and business partners who
                    assist us in delivering our services. These parties are
                    obligated to keep your information confidential and secure.
                    – Legal Compliance: We may share information if required to
                    comply with applicable laws, regulations, or legal
                    processes. – Business Transfers: If VocoEase PH undergoes a
                    merger, acquisition, or sale of all or part of its assets,
                    your information may be transferred as part of the deal. You
                    will be notified via email or a prominent notice on our
                    website of any change in ownership or use of your
                    information.
                  </p>
                  <p class="fw-bold pt-2">Cookies</p>
                  <p>
                    – We use cookies and similar tracking technologies to
                    collect information about your activities on our website.
                    Cookies are small text files stored on your device. They
                    help us provide and improve our services by, for example,
                    remembering your preferences, analyzing trends, and
                    monitoring the effectiveness of our marketing campaigns.
                  </p>
                  <p class="fw-bold pt-2">Security</p>
                  <p>
                    – We take reasonable steps to protect your information from
                    unauthorized access, disclosure, alteration, or destruction.
                    However, no method of data transmission over the internet is
                    100% secure, and we cannot guarantee the absolute security
                    of your data.
                  </p>
                  <p class="fw-bold pt-2">Third-Party Links</p>
                  <p>
                    – Our Service may contain links to third-party websites,
                    services, or advertisements. We are not responsible for the
                    privacy practices, content, or security of these sites.
                    Please review the privacy policies and terms of use of any
                    third-party websites you visit.
                  </p>
                  <p class="fw-bold pt-2">Children’s Privacy</p>
                  <p>
                    – VocoEase PH does not knowingly collect personal
                    information from individuals under the age of 13. If you
                    believe a child has provided us with personal information,
                    please contact us, and we will take appropriate steps to
                    delete that information.
                  </p>
                  <p class="fw-bold pt-2">Changes to Privacy Policy</p>
                  <p>
                    – We may update our Privacy Policy from time to time. Any
                    changes will be posted on this page, and the “Last Updated”
                    date at the top of the policy will be revised accordingly.
                    We encourage you to review our Privacy Policy periodically.
                  </p>
                  <p class="fw-bold pt-2">Contact Information</p>
                  <p>
                    – If you have questions, concerns, or requests related to
                    our Privacy Policy or your personal information, please
                    contact us at info@vocoease.ph.
                  </p>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-bs-dismiss="modal"
                  >
                    Close
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer style="background-color: #0d1c2f" class="py-3">
      <div class="d-flex align-items-center">
        <p class="pt-3 ps-5" style="color: #404d5e">Copyright &copy; 2024</p>
        <a href="https://www.facebook.com/vocoeaseph?mibextid=ZbWKwL"
          ><i
            class="bi bi-facebook me-3"
            style="color: #9fa6af; padding-left: 1050px"
          ></i
        ></a>
        <a href="#"
          ><i class="bi bi-twitter me-3" style="color: #9fa6af"></i
        ></a>
        <a href="#"><i class="bi bi-instagram" style="color: #9fa6af"></i></a>
      </div>
    </footer>

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
        function displayDeleteModal(skillId) {
            document.getElementById('deleteSkillId').value = skillId;
            $('#delskill').modal('show'); // Show the delete skill modal
        }
    </script>

    <script>
        // JavaScript to handle form submission and dynamic skill addition/deletion
        document.getElementById("addSkillForm").addEventListener("submit", function(event) {
            event.preventDefault();
            var skills = document.getElementById("skills").value;

            fetch("add_skill.php", {
                method: "POST",
                body: new URLSearchParams({
                    skill_name: skills
                }),
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                }
            })
            .then(response => response.text())
            .then(data => {
                // Update the paragraph element with the response message
                document.getElementById("addSkillMessage").textContent = data;

                // If the skill was added successfully, reload the skills list
                if (data.trim() === "Skill added successfully.") {
                    loadSkills(); // Reload skills list
                }
            });
        });

        // Function to load skills from the database
        function loadSkills() {
            fetch("load_skills.php") // PHP script to load skills
            .then(response => response.json())
            .then(skills => {
                var skillsList = document.getElementById("skillsList");
                skillsList.innerHTML = ""; // Clear existing skills
                skills.forEach(skill => {
                    var listItem = document.createElement("li");
                    listItem.innerHTML = `
                        <div class='d-flex align-items-center justify-content-between'>
                            ${skill.skill_name}<button onclick="displayDeleteModal(1)" class="btn px-2"><i class="bi bi-x-lg" ></i></button>
                        </div>
                        <hr>
                    `;
                    skillsList.appendChild(listItem);
                });

                // Clear skills input field
                document.getElementById("skills").value = "";
            });
        }

      // JavaScript to handle form submission and dynamic skill addition/deletion
      document.getElementById("deleteSkillForm").addEventListener("submit", function(event) {
          event.preventDefault(); // Prevent default form submission
          var skillId = document.getElementById("deleteSkillId").value; // Get the skill id
          deleteSkill(skillId); // Call deleteSkill function with the skill id
      });

      // Function to delete a skill
      function deleteSkill(skillId) {
          if (confirm("Are you sure you want to delete this skill?")) {
              fetch("delete_skill.php", {
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
                  alert(data); // Show response message
                  loadSkills(); // Reload skills list
              });
          }
      }

        // Initial load of skills when the page loads
        loadSkills();
    </script>
    
  </body>
</html>
