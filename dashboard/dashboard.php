<?php
// Start the session
session_start();

$id = $_SESSION["email"]

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Main Page</title>
    <link href="dashboard.css" rel="stylesheet" />
    <link rel="icon" href="../media/favicon.ico" type="image/ico">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
      integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

  </head>

  <body>


    <script src="./manage_users.js"></script>
    <script src="./manage_courses.js"></script>
    <script src="./manage_profs.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.3.1.js"
      integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
      integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
      crossorigin="anonymous"
    ></script>

    <div>
    <div style="text-align:right; width:100%; font-size:20px">
      <nav >
          <!-- Logout -->
          <div>
            <button
              type="button"
              class="btn btn-link"
              onclick="window.location.replace('../logout/logout.html')"
              > <div style= "font-size:20px">logout</div>
              <i class="fa fa-sign-out" style="font-size: 32px"></i>
            </button>
          </div>
        </div>
      </nav>


      <div class="container">
        
            <!-- Header -->
            <div class="container-fluid">
            <!-- Logo and User Role  -->
            <div style="text-align:center">
                <img
                src="../media/mcgill_logo.png"
                style="width: 40rem; height: auto"
                alt="mcgill-logo"/>
            </div>
            </div>
    
    </div>

    <div style = "text-align:center">
      <?php
      $conn = mysqli_connect("localhost","root","","ta-management");

      if ($conn -> connect_error){
        die ("Connection failed: " . $conn->connect_error);
      }
      $query = "SELECT firstName FROM user WHERE email = '$id'";
      $name = mysqli_query($conn, $query);

      

      while ($row = $name->fetch_assoc()) {
        echo "<h1>Welcome ".$row['firstName']."</h1><br>";
      }

      ?>

      <select >

      <option hidden disabled selected value> -- select an option -- </option>
      <?php

      
      $query = "SELECT userTypeId FROM user_usertype WHERE userId = '$id'";
      $query_run = mysqli_query($conn, $query);

  

      if(mysqli_num_rows($query_run) > 0)
      {
        $idx = 1;
        //while ($row = mysqli_fetch_array($result)){
          foreach($query_run as $type){
            
            if ($idx == 1) {
              echo '<option value="userType" selected="selected" id = "userType" >Student</option>';
                  }
            if ($idx == 2){
              echo '<option value="userType" selected="selected" id = "userType" >Professor</option>';
                  }
            if ($idx == 3){
              echo '<option value="userType" selected="selected" id = "userType" >Teacher Assistant</option>';
                  }
            if ($idx == 4){
              echo '<option value="userType" selected="selected" id = "userType" >TA admin</option>';
                  }
            if ($idx == 5){
              echo '<option value="userType" selected="selected" id = "userType" >Sysop</option>';
            }

            $idx = $idx+1;

          }
        }
      ?>
      <option hidden disabled selected value> -- select an option -- </option>
      </select>
    </div>
      

</body>
</html>
