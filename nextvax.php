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
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
    .print-container, .print-container * {
      visibility: visible;
    }
  }
</style>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#save').click(function(event) {
    event.preventDefault();
    var formData = $('form').serialize(); // Serialize the form data
    $.ajax({
  url: "immunization.php",
  method: "POST",
  data: formData,
  dataType: "text",
  success: function(strMessage) {
    console.log("Success: " + strMessage);
    $('#message').text(strMessage);
  },
  error: function(jqXHR, textStatus, errorThrown) {
    console.log("Error: " + errorThrown);
  }
});

    });
  });

</script>

</head>

<?php
if (isset($_POST["searchh"])) {
  if(!empty($_POST['patternn'])){
    $patternn = $_POST["patternn"];
    $query = "SELECT * FROM vaccination_data WHERE Child_names LIKE '%$patternn%'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($connection));
    }

if(mysqli_num_rows($result)>0){
    while ($row = mysqli_fetch_assoc($result)) {
        $stored_child= $row["Child_names"];
        $stored_igituntu= $row["Igituntu"];
        $stored_igituntu_date= $row["Date_Igituntu"];
        $stored_igituntu_weights= $row["Igituntu_bodyweight"];

        $imbasa1=$row["Imbasa1"];
        $imbasa1_date=$row["Date1"];
        $imbasa1_weights=$row["Imbasa1_weight"];

         $imbasa2=$row["Imbasa2"];
        $imbasa2_date=$row["Date2"];
        $imbasa2_weights=$row["Imbasa2_weight"];

         $imbasa3=$row["Imbasa3"];
        $imbasa3_date=$row["Date3"];
        $imbasa3_weights=$row["Imbasa3_weight"];

        $imbasa4=$row["Imbasa4"];
        $imbasa4_date=$row["Date4"];
        $imbasa4_weights=$row["Imbasa4_weight"];

        $imbasa5=$row["Imbasa5"];
        $imbasa5_date=$row["Date5"];
        $imbasa5_weights=$row["Imbasa5_weight"];
    }
}
else
{
  echo"<script>alert('No information found')</script>";
}
}
else
{
  echo"<script>alert('fill the field first')</script>";
}
}
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
  </a>
</div>

 
    <div class="dropdown d-flex align-items-center  text-decoration-none fixed-bottom mb-3">
      <hr>
        &nbsp;  &nbsp;  &nbsp;  &nbsp;
        <small class="text-muted">&copy; 2023 Byumba Health center</small>
    
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
          <input type="submit" class="input-group-text border-0" value="Search" name='batch_search' title="Search By Batch Number">
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
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    
                    <form method="POST" class="needs-validatation">
                    <div class="input-group">
  <div class="form-outline col-9">
  <input type="text" id="form1" class="form-control" name="matching_pattern" required />
    <label class="form-label" for="form1">Search batch number...</label>
  </div>
  <input type="submit" class="btn btn-primary btn-sm"  value="Search" name="getting" onclick="this.form.classList.add('was-validated')" id="searchButton" title="Search By Child Batch Number"/>
  
</div>
 </form>
