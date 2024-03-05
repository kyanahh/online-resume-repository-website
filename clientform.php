<?php

session_start();

require("server/connection.php");

$firstname = $lastname = $state = $country = $email = $phone = $company = $message = $agreement = $errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $firstname =  ucwords($_POST["firstname"]);
  $lastname =  ucwords($_POST["lastname"]);
  $state = ucwords($_POST["state"]);
  $country = ucwords($_POST["country"]);
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $company = ucwords($_POST["company"]);
  $message = $_POST["message"];
  $agreement = $_POST["agreement"];

  if (isset($_POST["agreement"]) && $_POST["agreement"] == "on") {

    $agreement = 1;
    $insertQuery = "INSERT INTO clientform (firstname, lastname, state, country, email, phone, company, message, agreement) VALUES ('$firstname', '$lastname', '$state', '$country', '$email', '$phone', '$company', '$message', '$agreement')";
    $result = $connection->query($insertQuery);

    if (!$result) {
      $errorMessage = "Invalid query " . $connection->error;
    } else {
      $errorMessage = "Thank you for contacting us, we will be in touch shortly.";
      // Reset form fields
      $firstname = $lastname = $state = $country = $email = $phone = $company = $message = $agreement = "";
    }
    
  }else{
    $errorMessage = "Consent is required";
  }

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
    <link rel="stylesheet" type="text/css" href="style.css" />
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

  <body>
    <!-- Navbar-->
    <nav class="px-5 py-2 mx-auto bg-white navbar navbar-expand-lg fixed-top">
      <div class="container-fluid">
        <!-- Logo -->
        <div class="d-flex justify-content-start">
          <a class="navbar-brand" href="index.html">
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
                href="index.html"
                >HOME</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-bold me-4" href="about.html"
                >ABOUT</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-bold me-4" href="services.html"
                >SERVICES</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-bold" href="contact.html">CONTACT</a>
            </li>
          </ul>

          <a href="login.php" class="nav-link active fw-bold me-5"
            >Login<i class="bi bi-arrow-right-short"></i
          ></a>
        </div>
      </div>
    </nav>

    <!-- Card Client Form -->
    <div class="container-fluid pt-5 mt-4" style="background-color: #041c34">
      <div class="card bg-light mt-5 px-5 py-4 col-lg-8 mx-auto">
        <h5 class="fw-bold card-title">Client Contact Form</h5>
        <div class="card-body">
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
          <form action="<?php htmlspecialchars("SELF_PHP"); ?>" method="POST">
            <!-- Row 1 First Name and Last Name-->
            <div class="row">
              <div class="col mb-3">
                <label for="firstname" class="form-label">First Name*</label>
                <input
                  type="text"
                  class="form-control"
                  id="firstname"
                  placeholder="E.g. John"
                  value="<?php echo $firstname; ?>"
                  name="firstname"
                  required
                />
              </div>
              <div class="col mb-3">
                <label for="lastname" class="form-label">Last Name*</label>
                <input
                  type="text"
                  class="form-control"
                  id="lastname"
                  placeholder="E.g. Doe"
                  name="lastname"
                  value="<?php echo $lastname; ?>"
                  required
                />
              </div>
            </div>

            <!-- Row 2 State and Country -->
            <div class="row">
              <div class="col mb-3">
                <label for="state" class="form-label">State/Province*</label>
                <input
                  type="text"
                  class="form-control"
                  id="state"
                  name="state"
                  placeholder="E.g. New South Wales"
                  value="<?php echo $state; ?>"
                  required
                />
              </div>
              <div class="col mb-3">
                  <label for="country" class="form-label">Country*</label>
                  <select class="form-select" id="country" aria-label="Default select example" required>
                      <option selected disabled>Select a Country</option>
                      <!-- Countries will be populated dynamically via JavaScript -->
                  </select>
                  <!-- Hidden input field to store the selected country value -->
                  <input type="hidden" id="selectedCountry" name="country" required>
              </div>
            </div>

            <!-- Row 3 Email Address and Phone Number -->
            <div class="row">
              <div class="col mb-3">
                <label for="email" class="form-label">Email Address*</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="E.g. john@doe.com"
                  value="<?php echo $email; ?>"
                  required
                />
              </div>
              <div class="col mb-3">
                <label for="phone" class="form-label">Phone Number*</label>
                <input
                  type="text"
                  class="form-control"
                  id="phone"
                  name="phone"
                  placeholder="E.g. +1 3004005000"
                  value="<?php echo $phone; ?>"
                  required
                />
              </div>
            </div>

            <!-- Row 4 Company -->
            <div class="row">
              <div class="mb-3">
                <label for="company" class="form-label">Company Name*</label>
                <input type="text" class="form-control" id="company" name="company" value="<?php echo $company; ?>" required  />
              </div>
            </div>

            <!-- Row 5 Message -->
            <div class="row">
              <div class="mb-3">
                <label for="message" class="form-label">Message*</label>
                <textarea
                  class="form-control"
                  id="message"
                  rows="5"
                  name="message"
                  placeholder="Enter your message here..."
                  value="<?php echo $message; ?>"
                  required
                ></textarea>
              </div>
            </div>

            <!-- Row 6 Checkbox -->            
            <div class="row ms-1">
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required />
                <label class="form-check-label" for="agreement"
                  >Yes, I have read and agree with the <a role="button" data-bs-toggle="modal" 
                  data-bs-target="#privacypolicy" style="color: blue">Privacy Policy</a> and  
                  <a role="button" data-bs-toggle="modal" 
                  data-bs-target="#terms1" style="color: blue">Terms
                  & Conditions</a></label
                >
              </div>
            </div>

            <!-- Button Submit  --> 
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>

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
                href="index.html"
                class="text-decoration-none ms-2 mt2"
                style="color: #9fa6af"
                >Introduction</a
              >
            </li>
            <li>
              <a
                href="about.html"
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

    <script>
      // Fetch countries data from the REST Countries API
      fetch('https://restcountries.com/v3.1/all')
        .then(response => response.json())
        .then(data => {
            // Sort countries alphabetically
            data.sort((a, b) => a.name.common.localeCompare(b.name.common));

            const selectElement = document.getElementById('country');

            // Iterate over the sorted countries data and populate the dropdown
            data.forEach(country => {
                const option = document.createElement('option');
                option.value = country.name.common;
                option.textContent = country.name.common;
                selectElement.appendChild(option);
            });

            // Add event listener to the select element to capture the selected value
            selectElement.addEventListener('change', function() {
                const selectedValue = this.value;
                document.getElementById('selectedCountry').value = selectedValue;
            });
        })
        .catch(error => {
            console.error('Error fetching countries data:', error);
        });
    </script>
  </body>
</html>
