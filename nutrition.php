
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

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
$pol3weight = "";
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";
$pol3weight = "";
$outbcg = 0; // Initialize variables
$outpol1 = 0;
$outpol2 = 0;
$outpol3 = 0;
$outpol4 = 0;

if (isset($_POST['batch_search1'])) {
    $bpatt = $_POST['batch_pattern1'];

    // Check if the search input is empty
    if (!empty($bpatt)) {
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Sanitize user input to prevent SQL injection (use mysqli_real_escape_string or prepared statements)
        $bpatt = mysqli_real_escape_string($conn, $bpatt);

        $queried = "SELECT * FROM polio INNER JOIN bcg ON polio.Batchno = bcg.Batchno WHERE polio.Batchno = '$bpatt'";
        $resultt = mysqli_query($conn, $queried);

        if (!$resultt) {
            echo "Query Error: " . mysqli_error($conn);
        } else {
            $numRows = mysqli_num_rows($resultt);

            if ($numRows > 0) {
                $url1 = "http://vaxcaresystem.atwebpages.com/z_score_api.php";
                $receive_data = file_get_contents($url1);
                $data_decode = json_decode($receive_data, true);

                if ($data_decode !== null) {
                    $found = false; // Flag to check if a match is found

                    while ($row = mysqli_fetch_assoc($resultt)) {
                        $bcgh = $row['Bcg_height'];
                         $bcgw = $row['Bcg_weight'];
                         
                        $pol1height = $row['Height'];
                        $pol1weight = $row['Weight'];
                        
                        $pol2height = $row['Height2'];
                          $pol2weight = $row['Weight2'];
                          
                        $pol3height = $row['Height3'];
                        $pol3weight = $row['Weight3'];
                        
                        $pol4height = $row['Height4'];
                        $pol4weight = $row['Weight4'];

                        foreach ($data_decode as $apiRow) {
                            $len = (float)$apiRow['Length']; // Cast "Length" to float
                            $l = (float)$apiRow['L'];
                            $m = (float)$apiRow['M'];
                            $s = (float)$apiRow['S'];

                            if ($bcgh == $len) {
                                $outbcg = (($bcgw - $m) * pow($bcgh, $l)) / $s;
                                
                            } elseif ($pol1height == $len) {
                                $outpol1 = (($pol1weight - $m) * pow($pol1height, $l)) / $s;
                                
                            } elseif ($pol2height == $len) {
                                $outpol2 =(( $pol2weight - $m) * pow($pol2height , $l)) / $s;
                               
                            } elseif ($pol3height == $len){
                                $outpol3 = ((  $pol3weight - $m) * pow($pol3height , $l)) / $s;
                                
                            } elseif ($pol4height == $len) {
                                $outpol4 = ((  $pol4weight - $m) * pow($pol4height , $l)) / $s;
                               
                            }
                        }
                    }
                } else {
                    echo "<script>alert('Error decoding API response')</script>";
                }
            } else {
                echo "<script>alert('Batch Number not Found')</script>";
            }

            mysqli_close($conn); // Close the database connection
        }
    } else {
        echo "<script>alert('Search input is empty')</script>";
    }
}
?>
<!-- Include Google Charts library -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- Rest of your HTML and PHP code for the page -->

<script type="text/javascript">
  google.charts.load("current", { packages: ['corechart'] });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Vaccination", "Percentage", { role: "style" }],
    ["Bcg", <?php echo $outbcg; ?>, getColorForNutritionStatus(<?php echo $outbcg; ?>)],
    ["Polio1", <?php echo $outpol1; ?>, getColorForNutritionStatus(<?php echo $outpol1; ?>)],
    ["Polio2", <?php echo $outpol2; ?>, getColorForNutritionStatus(<?php echo $outpol2; ?>)],
    ["Polio3", <?php echo $outpol3; ?>, getColorForNutritionStatus(<?php echo $outpol3; ?>)],
    ["Polio4", <?php echo $outpol4; ?>, getColorForNutritionStatus(<?php echo $outpol4; ?>)],
  ]);

  function getColorForNutritionStatus(percentage) {
    if (percentage <= -3.0) {
      return "red"; // Stunting
    } else if (percentage >= 2.0) {
      return "yellow"; // Obesity
    } else {
      return "green"; // Normal
    }
  }

  var view = new google.visualization.DataView(data);
  view.setColumns([
    0,
    1,
    {
      calc: "stringify",
      sourceColumn: 1,
      type: "string",
      role: "annotation"
    },
    2
  ]);

  var options = {
    title: "Nutrition Status For child(Wasted)",
    width: 900,
    height: 400,
    bar: { groupWidth: "95%" },
    legend: { position: "none" },
    vAxis: {
      ticks: [-3.0, -2.0, 2.0],
      minValue: -3.0,
      maxValue: 2.0,
    }
  };

  var chart = new google.visualization.ColumnChart(
    document.getElementById("columnchart_values")
  );

  chart.draw(view, options);
}

</script>


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

                
<div class="col-xl-4 col-sm-6 col-12 mb-4">
            <div class="card col-12">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    
                    <form method="POST">
                    <div class="input-group">
  <div class="form-outline col-9">
    <input type="text" id="form1" class="form-control" name="batch_pattern1" />
    <label class="form-label" for="form1">Search by Batch No</label>
  </div>
  <input type="submit" class="btn btn-primary btn-sm" value="Search" name="batch_search1" />