<?php
// Check if the form was submitted
if (isset($_POST['getting'])) {
    // Get the search pattern (batch number)
    $search_pattern = $_POST['matching_pattern'];

    // Initialize variables to store data
    $poliostatus = $polioweight = $polioheight = $poliodate = $poliosign = "";
    $bcgbatchno = $bcgstatus = $bcgdate = $bcgweight = $bcgheight = $bcgimpact = $bcgsms = "";

    // Construct the SQL query to check if the batch number exists in the "polio" table
    $polio_query = "SELECT * FROM polio WHERE Batchno = '$search_pattern'";
    $polio_result = mysqli_query($conn, $polio_query);

    // Construct the SQL query to check if the batch number exists in the "bcg" table
    $bcg_query = "SELECT * FROM bcg WHERE Batchno = '$search_pattern'";
    $bcg_result = mysqli_query($conn, $bcg_query);

     // Construct the SQL query to check if the batch number exists in the "bcg" table
     $vax_query = "SELECT * FROM vaccination_data WHERE Batchno = '$search_pattern'";
     $vax_result = mysqli_query($conn, $vax_query);

    // Check if the batch number exists in the "polio" table
    if (mysqli_num_rows($polio_result) > 0) {
        // Retrieve and store polio-related information
        $row = mysqli_fetch_assoc($polio_result);
        $polioschedule = $row['Schedule'];
        $poliostatus = $row['Status'];
        $polioweight = $row['Weight'];
        $polioheight = $row['Height'];
        $poliodate = $row['Dates'];
        $poliosign = $row['Sign'];
        
        $polio2status = $row['Status2'];
        $polio2weight = $row['Weight2'];
        $polio2height = $row['Height2'];
        $polio2date = $row['Date2'];
        $polio2sign = $row['Sign2'];
         $polio2schedule = $row['Schedule2'];
        
        $poli3ostatus = $row['Status3'];
        $polio3weight = $row['Weight3'];
        $polio3height = $row['Height3'];
        $polio3date = $row['Date3'];
         $polio3sign = $row['Sign3'];
        $polio3schedule = $row['Schedule3'];
        
         $polio4status = $row['Status4'];
        $polio4weight = $row['Weight4'];
        $polio4height = $row['Height4'];
        $polio4date = $row['Date4'];
        $polio4sign = $row['Sign4'];
         $polio4schedule = $row['Schedule4'];
         $poliosms = $row['Sms'];
        
        // Check if the batch number does not exist in the "bcg" table
        if (mysqli_num_rows($bcg_result) == 0) {
            echo "<script>alert('BCG at Birth Information not Found')</script>";
        }
    }

    // Check if the batch number exists in the "bcg" table
    if (mysqli_num_rows($bcg_result) > 0) {
        // Retrieve and store bcg-related information
        $row = mysqli_fetch_assoc($bcg_result);
        $bcgbatchno = $row['Batchno'];
        $bcgstatus = $row['Bcg_status'];
        $bcgdate = $row['Bcg_date'];
        $bcgweight = $row['Bcg_weight'];
        $bcgheight = $row['Bcg_height'];
        $bcgimpact = $row['Bcg_impact'];
        $bcgsms = $row['Bcg_sms'];

        $polionextvax = date('Y-m-d', strtotime($poliosms . ' + 42 days'));
        
        // Check if the batch number does not exist in the "polio" table
        if (mysqli_num_rows($polio_result) == 0) {
            echo "<script>alert('Polio(Drop) at Birth Information not Found')</script>";
        }
    }

      // Check if the batch number exists in the "bcg" table
      if (mysqli_num_rows($vax_result) > 0) {
        // Retrieve and store bcg-related information
        $row = mysqli_fetch_assoc($vax_result);
        $a= $row['Batchno'];
        $b= $row['Child_names'];
        $c= $row['Sex'];
        $d= $row['Father_name'];
        $e= $row['Father_phone'];
        $f= $row['Mother_name'];
        $g= $row['Mother_phone'];
        $h= $row['Province'];
        $i= $row['District'];
        $j= $row['Sector'];
        $k= $row['Cell'];
        $l= $row['Village'];

        if (mysqli_num_rows($vax_result) == 0) {
            echo "<script>alert('Child Information not Found')</script>";
        }
    }

    if (mysqli_num_rows($polio_result) == 0 && mysqli_num_rows($bcg_result) == 0 && mysqli_num_rows($vax_result) == 0) {
        echo "<script>alert('No Any vaccination information found')</script>";
        // Handle the case where the batch number was not found in either table
    }

$now = date('Y-m-d');
$bcgstatus; // Assuming this is your BCG status, you can change it accordingly.
$poliostatus; // Assuming this is your Polio status
$polio1status; // Assuming this is your Polio 1 status
$polio2status; // Assuming this is your Polio 2 status
$polio3status; // Assuming this is your Polio 3 status

if ($bcgstatus == "Yes" && $poliostatus == "Yes") {
    if ($poli3ostatus == "Yes") {
        if ($poliosms < $now) {
            $polioMessage = "Outdated: Next vax for OPV(syringe) for 3.5 months was on " . $poliosms . " and today is " . $now . ".";
            $polioColor = "danger"; // Danger color for outdated
        } elseif ($poliosms == $now) {
            $polioMessage = "In Time: Next vax for OPV(syringe) for 3.5 months is scheduled for today, " . $poliosms . ".";
            $polioColor = "success"; // Success color for today
        } else {
            $polioMessage = "Before Time: Next vax for OPV(syringe) for 3.5 months will be on " . $poliosms . " and today is " . $now . ".";
            $polioColor = "warning"; // Warning color for future dates
        }
    } elseif ($polio2status == "Yes") {
        if ($poliosms < $now) {
            $polioMessage = "Outdated: Next vax for OPV(syringe) for 2.5 months was on " . $poliosms . " and today is " . $now . ".";
            $polioColor = "danger"; // Danger color for outdated
        } elseif ($poliosms == $now) {
            $polioMessage = "In Time: Next vax for OPV(syringe) for 2.5 months is scheduled for today, " . $poliosms . ".";
            $polioColor = "success"; // Success color for today
        } else {
            $polioMessage = "Before Time: Next vax for OPV(syringe) for 2.5 months will be on " . $poliosms . " and today is " . $now . ".";
            $polioColor = "warning"; // Warning color for future dates
        }
    } elseif ($poliostatus == "Yes") {
        if ($poliosms < $now) {
            $polioMessage = "Outdated: Next vax for OPV(syringe) for 1.5 months was on " . $poliosms . " and today is " . $now . ".";
            $polioColor = "danger"; // Danger color for outdated
        } elseif ($poliosms == $now) {
            $polioMessage = "In Time: Next vax for OPV(syringe) for 1.5 months is scheduled for today, " . $poliosms . ".";
            $polioColor = "success"; // Success color for today
        } else {
            $polioMessage = "Before Time: Next vax for OPV(syringe) for 1.5 months will be on " . $poliosms . " and today is " . $now . ".";
            $polioColor = "warning"; // Warning color for future dates
        }
    }
} else {
    // Handle other cases if needed
}

}
?>

