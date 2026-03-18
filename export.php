<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=MyData.xls");

$patt = date('Y-m-d h:i:s');

$by = $_GET['searchby'];
 $patternn = $_GET['searchbyPattern'];
   
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

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
echo "<tr>
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
<br>";
}
else
{
  echo"no record found";
}
?>
