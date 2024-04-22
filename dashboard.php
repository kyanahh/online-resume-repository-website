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

// Perform a database query to count the number of users for each user type
$query = "SELECT usertypeid, COUNT(*) as count FROM users GROUP BY usertypeid";
$result = mysqli_query($connection, $query);

$userTypeCounts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $userTypeCounts[$row['usertypeid']] = $row['count'];
}

// Define colors for the Doughnut chart
$colors = ["#007bff", "#dc3545", "#ffc107"];

// Prepare data for the Doughnut chart
$labels = [];
$data = [];
foreach ($userTypeCounts as $userTypeId => $count) {
    switch ($userTypeId) {
        case 1:
            $labels[] = "Management";
            break;
        case 2:
            $labels[] = "Client";
            break;
        case 3:
            $labels[] = "Candidate";
            break;
    }
    $data[] = $count;
}

// Generate JavaScript code to render the Doughnut chart
$chartData = json_encode([
    'labels' => $labels,
    'datasets' => [[
        'data' => $data,
        'backgroundColor' => $colors,
    ]]
]);


//-------------------------------------------------------------------

// Perform a database query to count the number of users for each gender
$genderQuery = "SELECT gender, COUNT(*) as count FROM users GROUP BY gender";
$genderResult = mysqli_query($connection, $genderQuery);

$genderCounts = [];
while ($row = mysqli_fetch_assoc($genderResult)) {
    $genderCounts[$row['gender']] = $row['count'];
}

//-------------------------------------------------------------------

// Perform a database query to count the number of users for each civil status
$civilStatusQuery = "SELECT civilstatus, COUNT(*) as count FROM users GROUP BY civilstatus";
$civilStatusResult = mysqli_query($connection, $civilStatusQuery);

$civilStatusCounts = [];
while ($row = mysqli_fetch_assoc($civilStatusResult)) {
    $civilStatusCounts[$row['civilstatus']] = $row['count'];
}

// Define colors for the Doughnut chart
$colors = ["#007bff", "#dc3545", "#ffc107", "#28a745", "#6c757d"];

// Prepare data for the Doughnut chart for gender
$genderLabels = [];
$genderData = [];
foreach ($genderCounts as $gender => $count) {
    $genderLabels[] = ucfirst($gender);
    $genderData[] = $count;
}

//-------------------------------------------------------------------

// Prepare data for the Doughnut chart for civil status
$civilStatusLabels = [];
$civilStatusData = [];
foreach ($civilStatusCounts as $civilStatus => $count) {
    $civilStatusLabels[] = ucfirst($civilStatus);
    $civilStatusData[] = $count;
}

// Generate JavaScript code to render the Doughnut chart for gender
$genderChartData = json_encode([
    'labels' => $genderLabels,
    'datasets' => [[
        'data' => $genderData,
        'backgroundColor' => $colors,
    ]]
]);

//-------------------------------------------------------------------

// Generate JavaScript code to render the Doughnut chart for civil status
$civilStatusChartData = json_encode([
    'labels' => $civilStatusLabels,
    'datasets' => [[
        'data' => $civilStatusData,
        'backgroundColor' => $colors,
    ]]
]);

// -----------------------------------------------------------------------------

// Query to count the total number of users
$countQuery = "SELECT COUNT(*) AS total_users FROM users";
$countResult = mysqli_query($connection, $countQuery);

// Fetch the total count
$totalUsers = mysqli_fetch_assoc($countResult)['total_users'];

// -----------------------------------------------------------------------------

// Get the current year
$currentYear = date("Y");

// Query to count the number of accounts registered per month in the current year
$monthlyCountQuery = "SELECT MONTH(regdate) AS month, COUNT(*) AS count FROM users WHERE YEAR(regdate) = $currentYear GROUP BY MONTH(regdate)";
$monthlyCountResult = mysqli_query($connection, $monthlyCountQuery);

$monthlyCounts = [];
while ($row = mysqli_fetch_assoc($monthlyCountResult)) {
    $monthlyCounts[$row['month']] = $row['count'];
}