</div>
                </div>
              </div>
            </div>
          </div>
</div>

        <div class="card mb-3">
          <div class="card-header py-3 d-flex justify-content-between text-light bg-success">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item" aria-current="page">
      <span class="page-link bg-success text-light"><i class="fas fa-window-restore me-1"></i>&nbsp;Immunization</span>
    </li>
    <li class="page-item"><a class="page-link text-success" href="#navigate top">Move &nbsp;<i class="fas fa-caret-down me-1 text-lighy">&nbsp;&nbsp; </i></a></li>
  </ul>
</nav>
<strong class="text-light"><i class="fas fa-user me-1 text-light">&nbsp;&nbsp; </i>Next Vaccination Tab</strong>
<strong><i class="fas fa-syringe me-1 text-lighy">&nbsp;&nbsp; </i>Vaccinate your schild since get Born</strong>
<h5 class=" d-flex justify-content-end text-end"><i class="fas fa-user fa-sm text-light"></i>&nbsp;&nbsp;<i class='fas fa-caret-up'></i>&nbsp;&nbsp; <i class='fas fa-times'></i></h5>
  
          </div>
          <div class="card-body">
            <div class="row getter-3">
<div class="card col-8 ">
<form method="POST">
        <div class="row">
        <div class="input-group-text mb-3" style="height:80px;"><i class="fa fa-bell"></i>&nbsp;&nbsp;This Tab refer to childs who got 2 basic Vacciantions Bcg and OPV(Drop) at Birth</div>
          <p>BCG At birth information</p>
        <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Batch no</div>
      <input type="text" class="form-control" placeholder="Batch no..." name="batchno" value="<?php echo @$bcgbatchno; ?>">
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Status</div>
      <input type="text" class="form-control" placeholder="status..." name="bcgstatus" value="<?php echo @$bcgstatus; ?>">
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Date</div>
      <input type="date" class="form-control" placeholder="dates..." name="bcgdate" value="<?php echo @$bcgdate; ?>" readonly/>
    </div>
  </div>

