<?php
session_start(); 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
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

  <style type="text/css">
  @media print{
    body * {
      visibility: hidden;
    }
    .exampleModalToggle22, .exampleModalToggle22 * {
      visibility: visible;
    }
  }
/* Set page size to portrait */
@page {
  size: A4;
}

/* Define landscape mode for the header and content containers */
.report-container {
  width: 100%;
  display: flex;
}

.header {
  width: 30%; /* Adjust the width as needed for your design */
  margin-right: 10px; /* Adjust margin as needed */
}

.content {
  width: 70%; /* Adjust the width as needed for your design */
}

/* Control page breaks inside the content container */
.content {
  page-break-inside: auto;
}
</style>

</head>
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
              <span class="badge rounded-pill badge-notification bg-danger">1</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="#">Notifications</a></li>
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
  <div class="col-xl-4 col-sm-12 col-12 mb-4">
    <div class="card col-12">
      <div class="card-body">
        <form method="POST">
          <div class="d-flex justify-content-between px-md-1">
            <div class="input-group">
              <div class="input-group-text">Search by:</div>
              <select name="searchby" class="form-control col-4">
  <option value="Date">Date</option>
  <option value="Batchno">Batchno</option>
  <option value="District">District</option>
  <option value="Vaccination">Vaccination</option>
  <option value="Sector">Sector</option>
</select>
            </div>
          </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-sm-12 col-12 mb-4">
    <div class="card col-12">
      <div class="card-body">
        <form method="POST">
          <div class="d-flex justify-content-between px-md-1">
          <div class="input-group">
  <input type="text" name="searchbyPattern" class="form-control" placeholder="Enter search term">
  <input type="submit" class="btn btn-primary" value="Search" name="Search">
</div>
        </form>
      </div>
    </div>
  </div>
</div>

</div>

<div class="card mb-3" style="max-height: 900px; overflow-y: auto;padding='30px;'">
          <div class="card-header py-3 d-flex justify-content-between text-light bg-success">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item" aria-current="page">
      <span class="page-link bg-success text-light"><i class="fas fa-list me-1"></i>&nbsp;Reports</span>
    </li>
    <li class="page-item"><a class="page-link text-success" href="#navigate top">OPV &nbsp;<i class="fas fa-caret-down me-1 text-lighy">&nbsp;&nbsp; </i></a></li>

 <li class="page-item"><a class="page-link text-success" href="#navigate top">BCG&nbsp;<i class="fas fa-caret-down me-1 text-lighy">&nbsp;&nbsp; </i></a></li>

  </ul>
</nav>
<strong class="text-light"><i class="fas fa-list me-1 text-light">&nbsp;&nbsp; </i>Generate Vaccination report </strong>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"/>
                <label class="form-check-label" ></label>
              </div>
          </div>
          <div class="card-body " id="print-container">