</div>
 </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
</div>

        <div class="card mb-3" >

          <div class="card-header py-3 d-flex justify-content-between text-light bg-success">
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item" aria-current="page">
      <span class="page-link bg-success text-light"><i class="fas fa-list me-1"></i>&nbsp;Charts</span>
    </li>
    <li class="page-item"><a class="page-link text-success" href="#navigate top">OPV &nbsp;<i class="fas fa-caret-down me-1 text-lighy">&nbsp;&nbsp; </i></a></li>

 <li class="page-item"><a class="page-link text-success" href="#navigate top">BCG&nbsp;<i class="fas fa-caret-down me-1 text-lighy">&nbsp;&nbsp; </i></a></li>

  </ul>
</nav>
<strong class="text-light"><i class="fas fa-chart-bar me-1 text-light">&nbsp;&nbsp; </i>Test Wasted Child by Bach Number </strong>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"/>
                <label class="form-check-label" ></label>
              </div>
          </div>
          <div class="card-body print-container">
 
    <div id="columnchart_values" ></div>

    <!-- Display the graph here -->

<div id="columnchart_values"></div>

<!-- Add a section for feedback or recommendation -->
<div class="mt-4">
<p>
  <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
    <strong><i class='fas fa-bullhorn me-1 text-lighy'></i>&nbsp;&nbsp; Feedback and Recommendation</strong>
  </button>
</p>
<div style="min-height: 120px;">
  <div class="collapse collapse-horizontal" id="collapseWidthExample">
    <div class="card card-body" style="width: 900px;">
     
  <?php
// Define a function to provide feedback based on the value
function getFeedback($value)
{
    if ($value < -3.0) {
        return "Severely Wasted";
    } elseif ($value >= -3.0 && $value < -2.0) {
        return "Moderately or Severely Wasted";
    } elseif ($value > 2.0) {
        return "Overweight";
    } else {
        return "Normal";
    }
}

// Get feedback for all variables
$feedbackBcg = @getFeedback($outbcg);
$feedbackPolio1 = @getFeedback($outpol1);
$feedbackPolio2 = @getFeedback($outpol2);
$feedbackPolio3 = @getFeedback($outpol3);
$feedbackPolio4 = @getFeedback($outpol4);

// Create an array of feedback values for all variables
$feedbackValues = [$feedbackBcg, $feedbackPolio1, $feedbackPolio2, $feedbackPolio3, $feedbackPolio4];

// Determine the highest feedback value
$highestFeedback = max($feedbackValues);

// Create an array of feedback messages
$feedbackMessages = [
    "Severely Wasted" => "The child is severely wasted. Immediate medical attention is required.",
    "Moderately or Severely Wasted" => "The child is moderately or severely wasted. Consult a healthcare professional.",
    "Overweight" => "The child is overweight. Consider a balanced diet and exercise.",
    "Normal" => "The child's nutrition status is normal. Maintain a healthy lifestyle."
];

// Display feedback for each variable
echo "Feedback for Bcg: $feedbackBcg<br>";
echo "Feedback for Polio1: $feedbackPolio1<br>";
echo "Feedback for Polio2: $feedbackPolio2<br>";
echo "Feedback for Polio3: $feedbackPolio3<br>";
echo "Feedback for Polio4: $feedbackPolio4<br>";

// Provide a general recommendation based on the highest feedback value
echo "<div class='alert alert-warning mt-3'><strong><i class='fas fa-bell me-1 text-warning'></i>&nbsp;&nbsp; Recommendation:</strong> " . $feedbackMessages[$highestFeedback] . "</div>";

?>
<button class="btn btn-secondary" Onclick="window.print();"><i class="fa fa-print"></i>&nbsp;&nbsp; Print Graphic Data</button>
    </div>
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
                    
$query0 = "SELECT * FROM vaccination_data WHERE Batchno = '$batch_pattern'";
$result0 = mysqli_query($conn, $query0);

if (mysqli_num_rows($result0) > 0) {
    echo "<table class='table table-striped'><tr><th>Batchno</th><th>Child Names</th><th>DOB</th><th>Sex</th><th>Father Name</th><th>Mother Name</th><th>Father ID</th><th>Mother ID</th><th>Family Phone</th><th>Province</th><th>District</th><th>Sector</th><th>Cell</th><th>Village</th></tr>";
    while ($row = mysqli_fetch_assoc($result0)) {
        $desired_sex = "Male";
        if ($row['Sex'] == $desired_sex) {
            echo "<tr><td>".$batch_pattern."</td><td>".$row['Child_names']."</td><td>".$row['Dob']."</td><td>".$row['Sex']."</td><td>".$row['Father_name']."</td><td>".$row['Mother_name']."</td><td>".$row['Father_id']."</td><td>".$row['Mother_id']."</td><td>".$row['Father_phone']."</td><td>".$row['Province']."</td><td>".$row['District']."</td><td>".$row['Sector']."</td><td>".$row['Cell']."</td><td>".$row['Village']."</td></tr>
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

}else
{
  echo"<script>alert('Invalid Batch Number')</script>";
}
    }    ?>

      
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
        // Automatically logout after 90 seconds of inactivity
        setTimeout(function() {
            window.location.href = 'index.php'; // Redirect to the logout page
        }, 1800000); // 90,000 milliseconds (20 seconds)
    </script>

  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>