<div class="col-sm-3 mb-3">
    <div class="input-group">
      <div class="input-group-text">Weights(kgs)</div>
      <input type="text" class="form-control" placeholder="weights..." name="bcgweight" value="<?php echo @$bcgweight; ?>">
    </div>
  </div>

  <div class="col-sm-5 mb-3">
    <div class="input-group">
      <div class="input-group-text">Height(cm)</div>
      <input type="text" class="form-control" placeholder="weights..." name="bcgheight" value="<?php echo @$bcgheight; ?>">
    </div>
  </div>

  <div class="col-sm-5 mb-5">
    <div class="input-group">
      <div class="input-group-text">Diverse Impact</div>
      <input type="text" class="form-control" placeholder="impacts..." name="bcgimpact" value="<?php echo @$bcgimpact; ?>">
    </div>
  </div>

 <div class="input-group-text mb-3">Polio/OPV(drop) At birth information</div>
  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Status</div>
      <input type="text" class="form-control" placeholder="status..." name="imbasa1status" value="<?php echo @$poliostatus; ?>">
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Date</div>
      <input type="date" class="form-control" placeholder="dates..." name="imbasa1date" value="<?php echo @$poliodate; ?>" readonly/>
    </div>
  </div>

<div class="col-sm-3 mb-3">
    <div class="input-group">
      <div class="input-group-text">Weights</div>
      <input type="text" class="form-control" placeholder="weight..." name="imbasa1weight" value="<?php echo @$polioweight; ?>">
    </div>
  </div>

<div class="col-sm-3 mb-3">
    <div class="input-group">
      <div class="input-group-text">Height</div>
      <input type="text" class="form-control" placeholder="height..." name="imbasa1aheight" value="<?php echo @$polioheight; ?>">
    </div>
  </div>

  <div class="col-sm-5 mb-3 mt-3">
    <div class="input-group">
      <div class="input-group-text">Diverse Impact</div>
      <input type="text" class="form-control" placeholder="impacts..." name="imbasa1sign" value="<?php echo @$poliosign; ?>">
    </div>
  </div>

 <div class="input-group-text mb-3">Polio/OPV(Syringe) for 1.5 month information</div>

   <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Status</div>
      <select   name="imbasa2status" class="form-control">
    <option class="bg-success text-light"><?php echo @$polio2status; ?></option>
    <option>Yes</option>
    <option>No</option>
</select>
    </div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Date</div>
      <input type="date" class="form-control" placeholder="dates..." 
      name="imbasa2date" value="<?php  if($polio3date=='0000-00-00') {echo date('Y-m-d'); }else{echo @$polio2date;} ?>" readonly/>
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Weights</div>
      <input type="text" class="form-control"  placeholder="weights..." 
      name="imbasa2weight" value="<?php echo @$polio2weight; ?>">
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Height</div>
      <input type="text" class="form-control" placeholder="height..." 
      name="imbasa2height" value="<?php echo @$polio2height ; ?>">
    </div>
  </div>

<div class="col-sm-5 mt-3 mb-3">
    <div class="input-group">
      <div class="input-group-text">Diverse Impact</div>
      <select name="imbasa2sign" class="form-control">
    <option class="bg-success text-light"><?php echo @$polio2sign; ?></option>
    <option>Yes</option>
    <option>No</option>
</select>
    </div>
  </div>

 <div class="input-group-text mb-3">Polio/OPV(Syringe) for 2.5 months information</div>

   <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Status</div>
       <select name="imbasa3status" class="form-control">
    <option class="bg-success text-light"><?php echo @$poli3ostatus; ?></option>
    <option>Yes</option>
    <option>No</option>
</select>
</div>
  </div>

  <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Date</div>
      <input type="date" class="form-control" placeholder="dates..." name="imbasa3date" 
      value="<?php if($polio3date=='0000-00-00') {echo date('Y-m-d'); }else{echo @$polio3date; }  ?>" readonly/>
    </div>
  </div>


<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Weights</div>
      <input type="text" class="form-control" placeholder="weights..." 
      name="imbasa3weight" value="<?php echo @$polio3weight ; ?>">
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Height</div>
      <input type="text" class="form-control" placeholder="Heights..." 
      name="imbasa3height" value="<?php echo @$polio3height ; ?>">
    </div>
  </div>

<div class="col-sm-5 mt-3 mb-3">
    <div class="input-group">
      <div class="input-group-text">Diverse Impact</div>
      <select  name="imbasa3sign" class="form-control">
    <option class="bg-success text-light"><?php echo @$polio3sign; ?></option>
    <option>Yes</option>
    <option>No</option>
