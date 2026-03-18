<?php
session_start();
if(isset($_SESSION['user_name'])){
  $user_name=$_SESSION['user_name'];
  echo "hello".$user_name;
}

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
   <link rel="stylesheet" href="admin_style.css" />

     <!-- bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- fontawesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

  <!-- google fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- site icons -->
  <link href="images/apple-touch-icon.png" rel="icon">
  <link href="images/apple-touch-icon.png" rel="apple-touch-icon">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- external calendar link-->
 <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
</head>

<body style="background-color: #f0f0f0;">
 
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

      <!-- Admin Dashboard Section -->
      <a href="Admin.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-tachometer-alt fa-fw me-3" style="color:blue;"></i>Dashboard
      </a>
      <a href="admin_user_management.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-users fa-fw me-3" style="color:green;"></i>User Manager
      </a>
       <a href="admin_documents.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-file fa-fw me-3" style="color:orange;"></i>Documents
      </a>
      <a href="admin_announce.php" class="list-group-item list-group-item-action py-3">
        <i class="fas fa-bell fa-fw me-3" style="color:red;"></i>Announce
      </a>

      <div class="list-group-item py-2" data-bs-toggle="collapse" data-bs-target="#account-pages">
  <span class="fw-bold dropdown-toggle" >ACCOUNT PAGES</span>
</div>
<div id="account-pages" class="collapse show">
  <a href="#" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-user fa-fw me-3" style="color:cyan;"></i>Profile Info
  </a>
  <a href="index.php" class="list-group-item list-group-item-action py-3">
    <i class="fas fa-sign-in-alt fa-fw me-3" style="color:indigo;"></i>Sign out
  </a>
  <br>
  &nbsp;&nbsp;<a href="#" class="ml-3 list-group-item-action py-3">
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
          <input autocomplete="off" type="search" class="form-control rounded"
            placeholder='Search' style="min-width: 225px" />
          <input type="submit" class="input-group-text border-0" value="Search">
        </form>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <!-- Notification dropdown -->

          <li class="nav-item dropdown">
            <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink"
              role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <li class="nav-item dropdown">Admin&nbsp;<?php echo $user_name; ?>&nbsp;&nbsp;&nbsp;<i class="fas fa-bell"></i>
              <span class="badge rounded-pill badge-notification bg-danger">
               <?php
echo $_SESSION['visitors'];
    
?>

              </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Site Views</a></li>
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
 


  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">

<!----first section--->
<section>
  <div class="row">
<div class="col-xl-3 col-sm-6 col-12 mb-4">
               <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-warning">
                      <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
        $sql = "SELECT * FROM users WHERE Role='Pediatrician'";
    $mquery = mysqli_query($conn, $sql);

   $localUsers=mysqli_num_rows($mquery);
   // Define the maximum value for the progress bar
                $maxValue = 100;

                // Calculate the percentage for the progress bar
                $percentage = ($localUsers / $maxValue) * 100;

                echo '<h3 class="text-danger">' . $localUsers . '</h3>';

      

?></h3>
                    <p class="mb-0">Local Users </p>

                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-users text-warning fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                     <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $localUsers; ?>"
                    aria-valuemin="0" aria-valuemax="<?php echo $maxValue; ?>"></div>
                  </div>
                </div>
                <br>
                <a href="admin_user_management.php" class="btn btn-outline-warning btn-sm rounded-3">Manage</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-success">
<?php
        $sql = "SELECT * FROM users WHERE Role='Admin'";
    $mquery = mysqli_query($conn, $sql);

   $admins=mysqli_num_rows($mquery);
   // Define the maximum value for the progress bar
                $maxValue = 100;

                // Calculate the percentage for the progress bar
                $percentage = ($admins / $maxValue) * 100;

                echo '<h3 class="text-danger">' . $admins . '</h3>';
