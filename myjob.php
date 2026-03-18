<?php
$dsn = "mysql:host=localhost;dbname=byumba_hospital";
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username,$password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$sql = "INSERT INTO test (name) VALUES (:value1)";
$value1 = "Eric";


$stmt = $pdo->prepare($sql);
$stmt->bindParam(':value1', $value1);

if ($stmt->execute()) {
    echo "Data inserted successfully!";
} else {
    echo "Error inserting data: " . $stmt->errorInfo()[2];
}

$pdo = null; // Close the connection
?>
