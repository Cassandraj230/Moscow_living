<?php
// Check if the accommodation ID is set in the POST request
if (isset($_POST['accommodation'])) {
    // Get the selected accommodation ID from the POST request
    $accommodation_id = $_POST['accommodation'];

    // You may want to perform additional validation on the accommodation ID here

    // Establish a connection to the database
    $mysqli = new mysqli("localhost", "root", "", "housing_demo1");

    // Check connection
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli->connect_error;
        exit();
    }

    // Retrieve the details of the selected accommodation from the database
    $query = "SELECT * FROM offcampushousing WHERE pid = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("i", $accommodation_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the accommodation exists
    if ($result->num_rows > 0) {
        // Fetch the details of the accommodation
        $accommodation = $result->fetch_assoc();

        // Close the database connection
        $mysqli->close();

        // Send an email to the leasing company
        $to = "leasingcompany@example.com";
        $subject = "Student Selected Accommodation";
        $message = "A student has selected your property.\n\nDetails:\n";
        $message .= "Property ID: " . $accommodation['pid'] . "\n";
        // Include other details of the accommodation as needed
        
        // You may want to customize the email message further

        // Send the email
        mail($to, $subject, $message);

        // Redirect the user to a confirmation page
        header("Location: confirmation.php");
        exit();
    } else {
        echo "Accommodation not found.";
        exit();
    }
} else {
    echo "Accommodation ID not set.";
    exit();
}
?>
