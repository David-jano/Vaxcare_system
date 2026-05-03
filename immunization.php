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
      var formData = $('form').serialize();
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
          <a href="nextvax.php" class="list-group-item list-group-item-action py-3">
            <i class="fas fa-syringe fa-fw me-3" style="color:brown;"></i>Next Vaccination
          </a>
          <a href="nutrition.php" class="list-group-item list-group-item-action py-3">
            <i class="fas fa-chart-line fa-fw me-3" style="color:red;"></i>Nutrition Status
          </a>

          <div class="list-group-item py-2" data-bs-toggle="collapse" data-bs-target="#account-pages">
            <span class="fw-bold dropdown-toggle">More Information</span>
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
     
          <div class="dropdown d-flex align-items-center text-decoration-none fixed-bottom mb-3">
            <hr>
            &nbsp; &nbsp; &nbsp; &nbsp;
            <small class="text-muted">&copy; 2023 Byumba Hospital</small>
          </div>
        </div>
      </div>
    </nav>

    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <a class="navbar-brand" href="dashboard.php">
          <img src="images/apple-touch-icon.png" height="25" alt="" loading="lazy" />&nbsp;
        </a>
        
        <form class="d-none d-md-flex input-group w-auto my-auto align-items-center" method="POST">
          <input type="text" class="form-control rounded" placeholder='Search batch' style="min-width: 225px" name="batch_pattern" required />
          <input type="submit" class="input-group-text border-0" value="Search" name='batch_search'>
        </form>

        <ul class="navbar-nav ms-auto d-flex flex-row">
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

          <li class="nav-item">
            <a class="nav-link me-3 me-lg-0" href="#">
              <i class="fas fa-cog"></i>
            </a>
          </li>
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="#">
              <i class="fas fa-thermometer"></i>
            </a>
          </li>

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

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <div class="d-flex align-items-center">
                <img src="images/avatar.png" class="rounded-circle dropdown-toggle" height="22" alt="user" loading="lazy" />
                <span class="position-relative" style="width:-4px;">
                  <span class="position-absolute top-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle"></span>
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
    </nav>
  </header>

  <!--Main layout-->
  <main style="margin-top: 58px">
    <div class="container pt-4">
      <section>
        <div class="row">
          <div class="col-xl-4 col-sm-6 col-12 mb-4">
            <div class="card col-12">
              <div class="card-body">
                <div class="d-flex justify-content-between px-md-1">
                  <div>
                    <form method="POST" class="needs-validatation">
                      <div class="input-group">
                        <div class="form-outline col-9">
                          <input type="search" id="form1" class="form-control was-validated" name="find_pattern" required />
                          <label class="form-label" for="form1">Search batch number...</label>
                        </div>
                        <input type="submit" class="btn btn-primary btn-sm" value="Search" name="find" onclick="this.form.classList.add('was-validated')"/>
                      </div>
                    </form>
                    
                    <?php
                    $message = "";
                    if (isset($_POST['find'])) {
                      $pattern = $_POST['find_pattern'];
                      $query = "SELECT * FROM vaccination_data WHERE Batchno = '$pattern'";
                      $result = $conn->query($query);

                      if ($result->num_rows > 0) {
                        while($row=mysqli_fetch_assoc($result)){
                          $weights=$row['Weight_at_birth'];
                          $heights=$row['Height_at_birth'];
                        }
                        echo "<div class='modal fade' id='exampleModalling' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                              <div class='modal-dialog'>
                                  <div class='modal-content'>
                                      <div class='modal-header bg-secondary text-light'>
                                          <h5 class='modal-title' id='editModalLabel'>Data for ".$pattern."</h5>
                                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                      </div>
                                      <div class='modal-body'>
                                          <div class='row'>
                                          <form method='POST' class='needs-validation'>
                                              <div class='col-sm-12'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>Batch no</div>
                                                  <input type='text' class='form-control' id='specific' placeholder='batch no...' name='batch' value='".$pattern."' readonly/>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>Schedule</div>
                                                  <select name='schedule' class='form-control dropdown-toggle'>
                                                    <option>At Birth</option>
                                                  </select>
                                                  <div class='input-group-text'><i class='fas fa-caret-down'></i></div>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>Vax type</div>
                                                  <select name='type' class='form-control dropdown-toggle' id='loginAsSelect' onchange='toggleResetPasswordLink()'>
                                                    <option>BCG</option>
                                                    <option>OPV(drop)</option>
                                                  </select>
                                                  <div class='input-group-text'><i class='fas fa-caret-down'></i></div>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>Heights(cm)</div>
                                                  <input type='text' class='form-control' placeholder='cm...' name='height' value='".$heights."' required/>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>weight(kgs)</div>
                                                  <input type='text' class='form-control' placeholder='kgs...' name='weight' value='".$weights."' required/>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>Age</div>
                                                  <input type='text' class='form-control' value='0' name='age' readonly/>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                <div class='input-group'>
                                                  <div class='input-group-text'>Date at Visit</div>
                                                  <input type='date' class='form-control' name='date_done' value='".date('Y-m-d')."' readonly/>
                                                  <div class='input-group-text'><i class='fas fa-caret-down'></i></div>
                                                </div>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                Direct Impact: &nbsp;&nbsp;&nbsp;&nbsp;
                                                Yes &nbsp; <input type='radio' name='impact' value='Yes' required/> &nbsp; &nbsp;
                                                No &nbsp;<input type='radio' name='impact' value='No' required/>
                                              </div>

                                              <div class='col-sm-12 mt-3' id='resetPasswordLink'>
                                                Hepatitis Case: &nbsp;&nbsp;&nbsp;&nbsp;
                                                Yes &nbsp;<input type='radio' name='case' value='Yes'>&nbsp; &nbsp; 
                                                No &nbsp;<input type='radio' name='case' value='No'>
                                              </div>

                                              <div class='col-sm-12 mt-3'>
                                                Status: &nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type='checkbox' name='status'>&nbsp; Taken
                                              </div>
                                          </div>
                                      </div>
                                      <div class='modal-footer'>
                                          <input type='submit' class='btn btn-primary' value='Save and Continue' name='save_me'>
                                      </div>
                                      </form>
                                  </div>
                              </div>
                          </div>";

                        echo "<script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var myModal = new bootstrap.Modal(document.getElementById('exampleModalling'));
                                myModal.show();
                            });
                        </script>";
                      } else {
                        echo "<div class='alert alert-danger mt-3'><i class='fas fa-times-circle'></i>&nbsp;&nbsp;Batch Number <b>". $pattern."</b> not found";
                      }
                    }
                    ?>

                    <script>
                    function toggleResetPasswordLink() {
                      const loginAsSelect = document.getElementById('loginAsSelect');
                      const resetPasswordLink = document.getElementById('resetPasswordLink');

                      if (loginAsSelect.value === 'OPV(drop)') {
                        resetPasswordLink.style.display = 'none';
                      } else {
                        resetPasswordLink.style.display = 'block';
                      }
                    }
                    toggleResetPasswordLink();
                    </script>

                    <?php
                    if (isset($_POST['save_me'])) {
                      $batch = $_POST['batch'];
                      $type = $_POST['type'];
                      $height = $_POST['height'];
                      $weight = $_POST['weight'];
                      $date_done = $_POST['date_done'];
                      $age = $_POST['age'];
                      $schedule = $_POST['schedule'];
                      $impact = $_POST['impact'];
                      
                      // FIXED: Initialize case variable properly
                      $case = isset($_POST['case']) ? $_POST['case'] : 'No';
                      
                      $date = date('Y-m-d');
                      $bcgnextDate = date('Y-m-d', strtotime($date . ' + 14 days'));
                      $polionexthepa_vax = date('Y-m-d', strtotime($bcgnextDate . ' + 42 days'));
                      $polionextvax = date('Y-m-d', strtotime($date . ' + 42 days'));

                      if (isset($_POST['status'])) {
                          $status = "Yes";
                      } else {
                          $status = "No";
                      }
                      
                      $insertRecord = true;
                      $insertion = '';

                      // FIXED: BCG duplicate check with proper error message
                      if ($type == "BCG") {
                          $test = "SELECT * FROM bcg WHERE Batchno = '$batch'";
                          $testq = mysqli_query($conn, $test);
                          
                          if (mysqli_num_rows($testq) > 0) {
                              echo "<div class='alert alert-warning mt-3'><i class='fas fa-exclamation-triangle'></i>&nbsp;&nbsp;Child has already received BCG vaccine. Cannot administer twice.</div>";
                              $insertRecord = false;
                          } else {
                              // Check if the child has already received Polio (should get BCG first)
                              $polioCheck = "SELECT * FROM polio WHERE Batchno = '$batch'";
                              $polioResult = mysqli_query($conn, $polioCheck);
                              if (mysqli_num_rows($polioResult) > 0) {
                                  echo "<div class='alert alert-warning mt-3'><i class='fas fa-exclamation-triangle'></i>&nbsp;&nbsp;Child must receive BCG before Polio vaccine. Please administer BCG first.</div>";
                                  $insertRecord = false;
                              } else {
                                  if($case == 'Yes'){
                                      $insertion = "INSERT INTO bcg (Batchno, Bcg_status, Bcg_height, Bcg_weight, Bcg_age, Bcg_schedule, Bcg_date, Bcg_impact, Bcg_hepatitis_case, Bcg_sms)
                                                    VALUES ('$batch', '$status', '$height', '$weight', '$age', '$schedule', '$date_done', '$impact', '$case', '$bcgnextDate')";
                                      $nextVaxDate = $bcgnextDate;
                                  } else {
                                      $insertion = "INSERT INTO bcg (Batchno, Bcg_status, Bcg_height, Bcg_weight, Bcg_age, Bcg_schedule, Bcg_date, Bcg_impact, Bcg_hepatitis_case, Bcg_sms)
                                                    VALUES ('$batch', '$status', '$height', '$weight', '$age', '$schedule', '$date_done', '$impact', '$case', '$date')";
                                      $nextVaxDate = $date;
                                  }
                              }
                          }
                      } 
                      // FIXED: OPV condition with proper validation
                      elseif ($type == "OPV(drop)") {
                          // Check if BCG has been administered first
                          $bcgCheck = "SELECT * FROM bcg WHERE Batchno = '$batch'";
                          $bcgResult = mysqli_query($conn, $bcgCheck);
                          
                          if (mysqli_num_rows($bcgResult) == 0) {
                              echo "<div class='alert alert-danger mt-3'><i class='fas fa-exclamation-triangle'></i>&nbsp;&nbsp;Child must receive BCG vaccine first before Polio vaccine.</div>";
                              $insertRecord = false;
                          } else {
                              // Check if Polio has already been given
                              $test = "SELECT * FROM polio WHERE Batchno = '$batch'";
                              $testq = mysqli_query($conn, $test);
                              
                              if (mysqli_num_rows($testq) > 0) {
                                  echo "<div class='alert alert-warning mt-3'><i class='fas fa-exclamation-triangle'></i>&nbsp;&nbsp;Child has already received Polio vaccine. Cannot administer twice.</div>";
                                  $insertRecord = false;
                              } else {
                                  // Check BCG date to ensure proper schedule
                                  $bcgData = mysqli_fetch_assoc($bcgResult);
                                  $bcgDate = $bcgData['Bcg_date'];
                                  $bcgSms = $bcgData['Bcg_sms'];
                                  
                                  // FIXED: Proper date comparison
                                  $currentDate = new DateTime($date);
                                  $bcgVaxDate = new DateTime($bcgSms);
                                  
                                  // Allow vaccination on or after the scheduled date
                                  if ($currentDate < $bcgVaxDate) {
                                      echo "<div class='alert alert-danger mt-3'><i class='fas fa-exclamation-triangle'></i>&nbsp;&nbsp;Vaccination cannot be offered before the scheduled date. Scheduled date: " . $bcgSms . "</div>";
                                      $insertRecord = false;
                                  } else {
                                      $insertion = "INSERT INTO polio (Batchno, Schedule, Status, Height, Weight, Dates, Sign, Schedule2, Status2, Height2, Weight2, Date2, Sign2, Schedule3, Status3, Height3, Weight3, Date3, Sign3, Schedule4, Status4, Height4, Weight4, Date4, Sign4, Sms)
                                                    VALUES ('$batch', '$schedule', '$status', '$height', '$weight', '$date_done', '$impact', '1.5 Months', 'No', '0', '0', '0000-00-00', 'No', '2.5 Months', 'No', '0', '0', '0000-00-00', 'No', '3.5 Months', 'No', '0', '0', '0000-00-00', 'No', '$polionextvax')";
                                      $nextVaxDate = $polionextvax;
                                  }
                              }
                          }
                      }

                      // Insert record if conditions are met
                      if ($insertRecord && !empty($insertion)) {
                          if ($conn->query($insertion) === TRUE) {
                              echo "<div class='alert alert-success mt-3'><i class='fas fa-check-circle'></i>&nbsp;&nbsp;Immunization Information Successfully saved</div>";
                              
                              // Display report modal
                              echo "<div class='modal fade print-container' id='reportModal' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='reportModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <h5 class='modal-title' id='reportModalLabel'>Vaccination Report</h5>
                                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                            </div>
                                            <div class='modal-body'>
                                                <div class='col-12'>
                                                    <img src='images/logo.png' alt='Logo' width='30px' height='30px'>&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src='images/rbc.jpeg' alt='Logo' width='80px' height='30px'>
                                                    <br>
                                                    <hr><br><br>
                                                    <center><h2>Vaccination Report Form</h2></center>
                                                    <br>
                                                    <center> on: " . date('d F Y') . " </center>
                                                    <br>
                                                    <ul class='list-group list-group-flush'>
                                                        <h4>Child Information</h4>
                                                        <li class='list-group-item'><strong>Child Batch Number:</strong>&nbsp; $batch</li>
                                                        <li class='list-group-item'><strong>Height:</strong>&nbsp;$height Cm</li>
                                                        <li class='list-group-item'><strong>Weight:</strong>&nbsp; $weight Kgs</li>
                                                        <li class='list-group-item'><strong>Child Age:</strong>&nbsp; $age Years</li>
                                                        <li class='list-group-item'><strong>Hospital:</strong>&nbsp; Byumba HC</li>
                                                        <h4>Vaccination Information</h4>
                                                        <li class='list-group-item'><strong>Vaccination Type:</strong>&nbsp; $type</li>
                                                        <li class='list-group-item'><strong>Vaccination Date:</strong>&nbsp; $date_done</li>
                                                        <li class='list-group-item'><strong>Next Vaccination Schedule:</strong>&nbsp; $nextVaxDate</li>
                                                        <h4>Pediatrician Information</h4>
                                                        <li class='list-group-item'><strong>Names:</strong>&nbsp; $user_name</li>
                                                    </ul>
                                                    <br>
                                                    Done at Byumba Hospital <br>
                                                    On " . date('Y-m-d') . "<br>
                                                    _________________________<br>
                                                </div>
                                            </div>
                                            <div class='modal-footer'>
                                                <button class='btn btn-primary' onclick='window.print();'>Print Report</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                              
                              echo "<script>
                                  document.addEventListener('DOMContentLoaded', function() {
                                      var myModal = new bootstrap.Modal(document.getElementById('reportModal'));
                                      myModal.show();
                                  });
                              </script>";
                              
                              // Include SMS functions if needed
                              if ($type == "OPV(drop)") {
                                  // include('sms2.php');
                              } else {
                                  // include('sms1.php');
                              }
                          } else {
                              echo "<div class='alert alert-danger mt-3'><b>Error:</b> " . mysqli_error($conn) . "</div>";
                          }
                      }
                    }
                    ?>
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
              <strong class="text-light"><i class="fas fa-user me-1 text-light">&nbsp;&nbsp; </i>Owned by Byumba Hospital(Gicumbi)HC</strong>
              <strong><form method="POST"><input type="submit" class="btn btn-outline-light btn-sm rounded-pill" value="Caches" name="caching"/></form></strong>
              <?php
              if(isset($_POST['caching'])){
                $mysql_cache="TRUNCATE smscheck";
                $myquery_cache=mysqli_query($conn,$mysql_cache);
              }
              ?>
              <h5 class="d-flex justify-content-end text-end"><i class="fas fa-user fa-sm text-light"></i>&nbsp;&nbsp;<i class='fas fa-caret-up'></i>&nbsp;&nbsp; <i class='fas fa-times'></i></h5>
            </div>
            
            <div class="card-body">
              <div class="row getter-3">
                <div class="card col-6">
                  <h5 class="card-header d-flex justify-content-end text-end"><i class="fas fa-user fa-sm text-dark"></i>&nbsp;&nbsp;<i class='fas fa-caret-up'></i>&nbsp;&nbsp; <i class='fas fa-times'></i></h5>
                  <div class="card-body">
                    <h5 class="card-title">Current Selections</h5>
                    <input type="text" value="Byumba hospital (Gicumbi) HC" class="form-control mt-3" disabled/>
                    <input type="text" value="Immunization program" class="form-control mt-3" disabled/>
                  </div>
                </div>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div class="card col-5">
                  <div class="card-body">
                    <h5 class="card-title">Other Selection</h5>
                    <div class="alert alert-warning">No current Program Selected</div>
                    <a href="nextvax.php" class="btn btn-secondary"><i class="fa fa-syringe"></i>&nbsp;&nbsp;Next Vaccination</a>
                  </div>
                </div>
              </div>

              <!-- Modal for next vaccination -->
              <div class="modal fade" id="exampleModaling" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"> 
                <div class="modal-dialog modal-lg modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header bg-secondary">
                      <form method="POST" class="needs-validatation" id="myForm">
                        <div class="row">
                          <div class="col">
                            <div class="form-outline">
                              <input type="text" id="form1" class="form-control bg-secondary text-light" name="matching_pattern" required />
                              <label class="form-label text-light" for="form1">Search Batch no...</label>
                            </div>
                          </div>
                          <div class="col-auto">
                            <input type="submit" class="btn btn-primary btn-sm" value="Search" name="getting" onclick="this.form.classList.add('was-validated')" id="searchButton"/>
                          </div>
                        </div>
                      </form>
                      <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="POST">
                        <!-- Modal content - keep existing code -->
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <script>
    window.addEventListener("load", function () {
      const cardItems = document.querySelectorAll(".card-item");
      cardItems.forEach(function (item) {
        item.style.opacity = "1";
      });
    });

    setTimeout(function() {
      window.location.href = 'index.php';
    }, 1800000);
  </script>

  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>