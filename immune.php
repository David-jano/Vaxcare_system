<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


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

 if (mysqli_num_rows($polio_result) == 0 && mysqli_num_rows($bcg_result) == 0) {
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

?>