</select>
    </div>
  </div>

 <div class="input-group-text mb-3">Polio/OPV(Syringe) for 3.5 months information</div>

   <div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Status</div>
      <select name="imbasa4status"  class="form-control">
         <option><?php echo @$polio4status ; ?></option>
         <option>Yes</option>
          <option>No</option>
         </select>

    </div>
  </div>

  <div class="col-sm-3">
    <label class="visually-hidden" for="specificSizeInputGroupUsername">imbasa2 Date</label>
    <div class="input-group">
      <div class="input-group-text">Date</div>
      <input type="date" class="form-control" id="specificSizeInputGroupUsername" placeholder="dates..." 
      name="imbasa4date" value="<?php  if($polio3date=='0000-00-00') {echo date('Y-m-d'); }else{echo @$polio4date ;} ?>" readonly/>
    </div>
  </div>


<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Weights</div>
      <input type="textr" class="form-control"  placeholder="weights..." 
      name="imbasa4weight" value="<?php echo @$polio4weight ; ?>">
    </div>
  </div>

<div class="col-sm-3">
    <div class="input-group">
      <div class="input-group-text">Height</div>
      <input type="text" class="form-control" placeholder="height..." 
      name="imbasa4height" value="<?php echo @$polio4height ; ?>">
    </div>
  </div>

<div class="col-sm-5 mt-3">
    <div class="input-group">
      <div class="input-group-text">Diverse Impact</div>
     <select name="imbasa4sign" class="form-control">
         <option><?php echo @$polio4sign; ?></option>
         <option>Yes</option>
          <option>No</option>
         </select>
    </div>
  </div>
  
  <div class="col-sm-5 mt-3">
    <div class="input-group">
      <div class="input-group-text">Next Vaccination Time</div>
      <input type="date" class="form-control" placeholder="next vax date..." 
      name="imbasasms" value="<?php echo $polionextvax;?>" readonly/>
    </div>
  </div>
  
  <br>
<div class="col-sm-12 mt-3">
  <?php 
