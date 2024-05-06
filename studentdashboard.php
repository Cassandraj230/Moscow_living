<?php
require 'config.php';

// Check if user is logged in
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    header("Location: login.php");
    exit();
}

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT * FROM student_login WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login.php");
}

// Process form submission if the form is submitted
if (isset(filter_input_array(INPUT_POST)['submit'])) {
    // Retrieve form data
    $education_progress = filter_input_array(INPUT_POST)['education_progress'];
    $room_type = filter_input_array(INPUT_POST)['room_type'];
    $bathroom_type = filter_input_array(INPUT_POST)['bathroom_type'];
    $floor_type = filter_input_array(INPUT_POST)['floor_type'];
    $kitchen = filter_input_array(INPUT_POST)['kitchen'];
    $open_summer = filter_input_array(INPUT_POST)['open_summer'];
    $open_winter = filter_input_array(INPUT_POST)['open_winter'];

    // Calculate score based on selected options
    $score = 0;

    // Assign scores to different criteria
    // Example: For each option, you can assign a score based on its importance
    if ($education_progress === 'Freshman') {
        $score += 10; // Higher score for selecting a single room
    } else if ($education_progress === 'Returning') {
        $score += 5; // Lower score for selecting a double room
    } else {
        $score += 3;
    }

    // Repeat the above process for other criteria...
    // Provide recommendation based on the total score
    if ($score >= 20) {
        $recommendation = "Based on your preferences, we recommend Dorm A.";
    } elseif ($score >= 10) {
        $recommendation = "Based on your preferences, we recommend Dorm B.";
    } else {
        $recommendation = "Based on your preferences, we recommend Dorm C.";
    }

    // Display the recommendation
    $resultHTML = "<p><strong>Recommendation:</strong> $recommendation</p>";
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Student Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inconsolata">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



        <link rel="stylesheet" href="styles.css">

        <style>
            a {
                text-decoration: none;
            }
            h2{
                text-align: center;
            }
             body{
                    background-image: url("images/Dorm.jpg");
                    background-attachment: fixed;
                
                }
        </style>

    </head>

    <body>
        
        <!-- Navbar -->
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
        <header class="bgimg w3-display-container w3-grayscale-min" id="home">

            <!-- Page Container -->
            <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">    
                <!-- The Grid -->
                <div class="w3-row">
                    <!-- Left Column -->
                    <div class="w3-col m3">
                        <!-- Profile -->
                        <div class="w3-card w3-round w3-white">
                            <div class="w3-container">
                                <h4 class="w3-center"><?php echo $row["fname"] . ' ' . $row["lname"]; ?></h4>
                                <p class="w3-center"><img src="images/women.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p>
                                <hr>
                                <!--After building a proper database, we can have it echoed through php-->
                                <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i> Junior, Computer Science</p>
                                <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> Moscow, Idaho</p>
                                <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i> 15 March, 2003</p>
                            </div>
                        </div>
                        <br>

                        <!-- Accordion -->
                        <div class="w3-card w3-round">
                            <div class="w3-white">
                                <button onclick="myFunction('Demo1')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-circle-o-notch fa-fw w3-margin-right"></i> Saved Properties</button>
                                <div id="Demo1" class="w3-hide w3-container">
                                    <button class="w3-button w3-block w3-theme-l4">Hill Rentals</button>
                                    <button class="w3-button w3-block w3-theme-l4">Hill Rentals</button>
                                    <button class="w3-button w3-block w3-theme-l4">Hill Rentals</button>
                                </div>
                                <button onclick="myFunction('Demo2')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-calendar-check-o fa-fw w3-margin-right"></i> Pending Applications</button>
                                <div id="Demo2" class="w3-hide w3-container">
                                    <button class="w3-button w3-block w3-theme-l4">Palouse</button>
                                    <button class="w3-button w3-block w3-theme-l4">Palouse</button>
                                    <button class="w3-button w3-block w3-theme-l4">Palouse</button>
                                </div>
                                <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i class="fa fa-users fa-fw w3-margin-right"></i> New Listings</button>
                                <div id="Demo3" class="w3-hide w3-container">
                                    <button class="w3-button w3-block w3-theme-l4">Grove</button>
                                    <button class="w3-button w3-block w3-theme-l4">Grove</button>
                                    <button class="w3-button w3-block w3-theme-l4">Grove</button>
                                </div>
                            </div>      
                        </div>
                        <br>

                        <!-- Interests --> 
                        <div class="w3-card w3-round w3-white w3-hide-small">
                            <div class="w3-container">
                                <p>Interests</p>
                                <p>
                                    <!--After building a proper database, we can have it echoed through php-->  
                                    <span class="w3-tag w3-small w3-theme-d5">Music</span>
                                    <span class="w3-tag w3-small w3-theme-d2">Games</span>
                                    <span class="w3-tag w3-small w3-theme-d1">Friends</span>
                                    <span class="w3-tag w3-small w3-theme-l2">Food</span>
                                    <span class="w3-tag w3-small w3-theme-l5">Photos</span>
                                    <span class="w3-tag w3-small w3-theme-l4">Volleyball</span>
                                    <span class="w3-tag w3-small w3-theme-l4">Travel</span>
                                    <span class="w3-tag w3-small w3-theme-l4">Dogs</span>
                                </p>
                            </div>
                        </div>
                        <br>

                        <!-- Alert Box -->
                        <div class="w3-card w3-round w3-white w3-hide-small w3-container">
                            <span onclick="this.parentElement.style.display = 'none'" class="w3-button w3-theme-l3 w3-display-topright">
                                <i class="fa fa-remove"></i>
                            </span>
                            <p><strong>BIO</strong></p>
                            <p>You can add a short bio about yourself for the rental properties to see.</p>
                        </div>

                        <!-- End Left Column -->
                    </div>

                    <!-- Middle Column -->
                    <div class="w3-col m7">

                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding">
                                        <h6 class="w3-opacity">
                                            <strong>Welcome to your Dashboard !</strong>
                                            <br> 
                                            Hope you have some matches today so you can find your perfect apartment.
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>

                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding">
                                        <h1 class="w3-opacity w3-center">

                                            <button onclick="document.getElementById('id01').style.display = 'block'"
                                                    class="w3-button">Take a quiz!
                                            </button>
                                        </h1> 
                                        <p> Not sure which residence hall you want to stay in?! You can take this quiz and find out 
                                            the best options.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding">
                                        <h2> Matches </h2>
                                        <h4 class="w3-opacity w3-center">
                                            <?php
// Retrieve matched accommodations from the database
// Assume $matches is an array containing matched accommodations (e.g., fetched from a SQL query)
$matches = [
    ['pid' => 1, 'Location' => 'ABC Street', 'Bedrooms' => 1, 'Wifi' => 'Yes', 'Electric' => 'Yes', 'Laundry' => 'Shared', 'MoveinDate' => '2024-06-01'],
    ['pid' => 2, 'Location' => 'XYZ Avenue', 'Bedrooms' => 1, 'Wifi' => 'Yes', 'Electric' => 'No', 'Laundry' => 'Private', 'MoveinDate' => '2024-07-01'],
    // More matched accommodations...
];

// Display matched accommodations
echo "<form action='process_selection.php' method='post'>";
foreach ($matches as $match) {
    echo "<input type='radio' name='accommodation' value='{$match['pid']}'>";
    echo "{$match['Location']} - {$match['Bedrooms']} Bedroom(s) - Wifi: {$match['Wifi']} - Electric: {$match['Electric']} - Laundry: {$match['Laundry']} - Move-in Date: {$match['MoveinDate']}<br>";
}
echo "<input type='submit' value='Select Accommodation'>";
echo "</form>";
?>
                                        </h4> 
                                        <p>
<!--                                            
                                            $mysqli = new mysqli("localhost", "root", "", "Housing_demo1");
                                            mysqli_query($mysqli ,"SET @i_d='".$id."'");
                                            mysqli_multi_query ($mysqli, "CALL budget (@i_d)") OR DIE (mysqli_error($mysqli));
                                            
                                           while (mysqli_more_results($mysqli)) {

                                                if ($result2 = mysqli_store_result($mysqli)) {

                                                    while ($row = mysqli_fetch_assoc($result2)) {

                                                        // i.e.: DBTableFieldName="userID"
                                                        echo "row = ".$row["pid"]."<br />";
                                                       
                                                    }
                                                    mysqli_free_result($result2);
                                                }
                                                mysqli_next_result($conn);
                                           }
                                                
                                        </p>
-->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>
                        <div class="w3-row-padding">
                            <div class="w3-col m12">
                                <div class="w3-card w3-round w3-white">
                                    <div class="w3-container w3-padding">
                                        <h1 class="w3-opacity w3-center">
                                            You currently have no roommate matching.
                                        </h1> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Middle Column -->
                    </div>

                    <!-- Right Column -->
                    <div class="w3-col m2">
                        <div class="w3-card w3-round w3-white w3-center">
                            <div class="w3-container">
                                <h5>Most Popular Rental Properties in Moscow:</h5>
                                <button class="w3-button w3-block w3-theme-l4"><a href="https://hillapartments.com/" target="_blank"><strong>
                                            Hill Rental Properties
                                        </strong></a></button>
                                <button class="w3-button w3-block w3-theme-l4"><a href="https://www.palouseproperties.com/" target="_blank">
                                        Palouse Properties Inc
                                        <strong></strong></a></button>
                                <button class="w3-button w3-block w3-theme-l4"><a href="https://groveatmoscow.com/" target="_blank">
                                        Grove @ Moscow
                                        <strong></strong></a></button>
                                <button class="w3-button w3-block w3-theme-l4"><a href="https://www.republiconmain.com/" target="_blank">
                                        The Republic on Main
                                        <strong></strong></a></button>
                                <button class="w3-button w3-block w3-theme-l4"><a href="https://www.theempiremoscow.com/" target="_blank">
                                        The Empire Moscow
                                        <strong></strong></a></button>
                                <button class="w3-button w3-block w3-theme-l4"><a href="https://www.apartmentrentalsinc.com/" target="_blank">
                                        Apartment Rentals Inc
                                        <strong></strong></a></button>
                            </div>
                        </div>
                        <br>

                        <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
                            <button class="w3-button w3-block w3-theme-l4">
                                <a href="https://www.uidaho.edu/student-life/housing/apply/residence-halls" target="_blank">
                                    <strong>Apply for Residence Hall</strong>
                                </a>
                            </button>
                        </div>
                        <br>
                        <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
                            <button class="w3-button w3-block w3-theme-l4">
                                <a href="https://www.uidaho.edu/student-life/housing/apply/apartments" target="_blank">
                                    <strong>Apply for On-Campus <br> Apartment</strong>
                                </a>
                            </button>
                        </div>
                        <br>
                        <div class="w3-card w3-round w3-white w3-padding-16 w3-center">
                            <button class="w3-button w3-block w3-theme-l4">
                                <a href="https://www.uidaho.edu/-/media/uidaho-responsive/files/student-life/housing/residence-halls/housing-viewbook/vandal-living-viewbook.pdf?la=en&rev=52875a57d35a465f8a8814b273c5fb8a" target="_blank">
                                    <strong>Vandal Living View Book</strong>
                                </a>
                            </button>
                        </div>
                        <!--                        
                        <!-- End Right Column -->
                    </div>

                    <!-- End Grid -->
                </div>

                <!-- End Page Container -->
            </div>



            <!-- The Modal -->
            <div id="id01" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('id01').style.display = 'none'"
                              class="w3-button w3-display-topright">&times;</span>
                        <form  method="post" id="quizForm">
                            <h1><strong>Residence Hall Quiz</strong></h1>
                            <p>
                                <label> 
                                    Which year are you in?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="education_progress" name="education_progress" required>
                                <option value="">Select</option>
                                <option value="Freshman">Freshman</option>
                                <option value="Transfer">Transfer</option>
                                <option value="Returning">Returning</option>
                            </select>

                            <p>
                                <label><i class="fa fa-calendar-o"></i> 
                                    What room type do you want?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="room_type" name="room_type" required>
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Double">Double</option>
                                <option value="Suite">Suite</option>
                            </select>         

                            <p>
                                <label><i class="fa fa-male"></i> 
                                    What bathroom type do you want ?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="bathroom_type" name="bathroom_type" required>
                                <option value="">Select</option>
                                <option value="Private">Private</option>
                                <option value="Community">Community</option>
                            </select>

                            <p>
                                <label><i class="fa fa-calendar-o"></i> 
                                    Which gender floor planning do you want?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="floor_type" name="floor_type" required>
                                <option value="">Select</option>
                                <option value="Co-ed">Co-ed</option>
                                <option value="Single_Gender">Single Gender</option>
                                <option value="Gender_Inclusive">Gender Inclusive</option>
                            </select>

                            <p>
                                <label><i class="fa fa-calendar-o"></i> 
                                    Do you prefer a community kitchen?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="kitchen" name="kitchen" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                            <p>
                                <label><i class="fa fa-calendar-o"></i> 
                                    Do you need it to stay open during the summer break?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="open_summer" name="open_summer" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                            <p>
                                <label><i class="fa fa-calendar-o"></i> 
                                    Do you need it to stay open during the winter break?
                                </label>
                            </p>
                            <select class="w3-input w3-border" id="open_winter" name="open_winter" required>
                                <option value="">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select>

                            <p>
                                <button class="w3-button w3-block w3-green w3-left-align" type="submit">
                                    Submit
                                </button>

                            </p>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Display quiz result -->
            <div id="id02" class="w3-modal">
                <div class="w3-modal-content">
                    <div class="w3-container">
                        <span onclick="document.getElementById('id02').style.display = 'none'"
                              class="w3-button w3-display-topright">&times;</span>
                        <!-- Content for the second modal -->
                        <h1>Best on-campus housing options for you</h1>
                        <div>
                            <p style="font-size: 30px;"><strong>Here's the list of the housing option for you:</strong></p>
                            <div id="housing_message" style="color: darkred; font-style: oblique;"></div>
                        </div>
                    </div>
                </div>
            </div>

        </header>
        <!-- Footer -->
        <footer class="w3-container w3-theme-d5">
            <p>&copy; 2024 Housing Site. All rights reserved.</p>
        </footer>

        <script>
            // Accordion
            function myFunction(id) {
                var x = document.getElementById(id);
                if (x.className.indexOf("w3-show") === -1) {
                    x.className += " w3-show";
                    x.previousElementSibling.className += " w3-theme-d1";
                } else {
                    x.className = x.className.replace("w3-show", "");
                    x.previousElementSibling.className =
                            x.previousElementSibling.className.replace(" w3-theme-d1", "");
                }
            }

            // Used to toggle the menu on smaller screens when clicking on the menu button
            function openNav() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") === -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                var quizForm = document.getElementById("quizForm");
                var secondModal = document.getElementById("id02");

                quizForm.addEventListener("submit", function (event) {
                    event.preventDefault(); // Prevent form submission

                    // Code to handle form submission, e.g., AJAX request, validation, etc.

                    // Show the second modal
                    secondModal.style.display = "block";
                });
            });

            //script to print the option based on the year
            document.getElementById("education_progress").addEventListener("change", function () {
                var selectedValue = this.value;
                var messageDiv = document.getElementById("housing_message");

                // Check the selected value and display a message accordingly
                if (selectedValue === "Freshman") {
                    messageDiv.innerHTML = "<strong>Theophilus Tower</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/theophilus' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>Wallace Residence Center</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/wallace' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>Living Learning Communities(LLCs)</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/llc' target='_blank'> Click here to know more!</a><br><br>\n\
                                        " ;
                } else if (selectedValue === "Transfer") {
                    messageDiv.innerHTML = "<strong>Wallace Residence Center</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/wallace' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>McConnell Residence Center</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/mcconnell' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>Living Learning Communities(LLCs)</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/llc' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>North Campus Communities(NCC)</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/north-campus-communities' target='_blank'> Click here to know more!</a><br><br>\n\
                                        " ;
                } else if (selectedValue === "Returning") {
                    messageDiv.innerHTML = "<strong>Wallace Residence Center</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/wallace' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>McConnell Residence Center</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/mcconnell' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>Living Learning Communities(LLCs)</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/llc' target='_blank'> Click here to know more!</a><br><br>\n\
                                            <strong>North Campus Communities(NCC)</strong><br><a href='https://www.uidaho.edu/student-life/housing/explore-options/north-campus-communities' target='_blank'> Click here to know more!</a><br><br>\n\
                                        " ;
                } else {
                    messageDiv.innerHTML = "No options";
                }
            });
        </script>

    </body>
</html> 

