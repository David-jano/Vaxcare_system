<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Escape the value to prevent SQL injection
    $escaped_id = mysqli_real_escape_string($conn, $id);

    $sql = "DELETE FROM employees WHERE ID = '$escaped_id'";
    $delete = mysqli_query($conn, $sql);

    if ($delete) {
        echo "<script>alert('Record with ID $escaped_id deleted successfully')</script>";
        header('location: admin_user_management.php');
    } else {
        echo "<script>alert('Error deleting record: " . mysqli_error($conn) . "')</script>";
    }
} else {
    // Handle the case where 'id' is not provided
    echo "<script>alert('ID parameter is missing')</script>";
}

?>