<?php
$patt=date('Y-m-d h:i:s');
if (isset($_POST['Search'])) {
  $by = strtolower($_POST['searchby']);
  $patternn = $_POST['searchbyPattern'];
  $selection = "";
echo "<div class='alert alert-success'><i class='fa fa-bell'></i>&nbsp;&nbsp;Found Records for Search by: <b>'".$patternn." ".$by."</b>'</div>";
  if ($by == 'batchno') {
    // Execute SQL query to retrieve data based on Batchno
    $selection = "SELECT p.*, b.*, v.*
      FROM polio AS p
      INNER JOIN bcg AS b ON p.Batchno = b.Batchno
      INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno
      WHERE p.Batchno = '$patternn'";

$resss = mysqli_query($conn, $selection);
if (mysqli_num_rows($resss) > 0) {
  echo"<div class='d-flex justify-content-between'><img src='images/logo.png' alt='Logo' width='30px' height='30px'>
                            <center><p>Gicumbi District<br>Byumba Sector<br>Byumba HC<br><br><br><br><h4><u>Report on ".$patt." "."</u></h4></p></center><img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'></div>
                            <br>
                            <hr>";
  echo "<table class='table table-striped' >
  <tr>
    <th>Polio(Drop) at birth</th>
    <th>Polio(Drop) at birth date</th>
    <th>Bcg Status</th>
    <th>Bcg Date</th>
    <th>Polio(Syringe) for 1.5 months</th>
    <th>Polio(Syringe)or 1.5 months date</th>
    <th>Polio(Syringe) for 2.5 months</th>
    <th>Polio(Syringe)or 2.5 months date</th>
    <th>Polio(Syringe) for 3.5 months</th>
    <th>Polio(Syringe)or 3.5 months date</th>
  </tr>";
  while ($row = mysqli_fetch_assoc($resss)) {
    echo "
    <ul class='list-group list-group-flush'>
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
          <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".$row['Batchno']."</li>
          <li class='list-group-item'><strong>Child Names:</strong>&nbsp;". $row['Child_names']."</li>
          <li class='list-group-item'><strong>Sex:</strong>&nbsp;".$row['Sex']."</li>
          <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".$row['Father_name']."</li>
      <li class='list-group-item'><strong>Father Phone Number:</strong>&nbsp;(+250)".$row['Father_phone']."</li>
      <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".$row['Mother_name']."</li>
      <li class='list-group-item'><strong>Mother Phone Number:</strong>&nbsp;(+250)".$row['Mother_phone']."</li>
      
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Location Information</h5>
      <li class='list-group-item'><strong>Nationality:</strong>&nbsp; Rwandan</li>
          <li class='list-group-item'><strong>Province:</strong>&nbsp;".$row['Province']."</li>
          <li class='list-group-item'><strong>District:</strong>&nbsp; ".$row['District']."</li>
          <li class='list-group-item'><strong>Sector:</strong>&nbsp; ".$row['Sector']."</li>
          <li class='list-group-item'><strong>Cell:</strong>&nbsp; ".$row['Cell']."</li>
          <li class='list-group-item'><strong>Village:</strong>&nbsp; ".$row['Village'] ."</li>
      <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;<center>Vaccinations Status</center></h5>
      <br>
          </ul>
    <tr>
              <td>" . $row['Status'] . "</td>
              <td>" . $row['Dates'] . "</td>
              <td>" . $row['Bcg_status'] . "</td>
              <td>" . $row['Bcg_date'] . "</td>
              <td>" . $row['Status2'] . "</td>
              <td>" . $row['Date2'] . "</td>
              <td>" . $row['Status3'] . "</td>
              <td>" . $row['Date3'] . "</td>
              <td>" . $row['Status4'] . "</td>
              <td>" . $row['Date4'] . "</td>
            </tr>";
            }
  echo "</table>
    <br><br><br>Done at Gicumbi<br>
    On ". date('Y-m-d h:i:s')."
    <br>
    <br>
    Head of Byumba HC signature & stamp
    <br>
    <br>
    <br>
    <br>
    <div class='col-sm-12 mt-3 d-flex justify-content-between'>
    <a  href='export.php?searchby=$by&searchbyPattern=$patternn'><button class='btn btn-secondary'><i class='fa fa-file-excel'></i>&nbsp;&nbsp;Export to Excel</button></a>
    <button type='button' class='btn btn-primary' onclick='window.print()'>
        <i class='fas fa-print me-1 text-light'></i>Print Report
    </button>
</div>";
} 
else {
  echo "<script>alert('No results found');</script>";
}

  } elseif ($by == 'date') {
    // Execute SQL query to retrieve data based on Date
    $selection = "SELECT p.*, b.*, v.*
      FROM polio AS p
      INNER JOIN bcg AS b ON p.Batchno = b.Batchno
      INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno
      WHERE p.Dates  = '$patternn'|| p.Date2  = '$patternn' || p.Date3  = '$patternn' || p.Date4  = '$patternn'";

$resss = mysqli_query($conn, $selection);
if (mysqli_num_rows($resss) > 0) {
  echo"<div class='d-flex justify-content-between'><img src='images/logo.png' alt='Logo' width='30px' height='30px'>
                            <center><p>Gicumbi District<br>Byumba Sector<br>Byumba HC<br><br><br><br><h4><u>Report on ".$patt." "."</u></h4></p></center><img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'></div>
                            <br>
                            <hr>";
  echo "<table class='table table-striped'>
  <tr>
  <th>Polio(Drop) at birth</th>
  <th>Polio(Drop) at birth date</th>
  <th>Bcg Status</th>
  <th>Bcg Date</th>
  <th>Polio(Syringe) for 1.5 months</th>
  <th>Polio(Syringe)or 1.5 months date</th>
  <th>Polio(Syringe) for 2.5 months</th>
  <th>Polio(Syringe)or 2.5 months date</th>
  <th>Polio(Syringe) for 3.5 months</th>
  <th>Polio(Syringe)or 3.5 months date</th>
</tr>";
  while ($row = mysqli_fetch_assoc($resss)) {
    echo "
    <ul class='list-group list-group-flush'>
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
          <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".$row['Batchno']."</li>
          <li class='list-group-item'><strong>Child Names:</strong>&nbsp;". $row['Child_names']."</li>
          <li class='list-group-item'><strong>Sex:</strong>&nbsp;".$row['Sex']."</li>
          <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".$row['Father_name']."</li>
      <li class='list-group-item'><strong>Father Phone Number:</strong>&nbsp;(+250)".$row['Father_phone']."</li>
      <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".$row['Mother_name']."</li>
      <li class='list-group-item'><strong>Mother Phone Number:</strong>&nbsp;(+250)".$row['Mother_phone']."</li>
      
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Location Information</h5>
      <li class='list-group-item'><strong>Nationality:</strong>&nbsp; Rwandan</li>
          <li class='list-group-item'><strong>Province:</strong>&nbsp;".$row['Province']."</li>
          <li class='list-group-item'><strong>District:</strong>&nbsp; ".$row['District']."</li>
          <li class='list-group-item'><strong>Sector:</strong>&nbsp; ".$row['Sector']."</li>
          <li class='list-group-item'><strong>Cell:</strong>&nbsp; ".$row['Cell']."</li>
          <li class='list-group-item'><strong>Village:</strong>&nbsp; ".$row['Village'] ."</li>
      <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;<center>Vaccinations Status</center></h5>
      <br>
          </ul>
    <tr>
              <td>" . $row['Status'] . "</td>
              <td>" . $row['Dates'] . "</td>
              <td>" . $row['Bcg_status'] . "</td>
              <td>" . $row['Bcg_date'] . "</td>
              <td>" . $row['Status2'] . "</td>
              <td>" . $row['Date2'] . "</td>
              <td>" . $row['Status3'] . "</td>
              <td>" . $row['Date3'] . "</td>
              <td>" . $row['Status4'] . "</td>
              <td>" . $row['Date4'] . "</td>
            </tr>";
  }
  echo "</table>
  <br><br><br>Done at Gicumbi<br>
  On ". date('Y-m-d h:i:s')."
  <br>
  <br>
  Head of Byumba HC signature & stamp
  <br>
  <br>
  <br>
  <br>
  <div class='col-sm-12 mt-3 d-flex justify-content-between'>
  <a  href='export.php?searchby=$by&searchbyPattern=$patternn'><button class='btn btn-secondary'><i class='fa fa-file-excel'></i>&nbsp;&nbsp;Export to Excel</button></a>
    <button type='button' class='btn btn-primary' onclick='window.print()'>
        <i class='fas fa-print me-1 text-light'></i>Print Report
    </button>
</div>";
} 
else {
  echo "<script>alert('No results found');</script>";
}

  } elseif ($by == 'district') {
    // Execute SQL query to retrieve data based on District
    $selection = "SELECT p.*, b.*, v.*
      FROM polio AS p
      INNER JOIN bcg AS b ON p.Batchno = b.Batchno
      INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno
      WHERE v.District = '$patternn'";

$resss = mysqli_query($conn, $selection);
if (mysqli_num_rows($resss) > 0) {
  echo"<div class='d-flex justify-content-between'><img src='images/logo.png' alt='Logo' width='30px' height='30px'>
                            <center><p>Gicumbi District<br>Byumba Sector<br>Byumba HC<br><br><br><br><h4><u>Report on ".$patt." "."</u></h4></p></center><img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'></div>
                            <br>
                            <hr>";
                            echo "<table class='table table-striped'>
                            <tr>
                            <th>Polio(Drop) at birth</th>
                            <th>Polio(Drop) at birth date</th>
                            <th>Bcg Status</th>
                            <th>Bcg Date</th>
                            <th>Polio(Syringe) for 1.5 months</th>
                            <th>Polio(Syringe)or 1.5 months date</th>
                            <th>Polio(Syringe) for 2.5 months</th>
                            <th>Polio(Syringe)or 2.5 months date</th>
                            <th>Polio(Syringe) for 3.5 months</th>
                            <th>Polio(Syringe)or 3.5 months date</th>
                          </tr>";
  while ($row = mysqli_fetch_assoc($resss)) {
    echo "
    <ul class='list-group list-group-flush'>
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
          <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".$row['Batchno']."</li>
          <li class='list-group-item'><strong>Child Names:</strong>&nbsp;". $row['Child_names']."</li>
          <li class='list-group-item'><strong>Sex:</strong>&nbsp;".$row['Sex']."</li>
          <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".$row['Father_name']."</li>
      <li class='list-group-item'><strong>Father Phone Number:</strong>&nbsp;(+250)".$row['Father_phone']."</li>
      <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".$row['Mother_name']."</li>
      <li class='list-group-item'><strong>Mother Phone Number:</strong>&nbsp;(+250)".$row['Mother_phone']."</li>
      
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Location Information</h5>
      <li class='list-group-item'><strong>Nationality:</strong>&nbsp; Rwandan</li>
          <li class='list-group-item'><strong>Province:</strong>&nbsp;".$row['Province']."</li>
          <li class='list-group-item'><strong>District:</strong>&nbsp; ".$row['District']."</li>
          <li class='list-group-item'><strong>Sector:</strong>&nbsp; ".$row['Sector']."</li>
          <li class='list-group-item'><strong>Cell:</strong>&nbsp; ".$row['Cell']."</li>
          <li class='list-group-item'><strong>Village:</strong>&nbsp; ".$row['Village'] ."</li>
      <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;<center>Vaccinations Status</center></h5>
      <br>
          </ul>
    <tr>
              <td>" . $row['Status'] . "</td>
              <td>" . $row['Dates'] . "</td>
              <td>" . $row['Bcg_status'] . "</td>
              <td>" . $row['Bcg_date'] . "</td>
              <td>" . $row['Status2'] . "</td>
              <td>" . $row['Date2'] . "</td>
              <td>" . $row['Status3'] . "</td>
              <td>" . $row['Date3'] . "</td>
              <td>" . $row['Status4'] . "</td>
              <td>" . $row['Date4'] . "</td>
            </tr>";
  }
  echo "</table>
  <br><br><br>Done at Gicumbi<br>
  On ". date('Y-m-d h:i:s')."
  <br>
  <br>
  Head of Byumba HC signature & stamp
  <br>
  <br>
  <br>
  <br>
  <div class='col-sm-12 mt-3 d-flex justify-content-between'>
  <a  href='export.php?searchby=$by&searchbyPattern=$patternn'><button class='btn btn-secondary'><i class='fa fa-file-excel'></i>&nbsp;&nbsp;Export to Excel</button></a>
    <button type='button' class='btn btn-primary' onclick='window.print()'>
        <i class='fas fa-print me-1 text-light'></i>Print Report
    </button>
</div>";
} 
else {
  echo "<script>alert('No results found');</script>";
}

  } elseif($by == 'vaccination' && $patternn == 'polio') {
    $selection = "SELECT p.*, b.*, v.*
      FROM polio AS p
      INNER JOIN bcg AS b ON p.Batchno = b.Batchno
      INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno";

$resss = mysqli_query($conn, $selection);
if (mysqli_num_rows($resss) > 0) {
  echo"<div class='d-flex justify-content-between'><img src='images/logo.png' alt='Logo' width='30px' height='30px'>
                            <center><p>Gicumbi District<br>Byumba Sector<br>Byumba HC<br><br><br><br><h4><u>Report on ".$patt." "."</u></h4></p></center><img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'></div>
                            <br>
                            <hr>";
  echo "<table class='table table-striped'>
  <tr>
    <th>Polio(Drop) at birth</th>
    <th>Polio(Drop) at birth date</th>
    <th>Polio(Syringe) for 1.5 months</th>
    <th>Polio(Syringe)or 1.5 months date</th>
    <th>Polio(Syringe) for 2.5 months</th>
    <th>Polio(Syringe)or 2.5 months date</th>
    <th>Polio(Syringe) for 3.5 months</th>
    <th>Polio(Syringe)or 3.5 months date</th>
  </tr>";
  while ($row = mysqli_fetch_assoc($resss)) {

    echo "
    <ul class='list-group list-group-flush'>
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
          <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".$row['Batchno']."</li>
          <li class='list-group-item'><strong>Child Names:</strong>&nbsp;". $row['Child_names']."</li>
          <li class='list-group-item'><strong>Sex:</strong>&nbsp;".$row['Sex']."</li>
          <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".$row['Father_name']."</li>
      <li class='list-group-item'><strong>Father Phone Number:</strong>&nbsp;(+250)".$row['Father_phone']."</li>
      <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".$row['Mother_name']."</li>
      <li class='list-group-item'><strong>Mother Phone Number:</strong>&nbsp;(+250)".$row['Mother_phone']."</li>
      
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Location Information</h5>
      <li class='list-group-item'><strong>Nationality:</strong>&nbsp; Rwandan</li>
          <li class='list-group-item'><strong>Province:</strong>&nbsp;".$row['Province']."</li>
          <li class='list-group-item'><strong>District:</strong>&nbsp; ".$row['District']."</li>
          <li class='list-group-item'><strong>Sector:</strong>&nbsp; ".$row['Sector']."</li>
          <li class='list-group-item'><strong>Cell:</strong>&nbsp; ".$row['Cell']."</li>
          <li class='list-group-item'><strong>Village:</strong>&nbsp; ".$row['Village'] ."</li>
      <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;<center>Vaccinations Status</center></h5>
      <br>
          </ul>


   <tr>
    <td>" . $row['Status'] . "</td>
    <td>" . $row['dates'] . "</td>
    <td>" . $row['Status2'] . "</td>
    <td>" . $row['Date2'] . "</td>
    <td>" . $row['Status3'] . "</td>
    <td>" . $row['Date3'] . "</td>
    <td>" . $row['Status4'] . "</td>
    <td>" . $row['Date4'] . "</td>
          </tr>";
  }
  echo "</table>
    <br><br><br>Done at Gicumbi<br>
    On ". date('Y-m-d h:i:s')."
    <br>
    <br>
    Head of Byumba HC signature & stamp
    <br>
    <br>
    <br>
    <br>
    <div class='col-sm-12 mt-3 d-flex justify-content-between'>
    <a  href='export.php?searchby=$by&searchbyPattern=$patternn'><button class='btn btn-secondary'><i class='fa fa-file-excel'></i>&nbsp;&nbsp;Export to Excel</button></a>
    <button type='button' class='btn btn-primary' onclick='window.print()'>
        <i class='fas fa-print me-1 text-light'></i>Print Report
    </button>
</div>";
} 
else {
  echo "<script>alert('No results found');</script>";
}
  }
  elseif ($by == 'vaccination' && $patternn == 'bcg') {
    $selection = "SELECT p.*, b.*, v.*
      FROM bcg AS b
      INNER JOIN polio AS p ON p.Batchno = b.Batchno
      INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno";

    $resss = mysqli_query($conn, $selection);
    if (mysqli_num_rows($resss) > 0) {
      $resss = mysqli_query($conn, $selection);
      if (mysqli_num_rows($resss) > 0) {
        echo"<div class='d-flex justify-content-between'><img src='images/logo.png' alt='Logo' width='30px' height='30px'>
                            <center><p>Gicumbi District<br>Byumba Sector<br>Byumba HC<br><br><br><br><h4><u>Report on ".$patt." "."</u></h4></p></center><img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'></div>
                            <br>
                            <hr>";
        echo "<table class='table table-striped'>
        <tr>
          <th>Batchno</th>
          <th>Child names</th>
          <th>Sex</th>
          <th>Father name</th>
          <th>Father Phone</th>
          <th>Mother name</th>
          <th>Mother Phone</th>
          <th>Province</th>
          <th>District</th>
          <th>Sector</th>
          <th>Cell</th>
          <th>Village</th>
          <th>Bcg Status</th>
          <th>Bcg Date</th>
          
        </tr>";
        while ($row = mysqli_fetch_assoc($resss)) {

          echo "
          <ul class='list-group list-group-flush'>
                <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
                <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".$row['Batchno']."</li>
                <li class='list-group-item'><strong>Child Names:</strong>&nbsp;". $row['Child_names']."</li>
                <li class='list-group-item'><strong>Sex:</strong>&nbsp;".$row['Sex']."</li>
                <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".$row['Father_name']."</li>
            <li class='list-group-item'><strong>Father Phone Number:</strong>&nbsp;(+250)".$row['Father_phone']."</li>
            <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".$row['Mother_name']."</li>
            <li class='list-group-item'><strong>Mother Phone Number:</strong>&nbsp;(+250)".$row['Mother_phone']."</li>
            
                <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Location Information</h5>
            <li class='list-group-item'><strong>Nationality:</strong>&nbsp; Rwandan</li>
                <li class='list-group-item'><strong>Province:</strong>&nbsp;".$row['Province']."</li>
                <li class='list-group-item'><strong>District:</strong>&nbsp; ".$row['District']."</li>
                <li class='list-group-item'><strong>Sector:</strong>&nbsp; ".$row['Sector']."</li>
                <li class='list-group-item'><strong>Cell:</strong>&nbsp; ".$row['Cell']."</li>
                <li class='list-group-item'><strong>Village:</strong>&nbsp; ".$row['Village'] ."</li>
            <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;<center>Vaccinations Status</center></h5>
            <br>
                </ul>

          <tr>
          <td>" . $row['Batchno'] . "</td>
          <td>" . $row['Child_names'] . "</td>
          <td>" . $row['Sex'] . "</td>
          <td>" . $row['Father_name'] . "</td>
          <td>" . $row['Father_phone'] . "</td>
          <td>" . $row['Mother_name'] . "</td>
          <td>" . $row['Mother_phone'] . "</td>
          <td>" . $row['Province'] . "</td>
          <td>" . $row['District'] . "</td>
          <td>" . $row['Sector'] . "</td>
          <td>" . $row['Cell'] . "</td>
          <td>" . $row['Village'] . "</td>
          <td>" . $row['Bcg_status'] . "</td>
          <td>" . $row['Bcg_date'] . "</td>
                </tr>";
        }
        echo "</table>
        <br><br><br>Done at Gicumbi<br>
        On ". date('Y-m-d h:i:s')."
        <br>
        <br>
        Head of Byumba HC signature & stamp
        <br>
        <br>
        <br>
        <br>
        <div class='col-sm-12 mt-3 d-flex justify-content-between'>
        <a  href='export.php?searchby=$by&searchbyPattern=$patternn'><button class='btn btn-secondary'><i class='fa fa-file-excel'></i>&nbsp;&nbsp;Export to Excel</button></a>
    <button type='button' class='btn btn-primary' onclick='window.print()'>
        <i class='fas fa-print me-1 text-light'></i>Print Report
    </button>
</div>";
      } 
      else {
        echo "<script>alert('No results found');</script>";
      }
    }
  } elseif ($by == 'sector') {
    // Execute SQL query to retrieve data based on Sector
    $selectionn = "SELECT p.*, b.*, v.*
      FROM polio AS p
      INNER JOIN bcg AS b ON p.Batchno = b.Batchno
      INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno
      WHERE v.Sector = '$patternn'";

$ressss = mysqli_query($conn, $selectionn);
if (mysqli_num_rows($ressss) > 0) {
  echo"<div class='d-flex justify-content-between'><img src='images/logo.png' alt='Logo' width='30px' height='30px'>
                            <center><p>Gicumbi District<br>Byumba Sector<br>Byumba HC<br><br><br><br><h4><u>Report on ".$patt." "."</u></h4></p></center><img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'></div>
                            <br>
                            <hr>";
  echo "<table class='table table-striped'>
  <tr>
  <th>Polio(Drop) at birth</th>
  <th>Polio(Drop) at birth date</th>
  <th>Bcg Status</th>
  <th>Bcg Date</th>
  <th>Polio(Syringe) for 1.5 months</th>
  <th>Polio(Syringe)or 1.5 months date</th>
  <th>Polio(Syringe) for 2.5 months</th>
  <th>Polio(Syringe)or 2.5 months date</th>
  <th>Polio(Syringe) for 3.5 months</th>
  <th>Polio(Syringe)or 3.5 months date</th>
</tr>";
  while ($row = mysqli_fetch_assoc($ressss)) {
    echo "
    <ul class='list-group list-group-flush'>
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
          <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".$row['Batchno']."</li>
          <li class='list-group-item'><strong>Child Names:</strong>&nbsp;". $row['Child_names']."</li>
          <li class='list-group-item'><strong>Sex:</strong>&nbsp;".$row['Sex']."</li>
          <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".$row['Father_name']."</li>
      <li class='list-group-item'><strong>Father Phone Number:</strong>&nbsp;(+250)".$row['Father_phone']."</li>
      <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".$row['Mother_name']."</li>
      <li class='list-group-item'><strong>Mother Phone Number:</strong>&nbsp;(+250)".$row['Mother_phone']."</li>
      
          <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Location Information</h5>
      <li class='list-group-item'><strong>Nationality:</strong>&nbsp; Rwandan</li>
          <li class='list-group-item'><strong>Province:</strong>&nbsp;".$row['Province']."</li>
          <li class='list-group-item'><strong>District:</strong>&nbsp; ".$row['District']."</li>
          <li class='list-group-item'><strong>Sector:</strong>&nbsp; ".$row['Sector']."</li>
          <li class='list-group-item'><strong>Cell:</strong>&nbsp; ".$row['Cell']."</li>
          <li class='list-group-item'><strong>Village:</strong>&nbsp; ".$row['Village'] ."</li>
      <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;<center>Vaccinations Status</center></h5>
      <br>
          </ul>
    <tr>
              <td>" . $row['Status'] . "</td>
              <td>" . $row['Dates'] . "</td>
              <td>" . $row['Bcg_status'] . "</td>
              <td>" . $row['Bcg_date'] . "</td>
              <td>" . $row['Status2'] . "</td>
              <td>" . $row['Date2'] . "</td>
              <td>" . $row['Status3'] . "</td>
              <td>" . $row['Date3'] . "</td>
              <td>" . $row['Status4'] . "</td>
              <td>" . $row['Date4'] . "</td>
            </tr>";
  }
  echo "</table>
  <br><br><br>Done at Gicumbi<br>
  On ". date('Y-m-d h:i:s')."
  <br>
  <br>
  Head of Byumba HC signature & stamp
  <br>
  <br>
  <br>
  <br>
  <div class='col-sm-12 mt-3 d-flex justify-content-between'>
  <a  href='export.php?searchby=$by&searchbyPattern=$patternn'><button class='btn btn-secondary'><i class='fa fa-file-excel'></i>&nbsp;&nbsp;Export to Excel</button></a>
  <button type='button' class='btn btn-primary' onclick='window.print()'>
      <i class='fas fa-print me-1 text-light'></i>Print Report
  </button>
</div>";
} 
else {
  echo "<script>alert('No results found');</script>";
}

  } else {
    // Handle other search options here if needed
    echo "<script>alert('Option not implemented yet');</script>";
  }
}
?>

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
   $query0 = "SELECT * FROM  vaccination_data WHERE Batchno = '$batch_pattern'";
    $result0 = mysqli_query($conn, $query0);
    if (mysqli_num_rows($result0) > 0) {

      echo"<table class='table table-striped'><tr><th>Batchno</th><th>Child Names</th><th>DOB</th><th>Father Name</th><th>Mother Name</th><th>Father ID</th><th>Mother ID</th><th>Family Phone</th><th>Province</th><th>District</th><th>Sector</th><th>Cell</th><th>Village</th></tr>";
        while ($row = mysqli_fetch_assoc($result0)) {
            
      echo"<tr><td>".$batch_pattern."</td><td>".$row['Child_names']."</td><td>".$row['Dob']."</td><td>".$row['Father_name']."</td><td>".$row['Mother_name']."</td><td>".$row['Father_id']."</td><td>".$row['Mother_id']."</td><td>".$row['Father_phone']."</td><td>".$row['Province']."</td><td>".$row['District']."</td><td>".$row['Sector']."</td><td>".$row['Cell']."</td><td>".$row['Village']."</td></tr>

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
          </div>
       <div class="card col-xl-2 col-sm-6 col-12 mb-4">   
<button class="btn btn-secondary mb-3  dropdown-toggle"  data-bs-toggle="modal" data-bs-target="#exampleModaltrash"><i class="fas fa-trash fa-sm text-light"></i>&nbsp;&nbsp; Closed Data Report</button>
</div>
<div class="modal fade" id="exampleModaltrash" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-secondary text-light">
        <h1 class="modal-title fs-5" id="exampleModalLabel"><p style="font-family:roboto;"><i class="fas fa-trash text-light">&nbsp;&nbsp;</i>List Of All Deleted Children</p></h1>
        <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        
          <?php   
    $change=0;
    $select = "SELECT * FROM trash";
    $selectquery = mysqli_query($conn,$select);

    if (mysqli_num_rows($selectquery) > 0) {
echo "<table class='table table-striped'>
<tr>
<th>#</th>
<th>Batch No</th>
<th>Child names</th>
<th>Date of Birth</th>
<th>Sex</th>
<th>Guardian Contact</th>
<th>BCG Status</th>
<th>BCG Date</th>
<th>Polio Status</th>
<th>Polio date</th>
<th>Polio2(Syringe)</th>
<th>Polio2(Syringe) Date</th>
<th>Polio3(Syringe)</th>
<th>Polio3(Syringe) Date</th>
<th>Polio4(Syringe)</th>
<th>Polio4(Syringe) Date</th>
<th>Reason</th>
<th>Deleted on</th>
<th>Action</th>
</tr>";
  while ($row = mysqli_fetch_assoc($selectquery)) {
    $batchs=$row['Batchno'];
$child=$row['Child_names'];
$date_of_birth=$row['Dob'];
$sex=$row['Sex'];
$dob=$row['Dob'];
$dele_date=$row['deletion_date'];
$reason=$row['Reason'];
$bcg=$row['Bcg_status'];
$polio1=$row['Polio1_status'];
$polio2=$row['Polio2_status'];
$polio3=$row['Polio3_status'];
$polio4=$row['Polio4_status'];
    echo "<tr><td>".$change++."</td><td>"
    . $batchs."</td><td>"
    .$child."</td><td>"
    .$date_of_birth."</td><td>"
    .$sex."</td><td>"
    .$row['Parent_contact']."</td><td>"
    .$bcg."</td><td>"
    .$row['Bcg_date']."</td><td>"
    .$polio1."</td><td>"
    .$row['Polio1_date']."</td><td>"
    .$polio2."</td><td>"
    .$row['Polio2_date']."</td><td>"
    .$polio3."</td><td>"
    .$row['Polio3_date']."</td><td>".
    $polio4."</td><td>".
    $row['Polio4_date']."</td><td>"
    .$reason."</td><td>"
    .$dele_date."</td><td>
    
   <button class='btn btn-primary btn-sm' data-bs-target='#exampleModalToggle22' data-bs-toggle='modal'><i class='fa fa-binoculars'></i>&nbsp;View </button>
    </td></tr>";      
  }
  echo "</table>";

    }
     else {
       echo "No Current deleted Data";
        
    }

?> 

      </div>
    </div>
  </div>
</div>

<?php
echo "<div class='modal fade' id='exampleModalToggle22' aria-hidden='true' aria-labelledby='exampleModalToggleLabel2' tabindex='-1'>
<div class='modal-dialog modal-dialog-centered'>
  <div class='modal-content'>
    <div class='modal-header'>
      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>
    <img src='images/logo.png' alt='Logo' width='30px' height='30px'>&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;<img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'>
<hr>
    <br>
    <center><h2>Child Removal Report Form</h2></center>
    <br>
    <center> on:&nbsp;&nbsp; " . date('d F Y') . " </center>
    <br>
    <br><ul class='list-group list-group-flush'>
        <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Personal Information</h5>
        <li class='list-group-item' ><strong>Child Batch Number:</strong>&nbsp;".@$batchs."</li>
        <li class='list-group-item'><strong>Child Names:</strong>&nbsp; ".@$child."</li>
        <li class='list-group-item'><strong>Date of Birth:</strong>&nbsp;".@$dob."&nbsp;</li>
        <li class='list-group-item'><strong>Sex:</strong>&nbsp;".@$sex." &nbsp;</li>
        
        <li class='list-group-item'><strong>Hosipital:</strong>&nbsp; Byumba HC</li>
        
        <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Vaccinations Information</h5>
        <li class='list-group-item'><strong>BCG At birth Status:</strong>&nbsp;".@$bcg."</li>
        <li class='list-group-item'><strong>OPV1(Drop) At Birth Status:</strong>&nbsp;".@$polio1."</li>
        <li class='list-group-item'><strong>OPV(Syringe) for 1.5 Month  Status:</strong>&nbsp;".@$polio2."</li>
        <li class='list-group-item'><strong>OPV(Syringe) for 2.5 Month  Status:</strong>&nbsp;".@$polio3."</li>
        <li class='list-group-item'><strong>OPV(Syringe) for 3.5 Month  Status:</strong>&nbsp;".@$polio4."</li><br>

        <h5 class='text-dark'style='background-color:#f2f2f2;padding:8px;' >&nbsp;Removal Information </h5><br>
        <li class='list-group-item'><strong>Reason for Removal:</strong>&nbsp;".@$reason."</li>  
        <li class='list-group-item'><strong>Date for Removal:</strong>&nbsp;".@$dele_date."</li>  
        <li class='list-group-item'></li>  
        </ul>
    
    <br>
    <br><br>
    Done at byumba_hospital <br>
    <br>
    On"." ". date('Y-M-D')."
    <br>
    _________________________
    <br>
    <br>
    <br>

    </div>
    <div class='modal-footer'>
      <button class='btn btn-secondary' Onclick='window.print();'><i class='fa fa-print'></i>&nbsp;Print REport</button>
    </div>
  </div>
</div>
</div>";
?>


<div class="card col-xl-7 col-sm-6 col-12 mb-4">
  <h5 class="card-header d-flex justify-content-between text-end bg-danger">
<p class="text-light"><i class="fas fa-clock fa-sm text-light"></i>&nbsp;&nbsp;Outdated Childs for Immunization Program</p>
<p>
    <i class="fas fa-user fa-sm text-light"></i>&nbsp;&nbsp;<i class='fas fa-caret-up text-light'></i>&nbsp;&nbsp; <i class='fas fa-times text-light'></i></p></h5>
  <div class="card-body">
    <h5 class="card-title">Current Selections</h5>
    <input type="text" value="Byumba hospital (Gicumbi) HC" class="form-control mt-3" disabled/>
    <input type="text" value="Immunization program" class="form-control mt-3 mb-3" disabled/>

  <?php
$incremented = 1;
$today = date('Y-m-d');
$query1 = "SELECT * FROM polio WHERE Sms < '$today'";

$result1 = mysqli_query($conn, $query1);

if (mysqli_num_rows($result1) > 0) {
  echo "<table class='table table-striped'><tr><th>#</th><th>Batch No</th><th>BCG</th><th>OPV(Drop)</th><th>Polio2(Syringe)</th><th>Polio3(Syringe)</th><th>Polio4(Syringe)</th><th>Current Estmated Date</th></tr>";
  while ($row = mysqli_fetch_assoc($result1)) {
    echo "<tr><td>".$incremented++."</td><td>".$row['Batchno']."</td><td>Yes</td><td>".$row['Status']."</td><td>".$row['Status2']."</td><td>".$row['Status3']."</td><td>".$row['Status4']."</td><td style='color:red;'>".$row['Sms']."</td></tr>";      
  }
  echo "</table>";
} else {
  echo "<div class='alert alert-danger mt-3'><b><i class='fas fa-bell me-1'>&nbsp;&nbsp; </i>Notification</b>: No Outdated Record Found Today </div>";
}
?>

  </div>
</div>
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
        // Automatically logout after 30 min of inactivity
        setTimeout(function() {
            window.location.href = 'index.php'; // Redirect to the logout page
        }, 1800000); // 1800000 milliseconds (20 seconds)
    </script>

  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>