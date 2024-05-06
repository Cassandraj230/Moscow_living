<?php
require 'config.php';
if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Current listing</title>
        <link rel="stylesheet" href="https://classless.de/classless.css">
        
        <link rel="stylesheet" href="dashboard.css">
      
    </head>
    <body>
        <nav>
            <div class="row">
                <div class="col">
                    <a href="UidahoDashboard.php" class="button">DASHBOARD</a>
                </div>
                <div class="col">
                    <a href="currentlist.php" class="button">LISTINGS</a>
                </div>
                <div class="col">
                    <a href="newlist.php" class="button">NEW LISTING</a>
                </div>
                 <div class="col">
                    <a href="profile.php" class="button">PROFILE</a>
                </div>
                <div class="col">
                    <a href="logout.php" class="button">LOG OUT</a>
                </div>
                
            </div>
    
            </nav>
        <h2>Active Listings</h2>
       <hr>
       
       
       <br><!-- comment -->
       <div class="container-lg">
           <br>
           <h3>Active Listings</h3>

       </div>
      
    </body>
   
</html>
