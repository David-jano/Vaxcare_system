<?php
session_start(); // Counting the site views
if(isset($_SESSION['user_name'])){
  $user_name=$_SESSION['user_name'];
  
}

// Increment the visitor count in the session
if (!isset($_SESSION['visitors'])) {
    $_SESSION['visitors'] = 1;
} else {
    $_SESSION['visitors']++;
}
?>
 <!-- Getting the username within the logging of the system -->
<?php

if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
  
    $username = "Guest";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>E-Child Vaxcare</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link rel="stylesheet" href="styles.css"/>
  <!-- Google Fonts Roboto -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />

  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />

  <!-- Custom styles -->
  <link rel="stylesheet" href="css/admin.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <link href="images/apple-touch-icon.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<?php 
       
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$statement = "SELECT * FROM announcements";
$prepare = mysqli_query($conn, $statement);

$aa=mysqli_num_rows($prepare)>0;

 ?>

<body style="background-color: #f0f0f0;">
 

  <!--Main Navigation-->
  <header>
    <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">
      <!-- Main Logo and Title -->
      <div class="list-group-item py-2">
        <div class="d-flex align-items-center">
          <span class="fw-bold">E-Child VaxCare System</span><br>
          <hr>
        </div>
      </div>

 <!-- Dashboard Section -->
      <a href="dashboard.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-tachometer-alt fa-fw me-3" style="color:blue;"></i>Dashboard
      </a>
      <a href="schedule.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-calendar fa-fw me-3" style="color:green;"></i>Vaccination Schedule
      </a>
      <a href="first_vaccination.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-address-book fa-fw me-3" style="color:orange;"></i>Registration
      </a>
      <a href="immunization.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-medkit fa-fw me-3" style="color:indigo;"></i>Immunization
      </a>

      <a href="nutrition.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-chart-line fa-fw me-3" style="color:red;"></i>Nutrition Status
      </a>

      <div class="list-group-item py-2" data-bs-toggle="collapse" data-bs-target="#account-pages">
  <span class="fw-bold dropdown-toggle" >More Information</span>
</div>
<div id="account-pages" class="collapse show">
  <a href="report.php" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-table fa-fw me-3" style="color:#f4ca16;"></i>Reports
  </a>
  <a href="documents.php" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-file fa-fw me-3" style="color:#008080;"></i>Documents
  </a>
  <br>
  &nbsp;&nbsp;<a href="announcements.php" class="ml-3 list-group-item-action py-3">
    <i class="fas fa-bell fa-fw me-2" style="color:#954535; vertical-align: middle;"></i>
    Announcements
    &nbsp;<span class="badge rounded-pill badge-notification bg-danger"><?php echo $aa; ?> New</span>
  </a>
</div>

 
    <div class="dropdown d-flex align-items-center  text-decoration-none fixed-bottom mb-3">
      <hr>
        &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <small class="text-muted">&copy; 2023 Byumba Hospital</small>
    
    </div>

    </div>
  </div>
</nav>


    <!-- Sidebar -->

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="dashboard.php">
          <img src="images/apple-touch-icon.png" height="25" alt="" loading="lazy" />&nbsp;
        </a>
       <!-- Search form -->
        <form class="d-none d-md-flex input-group w-auto my-auto align-items-center" method="POST">
          <input type="text" class="form-control rounded" placeholder='Search batch' style="min-width: 225px" name="batch_pattern" required />
          <input type="submit" class="input-group-text border-0" value="Search" name='batch_search'>
        </form>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->

          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
              role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <li class="nav-item dropdown">Pediatrician&nbsp;<?php echo $user_name; ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger"><?php echo $aa; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Notifications <i class="fas fa-bell text-danger"></i></a></li>
            </ul>
          </li> &nbsp;&nbsp;&nbsp;

          <!-- Icon -->
          <li class="nav-item">
            <a class="nav-link me-3 me-lg-0" href="#">
              <i class="fas fa-cog"></i>
            </a>
          </li>
          <!-- Icon -->
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="#">
              <i class="fas fa-thermometer"></i>
            </a>
          </li>

          <!-- Icon dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdown" role="button"
              data-mdb-toggle="dropdown" aria-expanded="false">
              <i class="united kingdom flag m-0"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li>
                <a class="dropdown-item" href="#"><i class="united kingdom flag"></i>English
                  <i class="fa fa-check text-success ms-2"></i></a>
              </li>
              <li>
                <hr class="dropdown-divider" />
              </li>
              <li>
                <a class="dropdown-item" href="#"><i class="rwanda flag"></i>Kinyarwanda</a>
              </li>
              <li>
                <a class="dropdown-item" href="#"><i class="france flag"></i>France</a>
              </li>
              
            </ul>
          </li>

          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <div class="d-flex align-items-center">
    <img src="images/avatar.png" class="rounded-circle dropdown-toggle" height="22" alt="user" loading="lazy" />

    <span class="position-relative" style="width:-4px;">
        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
            <!-- Status indicator content -->
        </span>
    </span>
