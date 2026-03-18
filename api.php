<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM irangamimerere";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

header('Content-Type: application/json');
$output = array();

while ($row = mysqli_fetch_assoc($result)) {
    $output[] = $row;
}

$show = json_encode($output);
echo $show;

?>
