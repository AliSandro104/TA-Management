<!DOCTYPE html>
<html>
  <head>
    <title>Admin Page</title>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <style type="text/css">
    .import-button {
        margin-top: 20px;
    }

    .accordion {
      background-color: #eee;
      color: #444;
      cursor: pointer;
      padding: 18px;
      width: 100%;
      border: none;
      text-align: left;
      outline: none;
      font-size: 15px;
      transition: 0.4s;
    }

    .active2, .accordion:hover {
      background-color: #ccc; 
    }

    .panel {
      padding: 0 18px;
      display: none;
      background-color: white;
      overflow: hidden;
    }
  </style>

  <body>
    <script src="./admin.js"></script>
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
            <select class="custom-select">
              <option value="admin" selected="selected">admin</option>
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
          <a
            class="nav-item nav-link active"
            data-toggle="tab"
            href="#nav-tas"
            role="tab"
            >TA Info/History</a
          >
          <a
            class="nav-item nav-link"
            data-toggle="tab"
            href="#nav-courses"
            role="tab"
            >Courses</a
          >
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-tas" role="tabpanel">
            <!-- Import TA cohort -->
          <button
          type="button"
          class="btn btn-outline-secondary import-button"
          data-toggle="modal"
          data-target="#import-ta"
        >
          <i class="fa fa-download"></i>
          Import TA Cohort
        </button>
        <div class="modal fade" id="import-ta" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form
                id="upload-user-form"
                action="import_ta_cohort.php"
                method="post"
                enctype = "multipart/form-data"
              >
                <div class="modal-header">
                  <h3 class="modal-title">Import TA Cohort</h3>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <i class="fa fa-close"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="file" name="myfile"/>
                </div>
                <div class="modal-footer">
                  <input
                    type="button"
                    class="btn btn-light"
                    data-dismiss="modal"
                    value="Cancel"
                  />
                  <input type="submit" class="btn btn-light" />
                </div>
              </form>
            </div>
          </div>
        </div>
          <h1 style="margin-top: 20px;">List of TA with their info</h1>
          <?php
            // Create connection
            $conn = new mysqli("localhost", "root", "", "ta-management");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $result = $conn -> query("SELECT * FROM ta_cohort");
              while($row = mysqli_fetch_array($result)) {
          ?>
            <button class="accordion"><?php echo $row['TAName']?></button>
            <div class="panel" style="margin-top: 20px;">
              <p><b>Semester of application: </b><?php echo $row['TermYear']?></p>
              <p><b>Legal name: </b><?php echo $row['LegalName']?></p>
              <p><b>Student ID: </b><?php echo $row['StudentID']?></p>
              <p><b>Email: </b><?php echo $row['Email']?></p>
              <p><b>Grad/Ugrad: </b><?php echo $row['GradUgrad']?></p>
              <p><b>Supervisor Name: </b><?php echo $row['SupervisorName']?></p>
              <p><b>Priority: </b><?php echo $row['Priority']?></p>
              <p><b>Number of hours: </b><?php echo $row['NumberHours']?></p>
              <p><b>Date Applied: </b><?php echo $row['DateApplied']?></p>
              <p><b>Location: </b><?php echo $row['TheLocation']?></p>
              <p><b>Phone: </b><?php echo $row['Phone']?></p>
              <p><b>Degree: </b><?php echo $row['Degree']?></p>
              <p><b>Courses Applied To: </b><?php echo $row['CoursesApplied']?></p>
              <p><b>Open to other courses: </b><?php echo $row['OpenToOtherCourses']?></p>
              <p><b>Notes: </b><?php echo $row['Notes']?></p>
            </div>
          <?php
            }
          ?>
        </div>
        <div class="tab-pane fade" id="nav-courses" role="tabpanel">
            <button
          type="button"
          class="btn btn-outline-secondary import-button"
          data-toggle="modal"
          data-target="#import-quota"
        >
          <i class="fa fa-download"></i>
          Import Courses Quota
        </button>
        <div class="modal fade" id="import-quota" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form
                id="upload-user-form"
                action="import_course_quota.php"
                method="post"
                enctype = "multipart/form-data"
              >
                <div class="modal-header">
                  <h3 class="modal-title">Import Courses Quota</h3>
                  <button
                    type="button"
                    class="close"
                    data-dismiss="modal"
                    aria-label="Close"
                  >
                    <i class="fa fa-close"></i>
                  </button>
                </div>
                <div class="modal-body">
                  <input type="file" name="myfile"/>
                </div>
                <div class="modal-footer">
                  <input
                    type="button"
                    class="btn btn-light"
                    data-dismiss="modal"
                    value="Cancel"
                  />
                  <input type="submit" class="btn btn-light" />
                </div>
              </form>
            </div>
          </div>
        </div>
            <h1 style="margin-top: 20px;">List of courses</h1>
            <?php
                // Create connection
                $conn = new mysqli("localhost", "root", "", "ta-management");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $result = $conn -> query("SELECT * FROM courses_quota");
                while($row = mysqli_fetch_array($result)) {
            ?>
                <button class="accordion"><?php echo $row['CourseNumber']?></button>
                <div class="panel" style="margin-top: 20px;">
                <p><b>Term Year: </b><?php echo $row['TermYear']?></p>
                <p><b>Course Name: </b><?php echo $row['CourseName']?></p>
                <p><b>Course Type: </b><?php echo $row['CourseType']?></p>
                <p><b>Instructor Name: </b><?php echo $row['InstructorName']?></p>
                <p><b>Enrollment Number: </b><b style="font-weight: normal;" class="enrollment-number"><?php echo $row['EnrollmentNumber']?></b></p>
                <p><b>TA Quota: </b><b style="font-weight: normal;" class="ta-quota"><?php echo $row['TAQuota']?></b></p>
                </div>
            <?php
                }
            ?>
        </div>
      </div>
    </div>
    <script>
      function loadExistingData() {
        getProfAccounts();
        getCourses();
        getAccounts();
      }
      document.onload = loadExistingData();
    </script>
    <script src="./admin.js"></script>
  </body>
</html>