</div>

            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item text-success" href="#"><?php echo $user_name; ?>
               <span class="badge rounded-pill text-bg-success">Online</span></li>
              <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">

<!----first section--->
<section>
  <div class="row">
    <!--
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card bg-success text-light card-item">
      <div class="card-body" style="height: 160px;">
        <div class="d-flex justify-content-between p-md-1">
          <div class="d-flex flex-row">
            <div class="align-self-center">
              <i class="fas fa-tint text-light fa-3x me-4 card-item "></i>
            </div>
            <div class="card-item">
              <h4>Vaccination rates in Rwanda</h4>
              <p class="mb-0">According to data from the WHO <br>Vaccine-Preventable Disease Monitoring System</p>
            </div>
          </div>
          <div class="align-self-center card-item">
            <h2 class="h1 mb-0">98%</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card bg-secondary text-light card-item">
      <div class="card-body" style="height: 160px;">
        <div class="d-flex justify-content-between p-md-1">
          <div class="d-flex flex-row">
            <div class="align-self-center">
              <i class="far fa-comment-alt text-light fa-3x me-4 card-item"></i>
            </div>
            <div class="card-item">
              <h4>Poliovirus for under 7 years of age.</h4>
              <p class="mb-0">comprehensive vaccination campaign to <br>administer the second Poliovirus vaccine</p>
            </div>
          </div>
          <div class="align-self-center card-item">
            <h2 class="h1 mb-0">7%</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
-->
</div>

        <div class="card mb-3">

          <div class="card-header py-3 bg-success text-light d-flex justify-content-between">
            <h5 class="mb-0 text-center"><strong><i class="fas fa-globe me-1"></i> Global immunization coverage 2022</strong></h5>
            <strong><i class="fas fa-user fa-sm text-light"></i>&nbsp;&nbsp;<i class='fas fa-caret-up text-light'></i>&nbsp;&nbsp; <i class='fas fa-times text-light'></i></p></h5></strong>


          </div>
          <div class="card-body ">
            <canvas class="my-4 w-100" id="vaccinationChart" height="110"></canvas>
     <script src="graph.js"></script>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
               <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-warning">99%</h3>
                    <p class="mb-0">BCG</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fa fa-stethoscope text-warning" style="font-size:35px;"></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 99%" aria-valuenow="99"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">98%</h3>
                    <p class="mb-0">OPV(Drop)</p>
                  </div>
                  <div class="align-self-center">
                
                  <i class="fa fa-tint text-success fa-3x"></i>
                   
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 98%" aria-valuenow="60"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
         <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-danger"></h3>
                    <p class="mb-0">OPV(Syring1)</p>
                  </div>
                  <div class="align-self-center">
                  <i class="fa fa-droplet-degree "></i>
                  <i class="fa  fa-syringe fa-3x text-danger "></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 90%" aria-valuenow="40"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-info"></h3>
                    <p class="mb-0">OPV(Syring2)</p>
                  </div>
                  <div class="align-self-center">
                 
                    <i class="fa fa-virus text-info fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 90%" aria-valuenow="80"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Section: Main chart -->

      <!--Section: Sales Performance KPIs-->
      <section class="mb-4">
        <div class="card">
          <div class="card-header text-center py-3 d-flex justify-content-between bg-secondary text-light">
            <h5 class="mb-0 text-center">
              <strong><i class="fas fa-syringe me-1"></i> Child Vaccination Plan</strong>

            </h5>
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <input type="text" class="form-control ml-3" placeholder="search Vaccination Info..."/>&nbsp;&nbsp;&nbsp;
  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="text-light btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
     <i class="fas fa-syringe me-1"></i>&nbsp;&nbsp;<i class="fas fa-user me-1"></i>&nbsp;&nbsp;<i class="fas fa-bell me-1"></i>
    </button>
    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <li><a class="dropdown-item" href="#">OPV</a></li>
      <li><a class="dropdown-item" href="#">BCG</a></li>
    </ul>
  </div>
