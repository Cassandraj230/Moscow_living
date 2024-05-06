<?php
require 'config.php'; // Include your database connection file

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if user is logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

// Check if user ID is provided
if (!isset($_POST['id'])) {
    echo "User ID not provided.";
    exit();
}

// Retrieve user ID from POST data
$user_id = $_POST['id'];

// Validate user permissions (e.g., admin privileges)

// Delete user from the database
$sql = "DELETE FROM student_login WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    
    // Check if deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "User deleted successfully.";
    } else {
        echo "Failed to delete user.";
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);
?>