?>
                    </h3>
                    <p class="mb-0">Admin Users</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-user text-success fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
                  <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $admins; ?>"
                    aria-valuemin="0" aria-valuemax="<?php echo $maxValue; ?>"></div>
                  </div>
                </div>
                <br>
                <a href="admin_user_management.php" class="btn btn-outline-success btn-sm rounded-3">Manage</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
    <div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between px-md-1">
            <div>
                <?php
                $sql = "SELECT * FROM employees WHERE ID LIKE 'BH00%'";
                $myquery = mysqli_query($conn, $sql);

                $totalPediatricianists = mysqli_num_rows($myquery);

                // Define the maximum value for the progress bar
                $maxValue = 100;

                // Calculate the percentage for the progress bar
                $percentage = ($totalPediatricianists / $maxValue) * 100;

                echo '<h3 class="text-danger">' . $totalPediatricianists . '</h3>';
                echo '<p class="mb-0">Total Pediatricianists</p>';
                ?>
            </div>
            <div class="align-self-center">
                <i class="fas fa-user-md text-danger fa-3x"></i>
            </div>
        </div>
        <div class="px-md-1">
            <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $percentage; ?>%" aria-valuenow="<?php echo $totalPediatricianists; ?>"
                    aria-valuemin="0" aria-valuemax="<?php echo $maxValue; ?>"></div>
            </div>
        </div>
        <br>
        <a href="admin_user_management.php" class="btn btn-outline-danger btn-sm rounded-3">Manage</a>
    </div>
</div>
          </div>
          <div class="col-xl-3 col-sm-6 col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <h3 class="text-info">
                <?php echo isset($_SESSION['visitors']) ? $_SESSION['visitors'] : 0; ?>

                    </h3>
                    <p class="mb-0">Site Visits</p>
                  </div>
                  <div class="align-self-center">
                    <i class="fas fa-eye text-info fa-3x"></i>
                  </div>
                </div>
                <div class="px-md-1">
    <div class="progress mt-3 mb-1 rounded" style="height: 7px">
        <?php
        // Get the value from the $_SESSION['visitors'] variable
        $progressValue = isset($_SESSION['visitors']) ? $_SESSION['visitors'] : 0;
        ?>
        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $progressValue; ?>%" aria-valuenow="<?php echo $progressValue; ?>"
            aria-valuemin="0" aria-valuemax="100"></div>
    </div>
</div>

              </div>
            </div>
          </div>

  <div class="col-xl-6 col-md-12 mb-4">
    <div class="card  card-item">
      <div class="card-body" style="height: 160px;">
        <div class="d-flex justify-content-between p-md-1">
          <div class="d-flex flex-row">
            <div class="card-item">
               <canvas id="viewsChart" width="600" height="100"></canvas>
                <script src="views.js"></script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-6 col-md-12 mb-4">
  </div>
</div>

        <div class="card mb-3" style="height:auto;">
          <div class="card-header py-3 d-flex justify-content-between">
      <h5 class="mb-0 ">

  <nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item active" aria-current="page">
      <span class="page-link"><i class="fas fa-window-restore me-1"></i>&nbsp;Date Pick</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
  </ul>
</nav>
</h5>
<strong class="text-secondary"><i class="fas fa-list-alt me-1 text-primary">&nbsp;&nbsp; </i>Academic year 2023</strong>
<strong><i class="fas fa-th-list me-1 text-warning">&nbsp;&nbsp; </i>Hospitality Calendar</strong>
          </div>
          <div class="card-body">
    <div id="calendar" style="width: auto; min-height: 500px; max-height: 4000px;" ></div>

          </div>
        </div>

        <div class="row">
          <!--other row space-->

        </div>
      </section>
     
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
        // Automatically logout after 20 seconds of inactivity
        setTimeout(function() {
            window.location.href = 'index.php'; // Redirect to the logout page
        }, 500000); // 20,000 milliseconds (20 seconds)
    </script>

<script>
// calender scripts
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth'
        });
        calendar.render();
      });

    </script>


  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>