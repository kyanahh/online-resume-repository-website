<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <title>VocoEase</title>
</head>

<body style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
url('https://cdn-bnokp.nitrocdn.com/QNoeDwCprhACHQcnEmHgXDhDpbEOlRHH/assets/images/optimized/rev-c8a072e/www.decorilla.com/online-decorating/wp-content/uploads/2022/03/Modern-Office-Interior-with-Open-Floor-Plan-1536x1024.jpeg');
    height: 100vh; background-repeat: no-repeat; background-position: center; background-size: cover;">

  <!-- Navbar-->
  <nav class="px-5 py-2 mx-auto bg-white navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">

      <!-- Logo -->
      <div class="d-flex justify-content-start">
        <a class="navbar-brand" href="index.html">
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
            <a class="nav-link active fw-bold me-4" aria-current="page" href="index.html">HOME</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold me-4" href="about.html">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold me-4" href="services.html">SERVICES</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold" href="contact.html">CONTACT</a>
          </li>
        </ul>

        <a href="login.php" class="nav-link active fw-bold">Login<i class="bi bi-arrow-right-short"></i></a>

      </div>
      
    </div>
  </nav>

    <div class="container pt-5">
        <div class="pt-5 mt-1">
            <div class="card mt-5 mx-auto col-sm-7 p-4">
                <div class="mx-auto mb-3">
                    <img src="img/logonly.png" style="height: 50px;" alt="VocoEase">
                </div>
                <h5 class="card-title text-center">Register to VocoEase Resume Repository</h5>
                <div class="card-body">
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>">
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email address" required>
                            </div>
                            <div class="col">
                                <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="col">
                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col d-grid gap-2">
                            <?php
    
                                if (!empty($successMessage)) {
                                    echo "
                                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                                    ";
                                }
    
                            ?>
                                <button type="submit" class="btn btn-primary text-white mt-3 fw-bold">Sign Up</button>
                            </div>
                        </div>
                        <div class="row d-grid gap-2">
                                <p class="text-center mt-2">Already have an account?<a href="login.php" class="text-decoration-none"> Login here.</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>