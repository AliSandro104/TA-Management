<?php
// Start the session
session_start();

$id = $_SESSION["email"]

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Rate a TA</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
    <link rel="stylesheet" href="dashboard_select.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        jQuery(function($) {
        $("#jquery-select").on('change', function() {
            var url = $(this).val();

            if($(this).val()=="1")
            window.location = "dashboard_student.php" 
            
            if($(this).val()=="2")
            window.location = "dashboard_select_course.php" 

            if($(this).val()=="3")
            window.location = "dashboard_select_course.php" 

            if($(this).val()=="4")
            window.location = "dashboard_admin.php" 

            if($(this).val()=="5")
            window.location = "dashboard_sysop.php" 
            });
        });
      </script>

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
    <div class="container">
      <nav class="navbar">
        <!-- Header -->
        <div class="container-fluid">
          <!-- Logo and User Role  -->
          <div class="d-flex align-items-center">
            <img
              src="../media/mcgill_logo.png"
              style="width: 14rem; height: auto"
              alt="mcgill-logo"
            />
            <select class="custom-select" id = "jquery-select">
                
                <option value="1" selected="selected"  >Select a TA</option>

                <?php

                    $conn = mysqli_connect("localhost","root","","ta-management");

                    if ($conn -> connect_error){
                    die ("Connection failed: " . $conn->connect_error);
                    }

                
                    $query = "SELECT MAX(userTypeId) FROM user_usertype WHERE userId = '$id'";
                    $query_run = mysqli_query($conn, $query);
              
              
                    if(mysqli_num_rows($query_run) > 0)
                    {
              
                      //while ($row = mysqli_fetch_array($result)){
                        while ($row = $query_run->fetch_assoc()){
                          
                          
                          if ($row['MAX(userTypeId)'] == 5){
                            echo '<option value="2" selected="selected"  >TA management </option>';
                            echo '<option value="4" selected="selected"   >TA administration</option>';
                            echo '<option value="5" selected="selected" >Sysop Tasks</option>';
                          }
              
                          if ($row['MAX(userTypeId)'] == 4){
                            echo '<option value="2" selected="selected" >TA management </option>';
                            echo '<option value="4" selected="selected" >TA administration</option>';
                          }
                          
                          if ($row['MAX(userTypeId)'] == 3 || $row['MAX(userTypeId)'] ==2) {
                            echo '<option value="2" selected="selected" >TA management </option>';
                
                           }
                    }
                }

                ?>
                <option hidden disabled selected value> -- change page -- </option>
            </select>
          </div>
          <!-- Logout -->
          <div>
            <button
              type="button"
              class="btn btn-link"
              onclick="window.location.replace('../logout/logout.html')"
            >
              <i class="fa fa-sign-out" style="font-size: 24px"></i>
            </button>
          </div>
        </div>
      </nav>
      
      <br><br>
      
      <div class="form-container" id="form1">
        <form action="" method="post">
          <h1> Select Course </h1>

          <br><br>

          <!-- Select Course -->
                  
          <label for ="course"><h5>Select the course you would like to see</h5></label><br>
              
            <select name="course">
              <?php
                $conn = mysqli_connect("localhost","root","","ta-management");

                if ($conn -> connect_error){
                die ("Connection failed: " . $conn->connect_error);
                }
            
                $query = "SELECT userTypeId FROM user_usertype WHERE userId = '$id'";
                $query_run = mysqli_query($conn, $query);
          
                if(mysqli_num_rows($query_run) > 0)
                {
          
                    while ($row = $query_run->fetch_assoc()){
          
                      if ($row['userTypeId'] == 2){
                        $query1 = "SELECT * FROM ta_history WHERE TAEmail = '$id'";
                        $query_run1 = mysqli_query($conn, $query1);
          
                        if(mysqli_num_rows($query_run1) > 0) { 
                          while ($row1 = $query_run1->fetch_assoc()) { ?>
                            <option value="<?php echo $row1['RecordID']; ?>">
                            <?php echo $row1['CourseNumber'] . " - " . $row1['TermYear'] . " as TA"; ?>
                            </option>
                        <?php }
                        }
                      }
                      else if ($row['userTypeId'] == 3 ) {
                        $query2 = "SELECT * FROM course WHERE courseInstructor = '$id'";
                        $query_run2 = mysqli_query($conn, $query2);
          
                        if(mysqli_num_rows($query_run2) > 0) { 
                          while ($row2 = $query_run2->fetch_assoc()) { ?>
                            <option value="<?php echo $row2['courseNumber'] . "|" . $row2['term']; ?>">
                            <?php echo $row2['courseNumber'] . " - " . $row2['term'] . " " . $row2['year'] . " as Prof"; ?>
                            </option>
                        <?php }
                        }
                      }
                }
            }
            ?>
            <option hidden disabled selected value = "N/A"> -- Course options -- </option>
            </select>

            </div>
            <br><br>

            <button type="submit" class ="confirm-btn" id="confirm-btn" name="confirm" >Confirm selection</button> <br><br>

                        

        </form>
      </div>
      

        <div class="footer">.</div> 

  </body>

</html>