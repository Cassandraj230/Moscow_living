<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require('config.php');

if (isset(filter_input_array(INPUT_POST)["submit"])) {
    $fname = filter_input_array(INPUT_POST)["fname"];
    $lname = filter_input_array(INPUT_POST)["lname"];
    $email = filter_input_array(INPUT_POST)["email"];
    $password = filter_input_array(INPUT_POST)["password"];
    $password_confirmation = filter_input_array(INPUT_POST)["password_confirmation"];
    $role = filter_input_array(INPUT_POST)["role"];
    $created_at = date('Y-m-d H:i:s');
    $updated_at = date('Y-m-d H:i:s');
    $deleted_at = NULL; // Initially set to NULL
    $duplicate = mysqli_query($conn, "SELECT * FROM student_login WHERE email = '$email'");
    //if(substr($email, -19) == "vandals.uidaho.edu") {
    //  $duplicate = mysqli_query($conn, "SELECT * FROM student_login WHERE email = '$email'");
    if (empty($fname) || empty($lname) || empty($email) || empty($password) || empty($password_confirmation)) {
        echo "<script>alert('All fields are required.');</script>";
    }
    // Check if email ends with "@vandals.uidaho.edu"
    if ($role !== "Rental Property" && !preg_match("/@vandals.uidaho.edu$/", $email)) {
        echo "<script>alert('Please use your VANDAL credential.');</script>";
    } else if (mysqli_num_rows($duplicate) > 0) {
        echo
        "<script> alert('Email is Already Taken.'); </script>";
    } else {
        if ($password == $password_confirmation) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password before storing
            $query = "INSERT INTO student_login VALUES(NULL, '$fname', '$lname','$email','$hashed_password', '$role', '$created_at', '$updated_at' ,NULL)";
            mysqli_query($conn, $query);
            echo
            "<script> alert('Registration Successful'); </script>";
        } else {
            echo
            "<script> alert('Password Does Not Match.');</script>";
        }
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
        <header class="bgimg w3-display-container w3-grayscale-min" id="home">
            <div class="text-block">
                <h2>Register Now</h2>

                <form class="" action="" method="post" autocomplete="off">
                    <div>
                        <label for="fname">First Name</label>
                        <input type="text" id="fname" name="fname">
                    </div><br>
                    <div>
                        <label for="lname">Last Name</label>
                        <input type="text" id="lname" name="lname">
                    </div><br>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div><br>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                        <span id="password-strength"></span>
                    </div><br>
                    <div>
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        <span id="password-match"></span>
                    </div><br>

                    <div class="dropdown">
                        <label for="role">
                            Role:
                            <select name="role" id="role">
                                <option value="" selected="selected">Select a role</option>
                            </select>
                            <br><br>
                        </label>
                        <!--<input type="text" id="role" name="role">-->
                    </div><br>
                    <button type="submit" name="submit">Register</button>
                </form>

                <p>Already have an account?<a href="login.php"> Log In</a></p>
            </div>
        </header>

        <!-- Add a background color and large text to the whole page -->
        <div class="w3-sand w3-grayscale w3-large">

            <footer class="w3-container w3-theme-d5">
                <p>&copy; 2024 Housing Site. All rights reserved.</p>
            </footer>


            <script>
                var roleObject = {
                    "Student": {
                        //                "HTML": ["Links", "Images", "Tables", "Lists"],
                        //                "CSS": ["Borders", "Margins", "Backgrounds", "Float"],
                        //                "JavaScript": ["Variables", "Operators", "Functions", "Conditions"]
                    },
                    "UI Agent": {
                        //                "PHP": ["Variables", "Strings", "Arrays"],
                        //                "SQL": ["SELECT", "UPDATE", "DELETE"]
                    },
                    "Rental Property": {
                        //                "Hill":["a","b"],
                        //                "Palouse":["c"]
                    }
                };
                window.onload = function () {
                    var roleSel = document.getElementById("role");
                    var topicSel = document.getElementById("topic");
                    var chapterSel = document.getElementById("chapter");
                    for (var x in roleObject) {
                        roleSel.options[roleSel.options.length] = new Option(x, x, x);
                    }
                    roleSel.onchange = function () {
                            //empty Chapters- and Topics- dropdowns
                            chapterSel.length = 1;
                            topicSel.length = 1;
                        //display correct values
                        for (var y in roleObject[this.value]) {
                            topicSel.options[topicSel.options.length] = new Option(y, y, y);
                        }
                    };
                    topicSel.onchange = function () {
                            //empty Chapters dropdown
                            chapterSel.length = 1;
                        //display correct values
                        var z = roleObject[roleSel.value][this.value];
                        for (var i = 0; i < z.length; i++) {
                            chapterSel.options[chapterSel.options.length] = new Option(z[i], z[i], z[i]);
                        }
                    };
                };
                
                // Function to validate password strength
                function validatePasswordStrength(password) {
                    // Define regex patterns for uppercase, lowercase, numbers, and special characters
                    var uppercaseRegex = /[A-Z]/;
                    var lowercaseRegex = /[a-z]/;
                    var numberRegex = /[0-9]/;
                    var specialCharRegex = /[!@#$%^&*(),.?":{}|<>]/;

                    // Check if the password meets all the criteria
                    return (
                            password.length >= 8 && // Minimum length requirement
                            uppercaseRegex.test(password) && // Contains at least one uppercase letter
                            lowercaseRegex.test(password) && // Contains at least one lowercase letter
                            numberRegex.test(password) && // Contains at least one number
                            specialCharRegex.test(password) // Contains at least one special character
                            );
                }

                // Function to update password strength feedback
                function updatePasswordStrength() {
                    var password = document.getElementById("password").value;
                    var strengthSpan = document.getElementById("password-strength");
                    if (password === "") {
                        strengthSpan.textContent = ""; // Clear feedback if password field is empty
                    } else if (validatePasswordStrength(password)) {
                        strengthSpan.textContent = "Strong password";
                        strengthSpan.style.color = "green";
                    } else {
                        strengthSpan.textContent = "Weak password. Must be at least 8 characters long. Must include uppercase, lowercase, number, and special character.";
                        strengthSpan.style.color = "red";
                    }
                }

                // Update password strength feedback on input change
                document.getElementById("password").addEventListener("input", updatePasswordStrength);

                // Function to check if passwords match
                function checkPasswordMatch() {
                    var password = document.getElementById("password").value;
                    var confirmPassword = document.getElementById("password_confirmation").value;
                    var matchSpan = document.getElementById("password-match");
                    if (password === confirmPassword) {
                        matchSpan.textContent = ""; // Clear the message if passwords match
                    } else {
                        matchSpan.textContent = "Passwords don't match.";
                        matchSpan.style.color = "red";
                    }
                }

                // Update password match status on input change
                document.getElementById("password").addEventListener("input", checkPasswordMatch);
                document.getElementById("password_confirmation").addEventListener("input", checkPasswordMatch);
            </script>


</html>