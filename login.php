<?php

session_start();

require("server/connection.php");

$email = $password = "";

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $result = $connection->query("SELECT users.*, usertype.usertype FROM users INNER JOIN usertype ON users.usertypeid = usertype.usertypeid WHERE email = '$email' AND password = '$password'");

    if ($result->num_rows === 1) {
        $record = $result->fetch_assoc();

        // Fetch the usertypeid for the user
        $usertypeid = $record["usertypeid"];

        // Set session variables
        $_SESSION["userid"] = $record["userid"];
        $_SESSION["firstname"] = $record["firstname"];
        $_SESSION["lastname"] = $record["lastname"];
        $_SESSION["email"] = $record["email"];
        $_SESSION["regdate"] = $record["regdate"];
        $_SESSION["phone"] = $record["phone"];
        $_SESSION["logged_in"] = true;

        $userid = $record["userid"];
        $logtime = date("Y-m-d H:i:s");
        $connection->query("INSERT INTO userlogs (logtime, userid) VALUES ('$logtime', '$userid')");

        // Redirect users based on usertypeid
        if ($usertypeid == 3) {
            header("Location: /online-repository-website/candidatelandingpage.php");
        } elseif ($usertypeid == 2) {
            header("Location: /online-repository-website/clientlandingpage.php");
        } elseif ($usertypeid == 1) {
            header("Location: /online-repository-website/dashboard.php");
        }
    } else {
        $errorMessage = "Incorrect email or password";
    }
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

        <a href="signup.php" class="nav-link active fw-bold me-5">Register<i class="bi bi-arrow-right-short"></i></a>

      </div>
      
    </div>
  </nav>

    <div class="container pt-5">
        <div class="pt-5 mt-4">
            <div class="card mt-5 mx-auto col-sm-5 p-4">
                <div class="mx-auto mb-3">
                    <img src="img/logonly.png" style="height: 50px;" alt="VocoEase">
                </div>
                <h5 class="card-title text-center">Log in to VocoEase Resume Repository</h5>
                <?php
                  if (!empty($errorMessage)) {
                    echo "
                    <div class='mt-3 mx-3 alert alert-warning alert-dismissible fade show' role='alert'>
                      <strong>$errorMessage</strong>
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
                  }
                ?>
                <div class="card-body">
                    <form method="POST" action="<?php htmlspecialchars("SELF_PHP"); ?>">
                        <div class="row">
                            <div class="col input-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?php echo $email; ?>" required>
                            </div>
                        </div>
                        <div class="row mt-2 mb-3">
                            <div class="col input-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-grid gap-2">
                                <button type="submit" class="btn btn-primary text-white fw-bold">Sign in</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-grid gap-2">
                                <p class="text-center mt-2">Don't have an account yet?<a href="signup.php" class="text-decoration-none"> Register here.</a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        const passwordInput = document.getElementById("password");
        const togglePasswordButton = document.getElementById("togglePassword");

        togglePasswordButton.addEventListener("click", function () {
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                togglePasswordButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
            } else {
                passwordInput.type = "password";
                togglePasswordButton.innerHTML = '<i class="bi bi-eye"></i>';
            }
        });

    </script>

</body>
</html>