<?php // require 'config.php';
//if (!empty($_SESSION["id"])) {
  //  $id = $_SESSION["id"];
    //$result = mysqli_query($conn, "SELECT * FROM student_login WHERE id = $id");
    //$row = mysqli_fetch_assoc($result);
//} else {
  //  header("Location: index.php");
//}
//?>

<!DOCTYPE html>
<html>
<head>
<title>Moscow Living</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
<link rel="stylesheet" href="styles.css">
<style>
    body, html {
    height: 100%;
    font-family: "Inconsolata", sans-serif;
}

h1, h2, h3, h4, h5 {
    font-family: "Open Sans", sans-serif
}

.bgimg {
    background-position: center;
    background-size: cover;
    background-image: url('images/Dorm.jpg');
    min-height: 100%;
}

.menu {
    display: none;
}

.text-block {
    position: absolute;
    margin-top: 50px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: white;
    padding-left: 20px;
    padding-right: 20px;
    opacity: 90%;
}

/*Settings for login.php*/
.text-block form label {
    display: block; /* Make labels display in block for better spacing */
}

.text-block form input[type="email"],
.text-block form input[type="password"] {
    width: 100%; /* Make input fields full width */
    padding: 10px; /* Add padding to input fields */
    border: 1px solid #ccc; /* Add border to input fields */
    border-radius: 5px; /* Add rounded corners to input fields */
}

#confirmPasswordDropdownMenu {
  min-width: 100%;
}

/*Dropdonn in registration.php*/
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

/*profile.php column settings*/
* {
  box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
  float: left;
  width: 40%;
  padding: 10px;
  margin: 5px 5px 5px 5px;
  /*height: 300px;  Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.footer {
    margin-top: auto; /* Push the footer to the bottom of the page */
    background-color: #333; /* Example background color for the footer */
    color: #fff; /* Example text color for the footer */
    padding: 10px;
}
</style>
</head>

<body>
    <!-- Links (sit on top) -->
    <div class="w3-top">
        <div class="w3-row w3-padding w3-black">
            <div class="w3-col s3">
                <a href="index.php" class="w3-button w3-block w3-black">HOME</a>
            </div>
            <div class="w3-col s3">
                <a href="#about" class="w3-button w3-block w3-black">ABOUT</a>
            </div>
            <div class="w3-col s3">
                <a href="login.php" class="w3-button w3-block w3-black">LOG IN</a>
            </div>
            <div class="w3-col s3">
                <a href="registration.php" class="w3-button w3-block w3-black">REGISTER</a>
            </div>
        </div>
    </div>

    <!-- Header with image -->
    <header class="bgimg w3-display-container w3-grayscale-min">
        <div class="w3-display-bottomleft w3-center w3-padding-large w3-hide-small">
            <span class="w3-tag">Made by Students, for the students</span>
        </div>
        <div class="w3-display-middle w3-center">
            <span class="w3-text-black" style="font-size:90px; font-family: 'Chalkduster',fantasy;"><strong> Moscow<br>Living</strong></span>
        </div>
        <div class="w3-display-bottomright w3-center w3-padding-large">
            <span class="w3-text-black">Moscow, Idaho</span>
        </div>
    </header>

    <!-- Add a background color and large text to the whole page -->
    <div class="w3-sand w3-grayscale w3-large">

    <!-- About Container -->
    <div class="w3-container" id="about">
        <div class="w3-content" style="max-width:700px">
            <h5 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">ABOUT THE PAGE</span></h5>
            
            <div class="w3-panel w3-leftbar w3-light-grey">
                <p><i>Creating a robust database system with user-centric features and seamless automation, 
                the platform aims to streamline the process of finding and renting accommodations for 
                students in Moscow, ID, ultimately enhancing their overall experience and satisfaction.</p>
            </div>
            <img src="images/Dorm.jpg" style="width:100%;max-width:1000px" class="w3-margin-top">
            
            <p>
                This website is created to help the students of University of Idaho to find better and affordable housing.
                The housing can be on-campus dorms and/or apartment and off-campus apartments. The students can access their
                personal account using their Vandal credential whereas the rental companies and the University of Idaho 
                housing agents will us their organization credential to access their rental account.
                <br>
                Once they have access to their respective account, they can use this website to save their housing profile (as a student) 
                and listing details (as a leaser). When the housing the students are looking for and the listing matches, both the side gets 
                notified. After some more steps, the student can get the apartment of their dreams.
            </p>
            <p><strong>Creators:</strong> C. Jensen and S. Pradhan</p>
            <p><strong>Course:</strong> CS 360</p>
        </div>
    </div>

    <!-- End page content -->
    </div>

<!-- Footer -->
<footer class="w3-center w3-light-grey w3-padding-48 w3-large">
  <p>&copy; 2024 Housing Site. All rights reserved.</p>
</footer>


</body>
</html>
