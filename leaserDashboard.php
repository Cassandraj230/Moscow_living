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
$id = 7;
$id2 = 1;
// Retrieve list of registered users from the database
$sql = "SELECT * FROM student_login where id = '$id2'";
$sql2 = "SELECT * FROM offcampushousing where id = '$id'";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

// Check if there are any users
if (mysqli_num_rows($result) > 0)
{
?>
<!DOCTYPE html>
<html>
    <!DOCTYPE html>
    <html>
        <head>
            <title>User Dashboard</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">

            <link rel="stylesheet" href="styles.css">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

            <style>
                .div1{
                 height: 360px;
                 text-align: center;
                 
                }
                .div2{
                    text-align: center;
                    height: 600px;
                    
                }
                .div3{
                    text-align: center;
                }
                table{
                    width: 100%;
                }
                body{
                    background-image: url("images/Dorm.jpg");
                    background-attachment: fixed;
                
                }
                .wrapper{
                        width: 600px;
                        margin: 0 auto;
                    }
                    table tr td:last-child{
                        width: 120px;
                    }

                </style>
            </head>

        <body>

            <!-- Navbar -->
            <div class="w3-top">
                <div class="w3-row w3-padding w3-black">
                    <div class="w3-col s3">
                        <a href="leaserDashboard.php" class="w3-button w3-block w3-black">HOME</a>
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

            <!-- Page Container -->
            <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
                <!-- The Grid -->
                <div class="w3-row">
                    <!-- Left Column -->
                    <div class="w3-col m3">
                        <!-- Profile -->
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container">
                                <?php
                                    // Loop through each row of the result set and display user data
                                    if ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                <br><!-- comment -->
                                <h4 class="w3-center"><?php echo $row["fname"] . ' ' . $row["lname"]; ?></h4>
                                <p class="w3-center"><img src="images/women.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                                <hr>
                                <!--After building a proper database, we can have it echoed through php-->
                                <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Hill Rental</p>
                                <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> Address</p>
                                <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> Website</p>
                            </div>
                        </div>
                         <?php
                            } // end of if statements
}
                            ?>  
                            <br>

                        <!-- Accordion -->
                       
                        <br>

                        <!-- Interests --> 
                        <div class="w3-card w3-round w3-white w3-hide-small">
                            <div class="w3-container div1">
                                <br>
                                <h3>Matched Students</h3>
                                <br><!-- comment --><br><!-- comment -->
                                <p>
                                    no current matches
                                </p>
                                
                            </div>
                        </div>
                        <br>

                        <!-- Alert Box -->
                     

                        <!-- End Left Column -->
                    </div>

                    <!-- Middle Column -->
                    <div class="w3-col m8">

                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding ">
                                        <h6 class="w3-opacity">
                                            <strong>Welcome to your Dashboard !</strong>
                                            <br> 
                                          
                                        </h6>
                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                       
                       
                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding div2">
                                 
        
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Listings</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New listing</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";
                    
                    // Attempt select query execution
                   
                    if($result2 = mysqli_query($conn, $sql2)){
                        if(mysqli_num_rows($result2) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>ID</th>";
                                        echo "<th>Location</th>";
                                        echo "<th>Price</th>";
                                        echo "<th>Bedrooms</th>";
                                        echo "<th>Bathrooms</th>";
                                        echo "<th>Wifi</th>";
                                        echo "<th>Electric</th>";
                                        echo "<th>Laundry</th>";
                                        echo "<th>Move in Date</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result2)){
                                    echo "<tr>";
                                        echo "<td>" . $row['pid'] . "</td>";
                                        echo "<td>" . $row['Location'] . "</td>";
                                        echo "<td>" . $row['Price'] . "</td>";
                                        echo "<td>" . $row['Bedrooms'] . "</td>";
                                        echo "<td>" . $row['Bathrooms'] . "</td>";
                                        echo "<td>" . $row['Wifi'] . "</td>";
                                        echo "<td>" . $row['Electric'] . "</td>";
                                        echo "<td>" . $row['Laundry'] . "</td>";
                                        echo "<td>" . $row['MoveinDate'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result2);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>        
        </div>
    </div>

       

    


</body>
</html>