// Display the Polio message with the appropriate color
if (isset($polioMessage)) {
    echo "<div class='alert alert-$polioColor mt-3'><b>Polio Status:</b> " . $polioMessage . "</div>";
}
?>
  </div>

  <div class="col-sm-6 mt-3 d-flex justify-content-end">
   <input type="submit" class="form-control btn btn-primary mt-3 " name="ups" value="Save Data" Title="Update child Vaccination Status"/>
   &nbsp;&nbsp;&nbsp;
   
   <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['ups'])) {
  if (empty($_POST['batchno']) || empty($_POST['bcgstatus']) || empty($_POST['bcgdate'])) {
        echo "<script>alert('Please fill in all required fields.')</script>";
    } else {
        // Get the form data
        $batch = $_POST['batchno'];

        $current_date=date('Y-m-d');
        // Check if any of the required fields are empty
        $query7 = "SELECT * FROM polio WHERE Batchno = '$batch'";
       $result7=mysqli_query($conn,$query7);
           while($row = mysqli_fetch_assoc($result7)){
            $next_polio_sms = $row['Sms'];
           }

        $igituntustatus = $_POST['bcgstatus'];
        $igituntudate = $_POST['bcgdate'];
        $igituntuweight = $_POST['bcgweight'];
        $igituntuheight = $_POST['bcgheight'];
        $igituntuimpact = $_POST['bcgimpact'];

        $imbasa11_status = $_POST['imbasa1status'];
        $imbasa11_date = $_POST['imbasa1date'];
        $imbasa11_weight = $_POST['imbasa1weight'];
        $imbasa11_height = $_POST['imbasa1aheight'];
        $imbasa11_impact = $_POST['imbasa1sign'];

        $imbasa22_status = $_POST['imbasa2status'];
        $imbasa22_date = $_POST['imbasa2date'];
        $imbasa22_weight = $_POST['imbasa2weight'];
        $imbasa22_height = $_POST['imbasa2height'];
        $imbasa22_impact = $_POST['imbasa2sign'];

        $imbasa33_status = $_POST['imbasa3status'];
        $imbasa33_date = $_POST['imbasa3date'];
        $imbasa33_weight = $_POST['imbasa3weight'];
        $imbasa33_height = $_POST['imbasa3height'];
        $imbasa33_impact = $_POST['imbasa3sign'];

        $imbasa44_status = $_POST['imbasa4status'];
        $imbasa44_date = $_POST['imbasa4date'];
        $imbasa44_weight = $_POST['imbasa4weight'];
        $imbasa44_height = $_POST['imbasa4height'];
        $imbasa44_impact = $_POST['imbasa4sign'];
        $imbasa_sms = $_POST['imbasasms'];

     if($next_polio_sms > $current_date || $next_polio_sms < $current_date)
     {
      echo"<script>alert('Vaccination can not be offered before or after Scheduled Date')</script>";
     }
     else{
        $sql = "UPDATE polio AS p
                INNER JOIN bcg AS b ON p.Batchno = b.Batchno
                SET 
                    p.Status = '$imbasa11_status',
                    p.Height = '$imbasa11_height',
                    p.Weight = '$imbasa11_weight',
                    p.Dates = '$imbasa11_date',
                    p.Sign = '$imbasa11_impact',
                    
                    p.Status2 = '$imbasa22_status',
                    p.Height2 = '$imbasa22_height',
                    p.Weight2 = '$imbasa22_weight',
                    p.Date2 = '$imbasa22_date',
                    p.Sign2 = '$imbasa22_impact',
                    
                    p.Status3 = '$imbasa33_status',
                    p.Height3 = '$imbasa33_height',
                    p.Weight3 = '$imbasa33_weight',
                    p.Date3 = '$imbasa33_date',
                    p.Sign3 = '$imbasa33_impact',
                    
                    p.Status4 = '$imbasa44_status',
                    p.Height4 = '$imbasa44_height',
                    p.Weight4 = '$imbasa44_weight',
                    p.Date4 = '$imbasa44_date',
                    p.Sign4 = '$imbasa44_impact',
                    p.Sms='$imbasa_sms',
                  
                    b.Bcg_status = '$igituntustatus',
                    b.Bcg_height = '$igituntuheight',
                    b.Bcg_weight = '$igituntuweight',
                    b.Bcg_date = '$igituntudate',
                    b.Bcg_impact = '$igituntuimpact'
                WHERE p.Batchno = '$batch'";

$result = mysqli_query($conn, $sql);

if ($result !== false) {
    $rows_updated = mysqli_affected_rows($conn);
    
    if ($rows_updated > 0) {
      include('sms3.php');
        echo "<script>alert('Information Successfully Saved')</script>";
        $gett_me = "SELECT * FROM vaccination_data WHERE Batchno='$batch'";
        $queeee = mysqli_query($conn, $gett_me);

        while ($geto = mysqli_fetch_assoc($queeee)) {
            $c_name = $geto['Child_names'];
           $f_name = $geto['Father_name'];
            $m_name = $geto['Mother_name'];
            
        }
                

    } else {
        echo "<script>alert('No information was updated.')</script>";
    }
} else {
    echo "<script>alert('Information Update Failed due to an error: " . mysqli_error($conn) . "')</script>";
}
}
}
}
?>
   <input type="submit" class="form-control btn btn-danger mt-3"  value="Child Data Closure" name='del' title="Remove child information from current storage for Mortality Case only"  Onclick="return confirm('Are you sure you want to close the current child data? This action cannot be undone');"/>
     
   
   <?php
