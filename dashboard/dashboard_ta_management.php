<?php
// Start the session
session_start();

$id = $_SESSION["email"];
$input = $_POST['course'];
$string_array = explode("|", $input);
$isProf = false;
$isProf_js = "no";

if (count($string_array) == 1 ) {
  // get the TA info needed to delete from the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $db = "ta-management";
  $conn = new mysqli($servername, $username, $password, $db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $recordID = $string_array[0];
  $result = $conn->query("SELECT * FROM ta_history WHERE RecordID=$recordID");
  $row = mysqli_fetch_assoc($result);
  $term = $row['TermYear'];
  $selected_course = $row['CourseNumber'];
  $conn->close();
} else {
  $selected_course = $string_array[0];
  $term = $string_array[1] . " " . $string_array[2];
  $isProf = true;
  $isProf_js = "yes";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>TA Management</title>
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
    <style type="text/css">
      .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        height:50px;
        background-color: #DC241F;
        color:#DC241F;
        text-align: center;
      }
      .prof {
        display: block;
      }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        jQuery(function($) {
        $('#jquery-select').on('change', function() {
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
            <select class="custom-select" id= "jquery-select">
            
                <option value="1" selected="selected"  >Rate a TA </option>

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
      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <!-- TA performance log - Displayed for a prof only -->
        <a
            class="nav-item nav-link prof"
            data-toggle="tab"
            href="#nav-log"
            role="tab"
            >TA performance log</a
          >
          <!-- All TAs report - Displayed for a prof only -->
          <a
            class="nav-item nav-link prof"
            data-toggle="tab"
            href="#nav-wishlist"
            role="tab"
            >TA wishlist</a
          >
           <!-- Office Hours -->
          <a
            class="nav-item nav-link"
            data-toggle="tab"
            href="#nav-office"
            role="tab"
            >Office Hours</a
          >
          <!-- Channel -->
          <a
            class="nav-item nav-link active"
            data-toggle="tab"
            href="#nav-channel"
            role="tab"
            >Channel</a
          >
          <!-- All TAs Report - Displayed for a prof only -->
          <a
            class="nav-item nav-link prof"
            data-toggle="tab"
            href="#nav-report"
            role="tab"
            >All TAs Report</a
          >
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <br />
        <!-- TA performance log - Displayed for a prof only -->
        <div class="tab-pane fade show active" id="nav-log" role="tabpanel">
        </div>

        <!-- All TAs report - Displayed for a prof only -->
        <div class="tab-pane fade" id="nav-wishlist" role="tabpanel">
        </div>

        <!-- Office Hours -->
        <div class="tab-pane fade" id="nav-office" role="tabpanel">
        </div>
        
        <!-- Channel -->
        <div class="tab-pane fade" id="nav-channel" role="tabpanel">
        </div>
        
        <!-- All TAs Report - Displayed for a prof only -->
        <div class="tab-pane fade" id="nav-report" role="tabpanel">
        </div>
    </div>
    <div class="footer">.</div> 
    <script>
      var isProf = "<?php echo $isProf_js; ?>";
      if (isProf == "no") {
        var classes = document.getElementsByClassName('prof');
        console.log(classes);
        for (var i = 0; i < classes.length; i++) {
          classes[i].style.display = 'none';
        }
      }
    </script>
  </body>
</html>
