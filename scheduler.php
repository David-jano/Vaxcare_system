#! /usr/bin/php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "byumba_hospital";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Your SQL query to insert a record
$sql = "INSERT INTO test (name) VALUES ('NIYITANGA ERIC')";

if (mysqli_query($conn, $sql)) {
    echo "Record inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>

