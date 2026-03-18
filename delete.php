<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId=$_GET['id'];

    $queryyy = "DELETE FROM vaccination_data WHERE Batchno = $userId";
   $we=mysqli_query($conn,$queryyy);
 //echo "<script>alert('Form submitted')</script>";
 if ($we==true) {
    header('Location:first_vaccination.php');
 } else {
     echo "<script>alert('Failed to update data: " . mysqli_error($conn) . "')</script>";
 }
    
?>