</div>
          </div>
          <div class="card-body" >
            <div class="table-responsive">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">BCG On Birth</th>
                    <th scope="col">OPV On Birth</th>
                    <th scope="col">1.5 Month</th>
                    <th scope="col">2.5 Months</th>
                    <th scope="col">3.5 Months</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>BCG</td>
                    <td>OPV(Drop)</td>
                    <td>OPV2(Syringe)</td>
                    <td>OPV3(Syringe)</td>
                    <td>OPV4(Syringe)</td>
                    
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>
                      <span class="text-success">
                        <i class="fas fa-caret-up me-1"></i><span>+99%</span>
                      </span>
                    </td>
                    <td>
                      <span class="text-success">
                        <i class="fas fa-caret-up me-1"></i><span>14.0%</span>
                      </span>
                    </td>
                    <td>
                      <span class="text-success">
                        <i class="fas fa-caret-up me-1"></i><span>46.4%</span>
                      </span>
                    </td>
                    <td>
                      <span class="text-success">
                        <i class="fas fa-caret-up me-1"></i><span>29.6%</span>
                      </span>
                    </td>
                    <td>
                      <span class="text-danger">
                        <i class="fas fa-caret-down me-1"></i><span>-11.5%</span>
                      </span>
                    </td>
                     
                  </tr>
                  <tr>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>

       <?php
if(isset($_POST['batch_search'])){
  $batch_pattern=$_POST['batch_pattern'];
echo "<div class='modal fade' id='exampleModal' >
            <div class='modal-dialog modal-lg modal-dialog-scrollable'>
                <div class='modal-content'>
                    <div class='modal-header bg-secondary text-light'>
                        <h5 class='modal-title' id='editModalLabel'>Found Results for Batch Number"." '".  $batch_pattern."'</h5>
                        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                    </div>
                    <div class='modal-body'>";
   $query0 = "SELECT * FROM  vaccination_data WHERE Child_names = '$batch_pattern'";
    $result0 = mysqli_query($conn, $query0);
    if (mysqli_num_rows($result0) > 0) {

      echo"<table class='table table-striped'><tr><th>Batchno</th><th>Child Names</th><th>DOB</th><th>Father Name</th><th>Mother Name</th><th>Father ID</th><th>Mother ID</th><th>Family Phone</th><th>Province</th><th>District</th><th>Sector</th><th>Cell</th><th>Village</th></tr>";
        while ($row = mysqli_fetch_assoc($result0)) {
            
      echo"<tr><td>".$row['Batchno']."</td><td>".$row['Child_names']."</td><td>".$row['Dob']."</td><td>".$row['Father_name']."</td><td>".$row['Mother_name']."</td><td>".$row['Father_id']."</td><td>".$row['Mother_id']."</td><td>".$row['Father_phone']."</td><td>".$row['Province']."</td><td>".$row['District']."</td><td>".$row['Sector']."</td><td>".$row['Cell']."</td><td>".$row['Village']."</td></tr>

                    </div>
                    <div class='modal-footer'
                    </div>
                </div>
            </div>
        </div>";

        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                myModal.show();
            });
            </script>";         
}
echo"</table>";
}
else
{
  echo"<script>alert('Invalid Batch Number')</script>";
}
}
        ?>


          </div>
  </main>

<script>
  // Trigger the fade-in animation when the page is loaded or refreshed
  window.addEventListener("load", function () {
    const cardItems = document.querySelectorAll(".card-item");

    cardItems.forEach(function (item) {
      item.style.opacity = "1"; // Set opacity to 1 to trigger the animation
    });
  });
</script>

<script>
        // Automatically logout after 30min of inactivity
        setTimeout(function() {
            window.location.href = 'index.php'; // Redirect to the logout page
        }, 1800000); // 
    </script>

  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>