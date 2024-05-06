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

// Retrieve list of registered users from the database
$sql = "SELECT * FROM student_login";
$result = mysqli_query($conn, $sql);

// Check if there are any users
if (mysqli_num_rows($result) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Menu</title>
            <link rel="stylesheet" href="https://classless.de/classless.css">
        </head>
        <body>
            <h2>User Menu</h2>
            <table>
                    <?php
                    // Loop through each row of the result set and display user data
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            Name : <?php echo $row['fname'] .' '. $row['lname']; ?><br>
                            Email Address: <?php echo $row['email']; ?><br>
                            <td>
                                <form action="settings.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit">Make Changes</button>
                                </form><form action="dashboard.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit">Back to Dashboard</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <div class="form-group">
                <button><a href="add_user.php">Add New User</a></button>
                <button><a href="logout.php">Logout</a></button>
            </div>
        </body>
    </html>
    <?php
} else {
    echo "No users found.";
}

// Close connection
mysqli_close($conn);
?>
