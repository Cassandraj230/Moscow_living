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
        <title>New Listing</title>
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
        
        

            <h2>Create New Listing</h2>
            <form action="/action_page.php">   
                <div class ="row">           
    <div class="form-group">
    <label for="exampleFormControlSelect1">Bathrooms</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>          
    <div class="form-group">
    <label for="exampleFormControlSelect1">Bedrooms</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
  </div>  
                    <div class="form-group">
    <label for="exampleFormControlSelect1">Gender</label>
    <select class="form-control" id="exampleFormControlSelect1">
      <option>Female</option>
      <option>Male</option>
      <option>Unisex</option>
   
    </select>
  </div>  
                </div>
       <input type="text" class="form-control" placeholder="Address">    
       <input type="text" class="form-control" placeholder="Price">   
   Utilities Included
   <div class="row">
       <div class="col">
   <div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
  <label class="form-check-label" for="inlineCheckbox1">Water</label>
</div>
       </div>
          <div class="col">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
  <label class="form-check-label" for="inlineCheckbox2">Sewer</label>
</div>
          </div>
          <div class="col">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3">
  <label class="form-check-label" for="inlineCheckbox3">Gas</label>
</div>
          </div>
          <div class="col">
<div class="form-check form-check-inline">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option4">
  <label class="form-check-label" for="inlineCheckbox3">Electric</label>
</div>
          </div>
          <div class="col">
   <div class="form-check">
  <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option5">
  <label class="form-check-label" for="inlineCheckbox3">Wifi</label>
</div>
          </div></div>
           <div class="mb-3">
  <label for="formFile" class="form-label"></label>
  <input class="form-control" type="file" id="formFile">
</div>
                <button type="submit" class="btn btn-primary">Submit</button>
</form>   
      
      
      
      
    </body>
   
</html>