// Check if the delete button is clicked
if (isset($_POST['del'])) {
    $batch = $_POST['batchno'];
    $igituntustatus = $_POST['bcgstatus'];
    $igituntudate = $_POST['bcgdate'];

    $sele= "SELECT p.*, b.*, v.*
    FROM polio AS p
    INNER JOIN bcg AS b ON p.Batchno = b.Batchno
    INNER JOIN vaccination_data AS v ON p.Batchno = v.Batchno";

    $ex=mysqli_query($conn,$sele);
while($row=mysqli_fetch_assoc($ex)){
    $Mother_phone=$row['Mother_phone'];
  $province=$row['Province'];
   $district=$row['District'];
    $sector=$row['Sector'];
     $cell=$row['Cell'];
      $village=$row['Village'];
       $Father_id=$row['Father_id'];
        $Father_name=$row['Father_name'];
          $Father_phone=$row['Father_phone'];
            $Mother_id=$row['Mother_id'];
              $Mother_name=$row['Mother_name'];
                $child_name=$row['Child_names'];
                  $dob=$row['Dob'];
                   $sex=$row['Sex'];
                     $row['Status'];
                  $polio_status1=$row['Status'];
                $date_poli1=$row['Dates'];
              $bcg_status=$row['Bcg_status'];
            $bcg_date=$row['Bcg_date'];
          $polio_status2=$row['Status2'];
        $polio_date2=$row['Date2'];
      $polio_status3=$row['Status3'];
    $polio_date3=$row['Date3'];
  $polio_status4=$row['Status4'];
$poli_date4=$row['Date4'];
}
    // Create a DELETE query to remove the record from the "polio" table
    $deletePolioSql = "DELETE FROM polio WHERE Batchno = '$batch'";
    
    // Create a DELETE query to remove the record from the "bcg" table
    $deleteBcgSql = "DELETE FROM bcg WHERE Batchno = '$batch'";
    
    // Start a transaction
    mysqli_autocommit($conn, false);
$today_date = date('Y-m-d');
    // Create an INSERT query to insert the record into the "trash" table
   $insertTrashSql = "INSERT INTO trash(Batchno,Child_names,Dob,Sex,Parent_contact,Bcg_status, Bcg_date, Polio1_status, Polio1_date, Polio2_status, Polio2_date, Polio3_status, Polio3_date, Polio4_status, Polio4_date,Reason,deletion_date)
            VALUES('$batch','$child_name','$dob','$sex','$Father_phone', '$bcg_status', '$bcg_date','$polio_status1', '$date_poli1', '$polio_status2', '$polio_date2', '$polio_status3', '$polio_date3', '$polio_status4', '$poli_date4','Death','$today_date')";
 
    // Execute the INSERT query for the "trash" table
    $insertTrashResult = mysqli_query($conn, $insertTrashSql);

    if ($insertTrashResult) {
        // The INSERT query was successful, proceed with DELETE operations
        
        // Execute the DELETE query for "polio" table
        $deletePolioResult = mysqli_query($conn, $deletePolioSql);

        // Execute the DELETE query for "bcg" table
        $deleteBcgResult = mysqli_query($conn, $deleteBcgSql);

        if ($deletePolioResult && $deleteBcgResult) {
            // Both DELETE queries were successful, commit the changes
            mysqli_commit($conn);
            echo "<script>alert('Child Information Successfully Relocated')</script>";
        } else {
            // At least one DELETE query failed, rollback the changes
            mysqli_rollback($conn);
            echo "<script>alert('Child Information Deletion Failed: " . mysqli_error($conn) . "')</script>";
        }
    } else {
        // The INSERT query for the "trash" table failed, rollback the changes
        mysqli_rollback($conn);
        echo "<script>alert('Record Rollback Failed: " . mysqli_error($conn) . "')</script>";
    }

    // End the transaction
    mysqli_autocommit($conn, true);
}
?>
</div>
</div>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <div class="card  col-sm-3 " id="collapseExample">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs">
        <li class="nav-item">
          <a class="nav-link active" aria-current="true" href="#"><i class="fa fa-user"></i>&nbsp;Child</a>
        </li>
      </ul>
    </div>
    
    <div class="card-body">
      <h5 class="card-title">Profile Information</h5>
      <hr>
      <p class="card-text">Child Batch Number</p>
      <input type="text" class="form-control mb-1" value="<?php echo @$a; ?>" readonly/>
      <p class="card-text">Child Names</p>
      <input type="text" class="form-control mb-1" value="<?php echo @$b; ?>" readonly/>
      <p class="card-text">Sex</p>
      <input type="text" class="form-control mb-1" value="<?php echo @$c; ?>" readonly/>
      <p class="card-text">Father Name</p>
      <input type="text" class="form-control mb-1" value="<?php echo @$d; ?>" readonly/>
      <p class="card-text">Father Phone Number</p>
      <input type="text" class="form-control mb-1" value="<?php echo"+250". @$e; ?>" readonly/>
      <p class="card-text">Mother Name</p>
      <input type="text" class="form-control mb-1" value="<?php echo @$f; ?>" readonly/>
      <p class="card-text">Mother Phone Number</p>
      <input type="text" class="form-control mb-1" value="<?php echo "+250". @$g; ?>" readonly/><br>
      <h5>Location Information</h5>
      <hr>
      <p class="card-text">Province</p>
      <input type="text" class="form-control " value="<?php echo @$h; ?>" readonly/>
      <p class="card-text">District</p>
      <input type="text" class="form-control " value="<?php echo @$i; ?>" readonly/>
      <p class="card-text">Sector</p>
      <input type="text" class="form-control " value="<?php echo @$j; ?>" readonly/>
      <p class="card-text">Cell</p>
      <input type="text" class="form-control" value="<?php echo @$k; ?>" readonly/>
      <p class="card-text">Village</p>
      <input type="text" class="form-control" value="<?php echo @$l; ?>" readonly/>
    </div>
  </div>
          </div>
              </div>
