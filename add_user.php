<?php
require 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirect to login page if tb_lab4 is not logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

// Define variables and initialize with empty values
$fname = $lname = $email = $password = $password_confirmation = "";
$errors = [];

// Process form data when form is submitted
if (filter_input_array(INPUT_SERVER)["REQUEST_METHOD"] == "POST") {
    // Validate input fields
    $fname = trim(filter_input_array(INPUT_POST)["fname"]);
    $lname = trim(filter_input_array(INPUT_POST)["lname"]);
    $email = trim(filter_input_array(INPUT_POST)["email"]);
    $password = trim(filter_input_array(INPUT_POST)["password"]);
    $password_confirmation = trim(filter_input_array(INPUT_POST)["password_confirmation"]);

    // Check for empty fields
    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        $errors[] = "Please fill in all fields.";
    }

    // If no errors, insert tb_lab4 data into database
    if (empty($errors)) {
        $sql = "INSERT INTO tb_lab4 (fname, lname, email, password, password_confirmation) VALUES (?, ?, ?, ?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $hashed_password, $hashed_password );
            
            if (mysqli_stmt_execute($stmt)) {
                header("location: menu.php");
                exit();
            } else {
                $errors[] = "Something went wrong. Please try again later.";
            }
            
            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link rel="stylesheet" href="https://classless.de/classless.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add New User</h2>
    <?php if (!empty($errors)) : ?>
        <div class="error">
            <?php foreach ($errors as $error) : ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $fname; ?>">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $lname; ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" value="<?php echo $password; ?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Submit">
            <a href="add_user.php"></a>
            <button><a href="menu.php">Show List of People</a></button>
            <button><a href="dashboard.php">Back to Dashboard</a></button>
        </div>
    </form>
</body>
</html>