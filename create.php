<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$Location = $Price = $Bedrooms = $Bathrooms = $Wifi = $Electric = $Laundry = $MoveinDate = "";
$Location_err = $Price_err = $Bedrooms_err = $Bathrooms_err = $Wifi_err = $Electric_err = $Laundry_err = $MoveinDate_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_location = trim($_POST["Location"]);
    $Location = $input_location;
    $input_price = trim($_POST["Price"]);
    $Price = $input_price;
    $input_bedrooms = trim($_POST["Bedrooms"]);
    $Bedrooms = $input_bedrooms;
        $input_Bathrooms = trim($_POST["Bathrooms"]);
    $Bathrooms = $input_Bathrooms;
        $input_Wifi = trim($_POST["Wifi"]);
    $Wifi = $input_Wifi;
        $input_Electric = trim($_POST["Electric"]);
    $Electric = $input_Electric;
        $input_Laundry = trim($_POST["Laundry"]);
    $Laundry = $input_Laundry;
        $input_MoveinDate = trim($_POST["MoveinDate"]);
    $MoveinDate = $input_MoveinDate;
  
    // Check input errors before inserting in database
    if(empty($Location_err) && empty($Price_err) && empty($Bathrooms_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO offcampushousing (id, pid, Price, Location, Bedrooms,Bathrooms, Wifi, Electric, Laundry, MoveinDate) VALUES (7,6,?,?,?,?,?,?,?,?)
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, $param_name, $param_address, $param_salary);
            
            // Set parameters
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: leaserdashboard.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Listing</h2>
                    <p>Please fill this form and submit to add a property record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Location</label>
                            <input type="text" name="Location" class="form-control <?php echo (!empty($Location_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Location; ?>">
                            <span class="invalid-feedback"><?php echo $Location_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <textarea name="Price" class="form-control <?php echo (!empty($Price_err)) ? 'is-invalid' : ''; ?>"><?php echo $Price; ?></textarea>
                            <span class="invalid-feedback"><?php echo $Price_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Bedrooms</label>
                            <input type="text" name="Bedrooms" class="form-control <?php echo (!empty($Bedrooms_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Bedrooms; ?>">
                            <span class="invalid-feedback"><?php echo $Bedrooms_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Bathrooms</label>
                            <input type="text" name="Bathrooms" class="form-control <?php echo (!empty($Bathrooms_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Bathrooms; ?>">
                            <span class="invalid-feedback"><?php echo $Bathrooms_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Wifi</label>
                            <input type="text" name="wifi" class="form-control <?php echo (!empty($Wifi_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Wifi; ?>">
                            <span class="invalid-feedback"><?php echo $Wifi_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Electric</label>
                            <input type="text" name="electric" class="form-control <?php echo (!empty($Electric_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Electric; ?>">
                            <span class="invalid-feedback"><?php echo $Electric_err;?></span>
                        </div>
                            <div class="form-group">
                            <label>Laundry</label>
                            <input type="text" name="laundry" class="form-control <?php echo (!empty($Laundry_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $Laundry; ?>">
                            <span class="invalid-feedback"><?php echo $Laundry_err;?></span>
                        </div>
                            <div class="form-group">
                            <label>Move In Date</label>
                            <input type="text" name="date" class="form-control <?php echo (!empty($MoveinDate_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $MoveinDate; ?>">
                            <span class="invalid-feedback"><?php echo $MoveinDate_err_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>