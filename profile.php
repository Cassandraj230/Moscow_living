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
$sql2 = "SELECT * FROM offcampuspreferences";
$sql3 = "SELECT * FROM roommatepreferences";

$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);

// Check if there are any users
if (mysqli_num_rows($result) > 0 && mysqli_num_rows($result2) > 0)
{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UoI Housing</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">

        <link rel="stylesheet" href="styles.css">
        <style>
            body {
                height: 100%;
                background-image: 'greengrid.jpg';
            }
            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                height: 10%;
                background-color: lightgrey;
                text-align: center;
            }

            .body-height{
                height:90%
            }

        </style>
    </head>

    <body>
        <div class="w3-top">
            <div class="w3-row w3-padding w3-black">
                <div class="w3-col s3">
                    <a href="studentdashboard.php" class="w3-button w3-block w3-black">HOME</a>
                </div>
                <div class="w3-col s3">
                    <a href="profile.php" class="w3-button w3-block w3-black">PROFILE</a>
                </div>
                <div class="w3-col s3">
                    <a href="settings.php" class="w3-button w3-block w3-black">SETTINGS</a>
                </div>
                <div class="w3-col s3">
                    <a href="logout.php" class="w3-button w3-block w3-black">LOGOUT</a>
                </div>
            </div>
        </div>

        <br><!-- comment -->
        <br>
        <br>
        <div class="w3-row-padding body-height">
       <div class="w3-col w3-left w3-container w3-transparent" style="width:225px"><p></p></div>
            <div class="w3-quarter w3-light-grey body-height">
                <ul class="w3-ul w3-border w3-center w3-hover-shadow body-height">

                    <?php
                    // Loop through each row of the result set and display user data
                    if ($row = mysqli_fetch_assoc($result)) {
                    ?>

                            <li class="w3-blue-grey w3-xlarge w3-padding-32">Personal Profile</li>
                            <li class="w3-padding-16 w3-xlarge"><b>Name:</b> <?php echo $row['fname'] . ' ' . $row['lname']; ?></li>
                            <li class="w3-padding-16 w3-xlarge"><b>Email Address:</b> <?php echo $row['email']; ?></li>
                            <li class="w3-padding-16 w3-xlarge"><b>Role:</b> <?php echo $row['role']; ?></li>

                </ul>    
            </div>
            <?php
            } 
            mysqli_free_result($result);
            ?>       
            <?php
            // Loop through each row of the result set and display user data
            if ($row = mysqli_fetch_assoc($result2)) {
            ?>
            <div class="w3-quarter w3-light-grey body-height">

                        <ul class="w3-ul w3-border w3-center w3-hover-shadow body-height">
                            <li class="w3-blue-grey w3-xlarge w3-padding-32">Off Campus Housing Profile</li>
                          
                            <li class="w3-padding-12 w3-xlarge"><b>Budget:</b> <?php echo $row['Budget']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Location:</b> <?php echo $row['Location']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Number of Bedrooms:</b> <?php echo $row['Bedroom']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Number of Bathrooms:</b> <?php echo $row['Bathroom']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Wifi Included:</b> <?php echo $row['Wifi']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Electric Included:</b> <?php echo $row['Electric']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Onsite Laundry:</b> <?php echo $row['Laundry']; ?></li>
                            <li class="w3-padding-12 w3-xlarge"><b>Move In Date:</b> <?php echo $row['MoveinDate']; ?></li>


  </ul>
               
                <div class="w3-center">
                    <div class="w3-container">
                            <form action="settings.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Settings</button>
                    </form>
                        
                    <form action="dashboard.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Back to Dashboard</button>
                    </form>
            </div>

            </div>
              
            </div>
              <div class="w3-quarter w3-light-grey body-height">
                <ul class="w3-ul w3-border w3-center w3-hover-shadow body-height">

                    <?php
                    // Loop through each row of the result set and display user data
                    if ($row = mysqli_fetch_assoc($result3)) {
                    ?>

                            <li class="w3-blue-grey w3-xlarge w3-padding-32">Roommate Preferences</li>
                            <li class="w3-padding-16 w3-xlarge"><b>Gender:</b> <?php echo $row['gender']; ?></li>
                            <li class="w3-padding-16 w3-xlarge"><b>Language:</b> <?php echo $row['language']; ?></li>
                            <li class="w3-padding-16 w3-xlarge"><b>Age:</b> <?php echo $row['age']; ?></li>
                            <li class="w3-padding-16 w3-xlarge"><b>Smoking:</b> <?php echo $row['smoke']; ?></li>
                            <li class="w3-padding-16 w3-xlarge"><b>Active Time:</b> <?php echo $row['activetime']; ?></li>


                </ul>    
            </div>
            <?php
            } // end of if statements
            ?>  
            <div class="w3-rest w3-container w3-white"><p></p></div>
           
        </div>
        <?php
        } // end of if statements
        ?>
       
        <footer class="footer">
            <p>&copy; 2024 Housing Site. All rights reserved.</p>
        </footer>

       
            <?php
        } else {
            echo "No users found.";
        }


        // Close connection
        mysqli_close($conn);
        ?>
    </body>
</html>
