<?php

session_start();

require("server/connection.php");

if(isset($_SESSION["logged_in"])){
    if(isset($_SESSION["firstname"])){
        $textaccount = $_SESSION["firstname"];
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
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

  <title>VocoEase</title>
</head>

<body>

  <!-- Navbar-->
  <nav class="px-5 py-2 mx-auto bg-white navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">

      <!-- Logo -->
      <div class="d-flex justify-content-start">
        <a class="navbar-brand" href="candidatelandingpage.php">
          <img style="height: 70px;" src="img/logoname.png" alt="VocoEase">
        </a>
      </div>

      <!-- Toggle button-->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar directory -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item">
            <a class="nav-link active fw-bold me-4" aria-current="page" href="candidatelandingpage.php">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold me-4" href="candidateabout.php">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold me-4" href="candidateservices.php">SERVICES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold" href="candidatecontact.php">CONTACT</a>
          </li>
        </ul>

        <!-- Dropdown / Account-->
        <div class="nav-item dropdown me-5">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
            <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item">Hi, <?php echo $textaccount; ?></a></li>            
            </ul>
        </div>
      </div>
      
    </div>
  </nav>

  <!-- Carousel / Slideshow images -->
  <div
      id="carouselExampleSlidesOnly"
      class="carousel slide carousel-fade"
      data-bs-ride="carousel"
    >
      <div class="carousel-inner">
        <!-- First pic -->
        <div class="carousel-item active">
          <img
            src="img/11.jpg"
            class="d-block w-100 h-100"
            aria-current="true"
            aria-label="Slide 1"
            data-bs-interval="300"
            alt="VocoEase"
          />

          <!-- Carousel Caption -->
          <div class="carousel-caption top-0 ms-n6 mt-9">
            <div class="row">
              <pre
                class="fw-bold display-4 text-start"
                style="
                  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
                    sans-serif;
                "
              >
Choose us to
access the finest
talent for your team!</pre
              >
            </div>
            <div class="row">
              <pre
                class="text-start"
                style="font-family: Arial, Helvetica, sans-serif"
              >
VocoEase is a distinguished firm specializing in the provision of technical
support and customer service staffing solutions for a diverse range of
organizations.</pre
              >
              <div class="row mt-2">
                <div class="col-sm-2 ms-n1">
                  <a
                    href="about.html"
                    class="btn btn-outline-light fw-bold px-4 py-2"
                    >Learn More</a
                  >
                </div>
                <div class="col-sm-3 ms-n2">
                  <a
                    href="services.html"
                    class="btn btn-outline-light px-4 py-2 fw-bold"
                    >See Our Services</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 2nd pic -->
        <div class="carousel-item">
          <img
            src="img/12.jpg"
            class="d-block w-100"
            data-bs-interval="300"
            alt="VocoEase"
          />

          <!-- Carousel Caption -->
          <div class="carousel-caption top-0 ms-n6 mt-9">
            <div class="row">
              <pre
                class="fw-bold display-4 text-start"
                style="
                  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
                    sans-serif;
                "
              >
Choose us to
access the finest
talent for your team!</pre
              >
            </div>
            <div class="row">
              <pre
                class="text-start"
                style="font-family: Arial, Helvetica, sans-serif"
              >
VocoEase is a distinguished firm specializing in the provision of technical
support and customer service staffing solutions for a diverse range of
organizations.</pre
              >
              <div class="row mt-2">
                <div class="col-sm-2 ms-n1">
                  <a
                    href="about.html"
                    class="btn btn-outline-light fw-bold px-4 py-2"
                    >Learn More</a
                  >
                </div>
                <div class="col-sm-3 ms-n2">
                  <a
                    href="services.html"
                    class="btn btn-outline-light px-4 py-2 fw-bold"
                    >See Our Services</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 3rd pic -->
        <div class="carousel-item">
          <img
            src="img/13.jpg"
            class="d-block w-100"
            data-bs-interval="300"
            alt="VocoEase"
          />

          <!-- Carousel Caption -->
          <div class="carousel-caption top-0 ms-n6 mt-9">
            <div class="row">
              <pre
                class="fw-bold display-4 text-start"
                style="
                  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
                    sans-serif;
                "
              >
Choose us to
access the finest
talent for your team!</pre
              >
            </div>
            <div class="row">
              <pre
                class="text-start"
                style="font-family: Arial, Helvetica, sans-serif"
              >
VocoEase is a distinguished firm specializing in the provision of technical
support and customer service staffing solutions for a diverse range of
organizations.</pre
              >
              <div class="row mt-2">
                <div class="col-sm-2 ms-n1">
                  <a
                    href="about.html"
                    class="btn btn-outline-light fw-bold px-4 py-2"
                    >Learn More</a
                  >
                </div>
                <div class="col-sm-3 ms-n2">
                  <a
                    href="services.html"
                    class="btn btn-outline-light px-4 py-2 fw-bold"
                    >See Our Services</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- 4th pic -->
        <div class="carousel-item">
          <img
            src="img/14.jpg"
            class="d-block w-100"
            data-bs-interval="300"
            alt="VocoEase"
          />

          <!-- Carousel Caption -->
          <div class="carousel-caption top-0 ms-n6 mt-9">
            <div class="row">
              <pre
                class="fw-bold display-4 text-start"
                style="
                  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
                    sans-serif;
                "
              >
Choose us to
access the finest
talent for your team!</pre
              >
            </div>
            <div class="row">
              <pre
                class="text-start"
                style="font-family: Arial, Helvetica, sans-serif"
              >
VocoEase is a distinguished firm specializing in the provision of technical
support and customer service staffing solutions for a diverse range of
organizations.</pre
              >
              <div class="row mt-2">
                <div class="col-sm-2 ms-n1">
                  <a
                    href="about.html"
                    class="btn btn-outline-light fw-bold px-4 py-2"
                    >Learn More</a
                  >
                </div>
                <div class="col-sm-3 ms-n2">
                  <a
                    href="services.html"
                    class="btn btn-outline-light px-4 py-2 fw-bold"
                    >See Our Services</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fluid mb-5">
      <!-- What we do start -->
      <h1
        class="fw-bold text-center pt-5"
        style="
          font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
            sans-serif;
        "
      >
        WHAT WE DO
      </h1>
      <pre
        class="text-center pt-2"
        style="font-family: Arial, Helvetica, sans-serif"
      >
As a well-established enterprise, we excel in providing tailored technical support and
customer service staffing solutions, catering to diverse businesses.
</pre
      >

      <!-- Cards Row 1 -->
      <div class="row mx-5 mt-5">
        <!-- Row 1 Col 1-->
        <div class="col">
          <div class="card text-center d-flex align-items-center p-5">
            <img
              src="img/worker1.png"
              alt="Worker"
              style="height: auto; width: 20%"
            />
            <h5 class="fw-bold pt-3">Client-Centric Support</h5>
            <h5 class="fw-bold">Services (Customer Service)</h5>
            <p class="pt-3">
              Our Customer Service offering is dedicated to delivering
              exceptional client support. We prioritize the satisfaction and
              needs of your customers by providing courteous, knowledgeable, and
              efficient service.
            </p>
          </div>
        </div>

        <!-- Row 1 Col 2-->
        <div class="col">
          <div class="card text-center d-flex align-items-center p-5">
            <img
              src="img/techsupport.png"
              alt="Worker"
              style="height: auto; width: 20%"
            />
            <h5 class="fw-bold pt-3">Expert Technical Assistance</h5>
            <h5 class="fw-bold">(Technical Support)</h5>
            <p class="pt-3">
              Our Technical Support services are designed to resolve technical
              issues promptly and effectively. We offer expertise in
              troubleshooting, resolving technical queries, and ensuring
              seamless operations.
            </p>
          </div>
        </div>

        <!-- Row 1 Col 3-->
        <div class="col">
          <div class="card text-center d-flex align-items-center p-5">
            <img
              src="img/outreach.png"
              alt="Worker"
              style="height: auto; width: 20%"
            />
            <h5 class="fw-bold pt-3">Proactive Outreach Services</h5>
            <h5 class="fw-bold">(Cold Calling)</h5>
            <p class="pt-3">
              Our Cold Calling services focus on expanding your outreach and
              lead generation efforts. We engage potential clients or prospects
              in meaningful conversations to explore new business opportunities.
            </p>
          </div>
        </div>
      </div>

      <!-- Cards Row 2 -->
      <div class="row mx-5 mt-3">
        <!-- Row 2 Col 1-->
        <div class="col">
          <div class="card text-center d-flex align-items-center p-5">
            <img
              src="img/va.png"
              alt="Worker"
              style="height: auto; width: 17%"
            />
            <h5 class="fw-bold pt-3">
              Administrative Efficiency Solutions (General Admin VA)
            </h5>
            <p class="pt-3">
              Our General Admin Virtual Assistant (VA) services are geared
              towards managing administrative tasks efficiently. We handle
              various administrative functions, allowing you to focus on
              strategic priorities.
            </p>
          </div>
        </div>

        <!-- Row 2 Col 1-->
        <div class="col">
          <div class="card text-center d-flex align-items-center p-5">
            <img
              src="img/graph.png"
              alt="Worker"
              style="height: auto; width: 17%"
            />
            <h5 class="fw-bold pt-3">
              Strategic Workforce Solutions (Manpower Outsourcing - Recruitment)
            </h5>
            <p class="pt-3">
              Our Manpower Outsourcing service specializes in finding and
              deploying qualified talent for your workforce needs. We manage the
              recruitment process, ensuring you have the right people for the
              job.
            </p>
          </div>
        </div>
      </div>
    </div>

    <!-- info about online repository website -->
    <div style="background-color: #001c31" class="p-5 mb-5">
      <h5 class="text-center text-white">
        Unlock Your Career Potential with VocoEase: Revolutionizing Resume
        Management for Today's Professionals!
      </h5>
    </div>

    <!--Empower part -->
    <div class="container-fluid text-center mb-5">
      <h3 class="fw-bold">Empower Your Team, Choose the</h3>
      <h3 class="fw-bold">Talent Stream!</h3>
      <pre class="pt-3" style="font-family: Arial, Helvetica, sans-serif">
Dive into excellence with us! Our freelancers bring top-tier skills without the
hassle of benefits or taxes. Imagine skilled professionals, equipped in
organized workspaces, dedicated to exceeding your expectations. Partner for
effortless and cost-effective collaboration. Your success starts here!</pre
      >
    </div>

    <!--Why Choose Us Part -->
    <div class="container-fluid p-5" style="background-color: #001c31">
      <h2
        class="fw-bold text-white text-center"
        style="
          font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial,
            sans-serif;
        "
      >
        Why choose us?
      </h2>
      <pre
        class="text-white pt-3 text-center"
        style="font-family: Arial, Helvetica, sans-serif"
      >
Our employees are freelancers, which means you don’t have to worry about providing
benefits or paying taxes for them.</pre
      >

      <!-- Cards Row 1 -->
      <div class="row mx-5 mt-5">
        <!-- Row 1 Col 1-->
        <div class="col-sm-4">
          <div class="card">
            <img
              src="img/filipinoworkers.jpg"
              alt="Filipino Workers"
              class="img-fluid"
            />
            <div class="card-body px-3">
              <h6 class="fw-bold pt-3 card-title">
                Unlocking Success: Harnessing the Power of a US-Based Team and
                Filipino Professionals for Remote Excellence
              </h6>
              <p class="pt-3">
                Discover the advantage of our US-based team powered by dedicated
                Filipino professionals. Our remote workforce offers flexibility
                without compromising exceptional service. Experience the
                benefits of top-tier talent working safely and conveniently from
                their homes, elevating the success of your projects.
              </p>
            </div>
          </div>
        </div>

        <!-- Row 1 Col 2-->
        <div class="col-sm-4">
          <div class="card">
            <img
              src="img/partnership4.jpg"
              alt="Partnership"
              class="img-fluid"
            />
            <div class="card-body mb-4">
              <h6 class="fw-bold pt-3">
                Tailored Solutions: Commitment, Precision, and Enduring Support
                for Your Business Success
              </h6>
              <p class="pt-3">
                Opt for our committed approach to your business goals. We tailor
                precise solutions, delivering high-caliber results consistently.
                Trust in enduring partnerships built on transparency and open
                communication, ensuring ongoing support as you grow.
              </p>
            </div>
          </div>
        </div>

        <!-- Row 1 Col 3-->
        <div class="col">
          <div class="card">
            <img src="img/teamwork1.jpg" alt="Teamwork" class="img-fluid" />
            <div class="card-body">
              <h6 class="fw-bold pt-3 mb-4">
                Fostering Success: Investing in Team Well-being for Client
                Satisfaction
              </h6>
              <p class="pt-3">
                At our core is a commitment to generously compensate our team,
                ensuring well-being and superior outcomes for satisfied clients.
                We invest in employee welfare and growth, fostering a positive
                workplace culture that benefits all stakeholders, including our
                esteemed clients.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Cards Row 2 -->
      <div class="row mx-5 mt-5">
        <!-- Row 2 Col 1-->
        <div class="col">
          <div class="card">
            <img src="img/freelancer.jpg" alt="Freelancer" class="img-fluid" />
            <div class="card-body">
              <h6 class="fw-bold pt-3">
                Seamless Collaboration: Unlocking Quality Work with Hassle-Free
                Freelancers
              </h6>
              <p class="pt-3">
                Experience hassle-free collaboration with skilled freelancers.
                Enjoy quality work without the burden of benefits or taxes. Our
                professionals, equipped with their own tools, are motivated to
                exceed your expectations. Partner with us for a cost-effective
                and seamless experience.
              </p>
            </div>
          </div>
        </div>

        <!-- Row 2 Col 2-->
        <div class="col">
          <div class="card">
            <img src="img/client1.png" alt="Partnership" class="img-fluid" />
            <div class="card-body">
              <h6 class="fw-bold pt-3">
                Talent Fusion: Elevating Excellence in Recruitment and Placement
              </h6>
              <p class="pt-3">
                Clients trust us for the most qualified candidates. We
                meticulously vet applicants, ensuring skills and experience
                match the job. Our commitment to top-tier staffing has earned a
                reputation for exceptional talent sourcing. We match individuals
                with roles, showcasing unwavering dedication to recruitment
                excellence.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="container-fluid my-5"
      style="padding-left: 110px; padding-right: 110px"
    >
      <div
        class="rounded text-center text-white pt-5"
        style="
          background-image: linear-gradient(
              rgba(0, 0, 0, 0.8),
              rgba(0, 0, 0, 0.8)
            ),
            url('img/meeting.jpg');
          background-repeat: no-repeat;
          background-position: center;
          background-size: cover;
          height: 70vh;
        "
      >
        <div class="pt-5">
          <h2 class="fw-bold pt-5">VocoEase is a better choice for you!</h2>
        </div>
        <pre class="pt-3" style="font-family: Arial, Helvetica, sans-serif">
Partner with us and experience hassle-free and cost-effective collaboration. We ensure
that our freelancers are motivated and driven to exceed your expectations.</pre
        >
        <a href="contact.html" class="btn btn-primary px-3 mt-2"
          >Reach out now</a
        >
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

        const myModal = document.getElementById("myModal");
        const myInput = document.getElementById("myInput");

        myModal.addEventListener("shown.bs.modal", () => {
            myInput.focus();
        });

    </script>
  </body>
</html>