// -----------------------------------------------------------------------------

// Query to count the number of accounts registered per year
$yearlyCountQuery = "SELECT YEAR(regdate) AS year, COUNT(*) AS count FROM users GROUP BY YEAR(regdate)";
$yearlyCountResult = mysqli_query($connection, $yearlyCountQuery);

$yearlyCounts = [];
while ($row = mysqli_fetch_assoc($yearlyCountResult)) {
    $yearlyCounts[$row['year']] = $row['count'];
}

// -----------------------------------------------------------------------------

// Prepare data for the line chart for monthly counts
$monthlyLabels = [];
$monthlyData = [];
for ($i = 1; $i <= 12; $i++) {
    $monthlyLabels[] = date("F", mktime(0, 0, 0, $i, 1)); // Get month name
    $monthlyData[] = isset($monthlyCounts[$i]) ? $monthlyCounts[$i] : 0;
}

// Prepare data for the line chart for yearly counts
$yearlyLabels = array_keys($yearlyCounts);
$yearlyData = array_values($yearlyCounts);

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <style>
      .scrollable {
        overflow-y: auto; 
        max-height: 500px; 
      }
    </style>

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
            <h5>Dashboard</h5>
          </nav>

          <hr />

          <!-- Dashboard Content -->
          <div class="scrollable">
            <!-- Count users -->
            <div class="row mx-3 mb-3">
              <div class="card p-4">
                <h3>Total Number of Users: <?php echo $totalUsers; ?></h3>
              </div>
            </div>
            <!-- Row 1 -->
            <div class="row gap-4 mx-3 mb-3">
              <div class="card p-3 col">
                <h3 class="text-center pt-2">Users</h3>
                <canvas id="userChart" class="mb-3"></canvas>
              </div>
              <div class="card p-3 col">
                <h3 class="text-center pt-2">Gender</h3>
                <canvas id="genderChart" class="mb-3"></canvas>
              </div>
              <div class="card p-3 col">
                <h3 class="text-center pt-2">Civil Status</h3>
                <canvas id="civilStatusChart" class="mb-3"></canvas>
              </div>
            </div>
            <!-- Row 2 -->
            <div class="row gap-4 mx-3">
              <h2 class="fw-bold text-center mt-2">Account Registration Statistics</h2>
              <div class="card p-3 col">
                <h3 class="text-center pt-2">Monthly Registered Accounts</h3>
                <canvas id="monthlyChart" class="mb-3"></canvas>
              </div>
              <div class="card p-3 col">
                <h3 class="text-center pt-2">Yearly Registered Accounts</h3>
                <canvas id="yearlyChart" class="mb-3"></canvas>
              </div>
            </div>
          </div>

        </div>
      </div>

      
    </div>

    <script>
        // Render Doughnut chart using Chart.js
        var ctx = document.getElementById('userChart').getContext('2d');
        var userChart = new Chart(ctx, {
            type: 'doughnut',
            data: <?php echo $chartData; ?>,
        });

        // Render Doughnut chart for gender using Chart.js
        var genderCtx = document.getElementById('genderChart').getContext('2d');
        var genderChart = new Chart(genderCtx, {
            type: 'doughnut',
            data: <?php echo $genderChartData; ?>,
        });

        // Render Doughnut chart for civil status using Chart.js
        var civilStatusCtx = document.getElementById('civilStatusChart').getContext('2d');
        var civilStatusChart = new Chart(civilStatusCtx, {
            type: 'doughnut',
            data: <?php echo $civilStatusChartData; ?>,
        });

        // Render line chart for monthly counts using Chart.js
        var monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        var monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($monthlyLabels); ?>,
                datasets: [{
                    label: 'Accounts Registered per Month (<?php echo $currentYear; ?>)',
                    data: <?php echo json_encode($monthlyData); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Render line chart for yearly counts using Chart.js
        var yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        var yearlyChart = new Chart(yearlyCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($yearlyLabels); ?>,
                datasets: [{
                    label: 'Accounts Registered per Year',
                    data: <?php echo json_encode($yearlyData); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

  </body>
</html>