</div>
</div>
      
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
      </section>
      <div class="row" style="margin-left:180px;">
      <div class="col-xl-4 col-sm-4 col-12 mb-2 ">
            <div class="card print-container">
              <div class="card-body">
               <?php
               if(isset($_POST['ups'])){
                if(@$next_polio_sms > @$current_date || @$next_polio_sms < @$current_date){
                echo"<div class='alert alert-danger'><i class='fas fa-bell fa-fw me-3'></i>No Current Generated Vaccination Schedule</div>";
                }
                else{
               echo"  <div class='col-12'>
                 <img src='images/logo.png' alt='Logo' width='30px' height='30px'>&nbsp;&nbsp;&nbsp;&nbsp;
                 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/rbc.jpeg' alt='Logo' width='80px' height='40px'>
                 <br>
                 <hr><br><br>
                 
                 <center><h2>Vaccination Report Form</h2></center>
                 <br>
                 <center> on:&nbsp;&nbsp; " . date('d F Y') . " </center>
                 <br>
                 <br><ul class='list-group list-group-flush'>
        
                     <div class='input-group-text'>Child Information</div>
                     <li class='list-group-item'><strong>Child Batch Number:</strong>&nbsp;".@$batch."</li>
                     <li class='list-group-item'><strong>Child Names:</strong>&nbsp;".@$c_name."</li>
                     <li class='list-group-item'><strong>Father Name:</strong>&nbsp;".@$f_name." &nbsp;</li>
                     <li class='list-group-item'><strong>Mother Name:</strong>&nbsp;".@$m_name." &nbsp;</li>
                     
                     <li class='list-group-item'><strong>Hosipital:</strong>&nbsp; Byumba HC</li>

                     <div class='input-group-text'>Vaccinations Information</div>
                     <li class='list-group-item'><strong>BCG At birth Status:</strong>&nbsp;".@$igituntustatus."</li>
                     <li class='list-group-item'><strong>OPV1(Drop) At Birth Status:</strong>&nbsp;".@$imbasa11_status."</li>
                     <li class='list-group-item'><strong>OPV(Syringe) for 1.5 Month  Status:</strong>&nbsp".@$imbasa22_status."</li>
                     <li class='list-group-item'><strong>OPV(Syringe) for 2.5 Month  Status:</strong>&nbsp;".@$imbasa33_status."</li>
                     <li class='list-group-item'><strong>OPV(Syringe) for 3.5 Month  Status:</strong>&nbsp;".@$imbasa44_status." </li><br>
                     <h5>Next Vaccination Schedule Information</h5><br>
                     <li class='list-group-item'><strong>Next Vaccination Scheduled on:</strong>&nbsp;".@$imbasa_sms."</li>
                   
                 <div class='input-group-text'>Pediatrician Information</div>
                 <li class='list-group-item'><strong>Names:</strong>&nbsp;".@$user_name."</li>
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
             <br>
             <button class='btn btn-primary' onclick='window.print();'>Print Report</button>

         </div>";
               }
              }
               else
               {
                echo"<div class='alert alert-danger'><i class='fas fa-bell fa-fw me-3'></i>No Current Generated Vaccination Schedule Report</div>";
               }
         ?>
                    </div>
                  </div>
                </div>
          </div>
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
        }, 1800000); // 20,000 milliseconds (20 seconds)
    </script>

  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>


</html>