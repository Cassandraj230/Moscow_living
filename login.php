<?php
require 'config.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset(filter_input_array(INPUT_POST)["submit"])) {
    $email = filter_input_array(INPUT_POST)["email"];
    $password = filter_input_array(INPUT_POST)["password"];
    $role = filter_input_array(INPUT_POST)["role"];
    $result = mysqli_query($conn, "SELECT * FROM student_login WHERE email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if (empty($email) || empty($password) || empty($role)) {
        echo "<script>alert('All fields are required.');</script>";
    }
    else if (mysqli_num_rows($result) > 0) {
        // Verify hashed password
        if (password_verify($password, $row["password"])) {
            session_start();

            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["id"];
            if ($role === "Student"){header("Location: studentdashboard.php");}
            if ($role === "UI Agent"){header("Location: UIdashboard.php");}
            if ($role === "Rental Property"){header("Location: leaserdashboard.php");}

            exit();
        } else {
            echo
            "<script>alert('Wrong Password');</script>";
        }
    } else {
        echo
        "<script> alert('User Not Registered');</script>";
    }
}
?>
<!DOCTYPE>
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

        <!--Links (sit on top)--> 
        <div class="w3-top">
            <div class="w3-row w3-padding w3-black" style="text-align: center;">

                <a href="index.php" class="w3-text-white" 
                   style="font-size:90px; font-family: 'Chalkduster',fantasy; text-decoration: none;">
                    <strong> Moscow Living</strong>
                </a>

            </div>
        </div>

        <!-- Header with image -->
        <header class="bgimg w3-display-container w3-grayscale-min">
            <div class="text-block">
                <h1> LOG IN</h1>
                <form class="" action="" method="post" autocomplete="off">
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div><br>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div><br>

                    <div class="dropdown">
                        <label for="role">Role:</label>
                        <select name="role" id="role">
                            <option value="" selected="selected">Select a role</option>
                            <option value="Student">Student</option>
                            <option value="UI Agent">UI Agent</option>
                            <option value="Rental Property">Rental Property</option>
                        </select>
                    </div><br><br>
                    
                    <button type="submit" name="submit">Log In</button>
                </form>

                <p>Don't have an account yet?<a href="registration.php"> Register</a></p>      
            </div> 
        </header>

        <!-- Add a background color and large text to the whole page -->
        <div class="w3-sand w3-grayscale w3-large">


            <!-- Footer -->
            <footer class="w3-center w3-light-grey w3-padding-48 w3-large">
                <p>&copy; 2024 Housing Site. All rights reserved.</p>
            </footer>

            <script>
                // Tabbed Menu
                function openMenu(evt, menuName) {
                    var i, x, tablinks;
                    x = document.getElementsByClassName("menu");
                    for (i = 0; i < x.length; i++) {
                        x[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablink");
                    for (i = 0; i < x.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
                    }
                    document.getElementById(menuName).style.display = "block";
                    evt.currentTarget.firstElementChild.className += " w3-dark-grey";
                }
                document.getElementById("myLink").click();


            </script>

    </body>

</html>

