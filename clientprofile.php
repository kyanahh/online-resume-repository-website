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
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="clientprofile.php">Profile</a></li>
                <li><a class="dropdown-item" href="clientresume.php">Candidate Skills</a></li>
                <li><a class="dropdown-item" href="clientsettings.php">Settings</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item">Hi, <?php echo $textaccount; ?></a></li>            
            </ul>
        </div>
        </div>
      </div>
    </nav>

    <div class="container-fluid my-5 pt-5">
      <div class="row ps-5">
        <!-- Col 1 -->
        <div
          class="card p-5 mt-4 col-sm-3 d-flex justify-content-center text-center align-self-start"
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
              <h6 class="mb-4" style="color: gray">Client</h6>
              <hr />
            </li>
          </ul>
        </div>
        <!-- Col 2 -->
        <div class="card col-sm-8 p-5 ms-3 mt-4">
          <ul class="col list-unstyled">
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
              <a href="clientsettings.php" class="btn btn-primary fw-bold col-sm-5"
                >EDIT PROFILE</a
              >
            </li>
            <li class="d-flex justify-content-center mt-2">
              <a
                href="clientchangepassword.php"
                class="btn btn-primary fw-bold col-sm-5"
                >CHANGE PASSWORD</a
              >
            </li>
            <!-- End -->
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
  </body>
</html>
