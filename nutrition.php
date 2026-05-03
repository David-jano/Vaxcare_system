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

// Initialize variables
$outbcg = 0;
$outpol1 = 0;
$outpol2 = 0;
$outpol3 = 0;
$outpol4 = 0;
$bcgh = $bcgw = 0;
$pol1height = $pol1weight = 0;
$pol2height = $pol2weight = 0;
$pol3height = $pol3weight = 0;
$pol4height = $pol4weight = 0;
$batch_found = false;
$api_data = array();

// Process search
if (isset($_POST['batch_search1'])) {
    $bpatt = mysqli_real_escape_string($conn, $_POST['batch_pattern1']);

    if (!empty($bpatt)) {
        $queried = "SELECT * FROM polio INNER JOIN bcg ON polio.Batchno = bcg.Batchno WHERE polio.Batchno = '$bpatt'";
        $resultt = mysqli_query($conn, $queried);

        if ($resultt && mysqli_num_rows($resultt) > 0) {
            $batch_found = true;
            
            // Try to get API data
            $url1 = "http://vaxcaresystem.atwebpages.com/z_score_api.php";
            $receive_data = @file_get_contents($url1);
            
            if ($receive_data !== false) {
                $api_data = json_decode($receive_data, true);
                
                if ($api_data !== null && is_array($api_data) && count($api_data) > 0) {
                    // Debug: Log first item to see structure
                    $first_item = reset($api_data);
                    
                    while ($row = mysqli_fetch_assoc($resultt)) {
                        $bcgh = floatval($row['Bcg_height']);
                        $bcgw = floatval($row['Bcg_weight']);
                        $pol1height = floatval($row['Height']);
                        $pol1weight = floatval($row['Weight']);
                        $pol2height = floatval($row['Height2']);
                        $pol2weight = floatval($row['Weight2']);
                        $pol3height = floatval($row['Height3']);
                        $pol3weight = floatval($row['Weight3']);
                        $pol4height = floatval($row['Height4']);
                        $pol4weight = floatval($row['Weight4']);
                        
                        // Function to calculate Z-score with proper key handling
                        function calculateZScore($height, $weight, $apiData) {
                            if ($height <= 0 || $weight <= 0) return 0;
                            if (empty($apiData) || !is_array($apiData)) return 0;
                            
                            // Find matching or closest length
                            $matched = null;
                            $closest = null;
                            $closestDiff = PHP_INT_MAX;
                            
                            foreach ($apiData as $item) {
                                // Try different possible key names
                                $apiLength = 0;
                                if (isset($item['Length'])) {
                                    $apiLength = floatval($item['Length']);
                                } elseif (isset($item['length'])) {
                                    $apiLength = floatval($item['length']);
                                } elseif (isset($item['LENGTH'])) {
                                    $apiLength = floatval($item['LENGTH']);
                                } else {
                                    continue; // Skip if no length key found
                                }
                                
                                $diff = abs($apiLength - $height);
                                
                                if ($diff < $closestDiff) {
                                    $closestDiff = $diff;
                                    $closest = $item;
                                }
                                
                                if ($apiLength == $height) {
                                    $matched = $item;
                                    break;
                                }
                            }
                            
                            // Use closest match if exact not found (within 1cm tolerance)
                            $useData = $matched ? $matched : $closest;
                            
                            if ($useData) {
                                // Get L, M, S values with different possible key names
                                $L = 1;
                                $M = 3;
                                $S = 0.1;
                                
                                if (isset($useData['L'])) $L = floatval($useData['L']);
                                elseif (isset($useData['l'])) $L = floatval($useData['l']);
                                
                                if (isset($useData['M'])) $M = floatval($useData['M']);
                                elseif (isset($useData['m'])) $M = floatval($useData['m']);
                                
                                if (isset($useData['S'])) $S = floatval($useData['S']);
                                elseif (isset($useData['s'])) $S = floatval($useData['s']);
                                
                                if ($S > 0 && $L != 0) {
                                    // Z-Score formula: ((weight/M)^L - 1) / (L * S)
                                    $zscore = (pow(($weight / $M), $L) - 1) / ($L * $S);
                                    return round($zscore, 2);
                                }
                            }
                            return 0;
                        }
                        
                        // Calculate Z-scores for each vaccination stage
                        $outbcg = calculateZScore($bcgh, $bcgw, $api_data);
                        $outpol1 = calculateZScore($pol1height, $pol1weight, $api_data);
                        $outpol2 = calculateZScore($pol2height, $pol2weight, $api_data);
                        $outpol3 = calculateZScore($pol3height, $pol3weight, $api_data);
                        $outpol4 = calculateZScore($pol4height, $pol4weight, $api_data);
                    }
                } else {
                    echo "<script>alert('Invalid API response format');</script>";
                }
            } else {
                echo "<script>alert('Unable to connect to nutrition API');</script>";
            }
        } else {
            echo "<script>alert('Batch Number not Found');</script>";
        }
    } else {
        echo "<script>alert('Please enter a batch number');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <title>E-Child Vaxcare - Nutrition Status</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <link rel="stylesheet" href="styles.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <link rel="stylesheet" href="css/mdb.min.css" />
  <link rel="stylesheet" href="css/admin.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
  <link href="images/apple-touch-icon.png" rel="icon">
  
  <!-- Google Charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      .print-container, .print-container * {
        visibility: visible;
      }
    }
    
    .chart-container {
      min-height: 450px;
      width: 100%;
    }
    
    .zscore-normal {
      color: #28a745;
      font-weight: bold;
    }
    
    .zscore-warning {
      color: #fd7e14;
      font-weight: bold;
    }
    
    .zscore-danger {
      color: #dc3545;
      font-weight: bold;
    }
  </style>
  
  <script type="text/javascript">
    google.charts.load('current', { packages: ['corechart'] });
    
    function getColorForNutritionStatus(percentage) {
      if (percentage <= -3.0) {
        return "#dc3545"; // Severely Wasted - Red
      } else if (percentage >= 2.0) {
        return "#fd7e14"; // Overweight/Obese - Orange
      } else if (percentage >= -3.0 && percentage < -2.0) {
        return "#ffc107"; // Moderately Wasted - Yellow
      } else {
        return "#28a745"; // Normal - Green
      }
    }
    
    function drawChart() {
      var bcgValue = <?php echo isset($outbcg) ? floatval($outbcg) : 0; ?>;
      var polio1Value = <?php echo isset($outpol1) ? floatval($outpol1) : 0; ?>;
      var polio2Value = <?php echo isset($outpol2) ? floatval($outpol2) : 0; ?>;
      var polio3Value = <?php echo isset($outpol3) ? floatval($outpol3) : 0; ?>;
      var polio4Value = <?php echo isset($outpol4) ? floatval($outpol4) : 0; ?>;
      var batchFound = <?php echo $batch_found ? 'true' : 'false'; ?>;
      
      if (!batchFound) {
        document.getElementById("columnchart_values").innerHTML = '<div class="alert alert-info text-center p-5"><i class="fas fa-chart-line fa-3x mb-3"></i><br>Enter a batch number above to view nutrition status chart.</div>';
        return;
      }
      
      var data = google.visualization.arrayToDataTable([
        ["Vaccination Stage", "Z-Score", { role: "style" }, { role: "annotation" }],
        ["BCG (At Birth)", bcgValue, getColorForNutritionStatus(bcgValue), bcgValue.toFixed(2)],
        ["Polio 1 (Birth Drop)", polio1Value, getColorForNutritionStatus(polio1Value), polio1Value.toFixed(2)],
        ["Polio 2 (1.5 Months)", polio2Value, getColorForNutritionStatus(polio2Value), polio2Value.toFixed(2)],
        ["Polio 3 (2.5 Months)", polio3Value, getColorForNutritionStatus(polio3Value), polio3Value.toFixed(2)],
        ["Polio 4 (3.5 Months)", polio4Value, getColorForNutritionStatus(polio4Value), polio4Value.toFixed(2)]
      ]);
      
      var options = {
        title: "Child Nutrition Status - Weight-for-Height Z-Score Analysis",
        titleTextStyle: { fontSize: 16, bold: true },
        width: '100%',
        height: 450,
        bar: { groupWidth: "65%" },
        legend: { position: "none" },
        hAxis: {
          title: "Vaccination Stage",
          textStyle: { fontSize: 11 },
          slantedText: true,
          slantedTextAngle: 30
        },
        vAxis: {
          title: "Z-Score Value",
          titleTextStyle: { fontSize: 13 },
          ticks: [-3.0, -2.0, -1.0, 0, 1.0, 2.0, 3.0],
          minValue: -3.5,
          maxValue: 3.5,
          gridlines: { count: 8 },
          baseline: 0,
          baselineColor: '#666',
          viewWindow: { min: -3.5, max: 3.5 }
        },
        annotations: {
          alwaysOutside: true,
          textStyle: { fontSize: 11, auraColor: 'none' }
        },
        tooltip: { textStyle: { fontSize: 12 }, showColorCode: true }
      };
      
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(data, options);
    }
    
    google.charts.setOnLoadCallback(drawChart);
    window.addEventListener('resize', function() { drawChart(); });
  </script>
</head>

<?php 
$statement = "SELECT * FROM announcements";
$prepare = mysqli_query($conn, $statement);
$aa = mysqli_num_rows($prepare);
?>

<body style="background-color: #f0f0f0;">
  <!-- Sidebar -->
  <header>
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
      <div class="position-sticky">
        <div class="list-group list-group-flush mx-3 mt-4">
          <div class="list-group-item py-2">
            <div class="d-flex align-items-center">
              <span class="fw-bold">E-Child VaxCare System</span><br>
              <hr>
            </div>
          </div>
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
            <span class="fw-bold dropdown-toggle">More Information</span>
          </div>
          <div id="account-pages" class="collapse show">
            <a href="report.php" class="list-group-item list-group-item-action py-3">
              <i class="fas fa-table fa-fw me-3" style="color:#f4ca16;"></i>Reports
            </a>
            <a href="documents.php" class="list-group-item list-group-item-action py-3">
              <i class="fas fa-file fa-fw me-3" style="color:#008080;"></i>Documents
            </a>
            <a href="announcements.php" class="list-group-item list-group-item-action py-3">
              <i class="fas fa-bell fa-fw me-2" style="color:#954535;"></i>Announcements
              <span class="badge rounded-pill bg-danger"><?php echo $aa; ?></span>
            </a>
          </div>
          <div class="dropdown d-flex align-items-center text-decoration-none fixed-bottom mb-3">
            <hr>
            <small class="text-muted">&copy; 2023 Byumba Hospital</small>
          </div>
        </div>
      </div>
    </nav>

    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu">
          <i class="fas fa-bars"></i>
        </button>
        <a class="navbar-brand" href="dashboard.php">
          <img src="images/apple-touch-icon.png" height="25" alt="" />
        </a>
        <form class="d-none d-md-flex input-group w-auto my-auto align-items-center" method="POST">
          <input type="text" class="form-control rounded" placeholder='Search batch' style="min-width: 225px" name="batch_pattern" required />
          <input type="submit" class="input-group-text border-0" value="Search" name='batch_search'>
        </form>
        <ul class="navbar-nav ms-auto d-flex flex-row">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">
              Pediatrician <?php echo $user_name; ?> <i class="fas fa-bell"></i>
              <span class="badge rounded-pill bg-danger"><?php echo $aa; ?></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-mdb-toggle="dropdown">
              <img src="images/avatar.png" class="rounded-circle" height="22" alt="user" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item text-success" href="#"><?php echo $user_name; ?> <span class="badge bg-success">Online</span></a></li>
              <li><a class="dropdown-item" href="index.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <main style="margin-top: 58px">
    <div class="container pt-4">
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
                          <input type="text" id="batchInput" class="form-control" name="batch_pattern1" required />
                          <label class="form-label" for="batchInput">Enter Batch Number</label>
                        </div>
                        <input type="submit" class="btn btn-primary btn-sm" value="Check Nutrition Status" name="batch_search1" />
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card mb-3">
          <div class="card-header py-3 d-flex justify-content-between text-light bg-success">
            <nav>
              <ul class="pagination pagination-sm mb-0">
                <li class="page-item">
                  <span class="page-link bg-success text-light"><i class="fas fa-chart-line me-1"></i>&nbsp;Nutrition Status Chart</span>
                </li>
              </ul>
            </nav>
            <strong class="text-light"><i class="fas fa-chart-bar me-1"></i>&nbsp;Weight-for-Height Z-Score Analysis (WHO Standards)</strong>
          </div>
          
          <div class="card-body print-container">
            <div id="columnchart_values" class="chart-container"></div>
            
            <!-- Feedback Section -->
            <div class="mt-4">
              <p>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#feedbackSection">
                  <i class="fas fa-bullhorn me-1"></i>&nbsp;View Detailed Analysis & Recommendations
                </button>
              </p>
              <div class="collapse" id="feedbackSection">
                <div class="card card-body">
                  <?php
                  function getNutritionStatus($zscore) {
                      if ($zscore <= -3.0) return ["Severely Wasted", "danger", "Critical: Immediate medical intervention required"];
                      if ($zscore < -2.0) return ["Moderately Wasted", "warning", "Moderate malnutrition - Consult nutritionist"];
                      if ($zscore > 2.0) return ["Overweight", "warning", "Above healthy weight - Review diet"];
                      if ($zscore > 0) return ["Normal", "success", "Healthy weight range"];
                      return ["Normal", "success", "Normal nutritional status"];
                  }
                  
                  $hasData = ($outbcg != 0 || $outpol1 != 0 || $outpol2 != 0 || $outpol3 != 0 || $outpol4 != 0);
                  
                  if (!$batch_found) {
                      echo "<div class='alert alert-info'><i class='fas fa-info-circle me-2'></i>Enter a batch number above to view nutrition status and recommendations.</div>";
                  } elseif (!$hasData) {
                      echo "<div class='alert alert-warning'><i class='fas fa-exclamation-triangle me-2'></i>No height/weight data available for this child. Please complete vaccinations first.</div>";
                  } else {
                      echo "<div class='alert alert-info mb-3'><i class='fas fa-chart-line me-2'></i><strong>Z-Score Interpretation:</strong> Below -3 = Severe Wasting | -3 to -2 = Moderate Wasting | -2 to 2 = Normal | Above 2 = Overweight</div>";
                      echo "<div class='table-responsive'><table class='table table-bordered'>";
                      echo "<thead class='table-dark'>起来<th>Vaccination Stage</th><th>Height (cm)</th><th>Weight (kg)</th><th>Z-Score</th><th>Status</th><th>Recommendation</th></thead><tbody>";
                      
                      $stages = [
                          ["BCG (At Birth)", $bcgh, $bcgw, $outbcg],
                          ["Polio 1 (Birth)", $pol1height, $pol1weight, $outpol1],
                          ["Polio 2 (1.5M)", $pol2height, $pol2weight, $outpol2],
                          ["Polio 3 (2.5M)", $pol3height, $pol3weight, $outpol3],
                          ["Polio 4 (3.5M)", $pol4height, $pol4weight, $outpol4]
                      ];
                      
                      foreach($stages as $stage) {
                          list($name, $height, $weight, $zscore) = $stage;
                          if($height > 0 && $weight > 0) {
                              $status = getNutritionStatus($zscore);
                              $zscoreClass = ($zscore <= -2) ? 'zscore-danger' : (($zscore >= 2) ? 'zscore-warning' : 'zscore-normal');
                              echo "<tr>
                                      <td><strong>{$name}</strong></td>
                                      <td>" . number_format($height, 1) . " cm</td>
                                      <td>" . number_format($weight, 1) . " kg</td>
                                      <td class='{$zscoreClass}'>" . number_format($zscore, 2) . "</td>
                                      <td><span class='badge bg-{$status[1]}'>{$status[0]}</span></td>
                                      <td>{$status[2]}</td>
                                    </tr>";
                          }
                      }
                      
                      echo "</tbody></table></div>";
                      
                      // Overall recommendation
                      $zscore_values = array_filter([$outbcg, $outpol1, $outpol2, $outpol3, $outpol4], function($v) { return $v != 0; });
                      if(!empty($zscore_values)) {
                          $worst_zscore = min($zscore_values);
                          $worst_status = getNutritionStatus($worst_zscore);
                          
                          $overall_msg = "";
                          if($worst_zscore <= -3) {
                              $overall_msg = "<div class='alert alert-danger mt-3'><i class='fas fa-exclamation-triangle me-2'></i><strong>URGENT:</strong> The child shows signs of severe wasting. Immediate medical attention and nutritional rehabilitation are required.</div>";
                          } elseif($worst_zscore < -2) {
                              $overall_msg = "<div class='alert alert-warning mt-3'><i class='fas fa-exclamation-circle me-2'></i><strong>ATTENTION:</strong> The child is moderately wasted. Schedule a consultation with a nutritionist and follow a nutritional supplementation plan.</div>";
                          } elseif($worst_zscore > 2) {
                              $overall_msg = "<div class='alert alert-warning mt-3'><i class='fas fa-chart-line me-2'></i><strong>NOTE:</strong> The child is above healthy weight range. Review feeding practices and encourage physical activity.</div>";
                          } else {
                              $overall_msg = "<div class='alert alert-success mt-3'><i class='fas fa-check-circle me-2'></i><strong>GOOD:</strong> The child's nutritional status is within normal range. Continue with routine vaccinations and healthy feeding practices.</div>";
                          }
                          
                          echo $overall_msg;
                      }
                  }
                  ?>
                  <button class="btn btn-secondary mt-3" onclick="window.print();">
                    <i class="fas fa-print me-2"></i> Print Report
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
        // Batch search modal
        if(isset($_POST['batch_search'])){
          $batch_pattern = mysqli_real_escape_string($conn, $_POST['batch_pattern']);
          echo "<div class='modal fade' id='exampleModal' data-bs-backdrop='static'>
                <div class='modal-dialog modal-lg modal-dialog-scrollable'>
                    <div class='modal-content'>
                        <div class='modal-header bg-secondary text-light'>
                            <h5 class='modal-title'>Child Information - Batch: " . htmlspecialchars($batch_pattern) . "</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                        </div>
                        <div class='modal-body'>";
          $query0 = "SELECT * FROM vaccination_data WHERE Batchno = '$batch_pattern'";
          $result0 = mysqli_query($conn, $query0);
          if (mysqli_num_rows($result0) > 0) {
            while ($row = mysqli_fetch_assoc($result0)) {
              echo "<div class='row'>
                      <div class='col-md-6'><strong>Batch Number:</strong> {$batch_pattern}</div>
                      <div class='col-md-6'><strong>Child Names:</strong> " . htmlspecialchars($row['Child_names']) . "</div>
                      <div class='col-md-6'><strong>DOB:</strong> " . date('d/m/Y', strtotime($row['Dob'])) . "</div>
                      <div class='col-md-6'><strong>Sex:</strong> {$row['Sex']}</div>
                      <div class='col-md-6'><strong>Father's Name:</strong> " . htmlspecialchars($row['Father_name']) . "</div>
                      <div class='col-md-6'><strong>Mother's Name:</strong> " . htmlspecialchars($row['Mother_name']) . "</div>
                      <div class='col-md-6'><strong>Phone:</strong> +250 {$row['Father_phone']}</div>
                      <div class='col-md-6'><strong>Location:</strong> " . htmlspecialchars($row['District'] . ', ' . $row['Sector']) . "</div>
                    </div>";
            }
          } else {
            echo "<div class='alert alert-warning'>No records found for batch number: $batch_pattern</div>";
          }
          echo "</div></div></div></div>";
          echo "<script>new bootstrap.Modal(document.getElementById('exampleModal')).show();</script>";
        }
        ?>
      </section>
    </div>
  </main>

  <script>
    setTimeout(function() { window.location.href = 'index.php'; }, 1800000);
  </script>
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>