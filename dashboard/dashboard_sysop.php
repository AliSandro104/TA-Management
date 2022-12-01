<?php
// Start the session
session_start();

$id = $_SESSION["email"]

?>

<!DOCTYPE html>
<html>
  <head>
    <title>XAMPP-Starter</title>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        jQuery(function($) {
        $('select').on('change', function() {
            var url = $(this).val();

            if($(this).val()=="1")
            window.location = "dashboard_student.php" 
            
            if($(this).val()=="2")
            window.location = "dashboard_ta_manage.php" 

            if($(this).val()=="3")
            window.location = "dashboard_ta_manage.php" 

            if($(this).val()=="4")
            window.location = "dashboard_admin.php" 

            if($(this).val()=="5")
            window.location = "dashboard_sysop.php" 
            });
        });
    </script>


  </head>


  <?php
  /* 
session_start();


if (array_key_exists("email", $_SESSION)) {
    $servername = "localhost"; // Change accordingly
    $username = "root"; // Change accordingly
    $password = ""; // Change accordingly
    $db = "users"; // Change accordingly

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);
    $sql = $conn->prepare("SELECT * FROM User WHERE email = ?");
    $sql->bind_param('s', $_SESSION['email']);
    $sql->execute();
    $result = $sql->get_result();
    $user = $result->fetch_assoc();

    $sql = $conn->prepare("SELECT UserType.userType FROM UserType INNER JOIN User_UserType 
            ON UserType.idx=User_UserType.userTypeId WHERE User_UserType.userId = ?");
    $sql->bind_param('s', $_SESSION['email']);
    $sql->execute();
    $result = $sql->get_result();
    $userTypes = $result->fetch_all();
    $conn->close();

    $username = $user[0] . ' ' . $user[1];
    echo "$username"

    echo '<div class="welcomeMessage">
                Welcome '. $user['firstName'] . '!</div>';
    if (in_array("sysop", $userTypes[0])) {
        echo '<div class = "section">
            <div class="title">
                <i class="fa fa-cog" aria-hidden="true" style="color: rgb(167, 37, 48)"></i>
                System operator
            </div>
            <ul>
                <li>
                    Manage user accounts
                </li>
                <li>
                    Add or remove professors or courses
                </li>
                <li>
                    Manage system manually or using a CSV file
                </li>
            </ul>
            
            <a class="option" onclick="menuItemSelected(\'system\')" href="../sysop_tasks/manage_users.html">
                Manage users
            </a>
            <a class="option" onclick="menuItemSelected(\'system\')" href="../sysop_tasks/importProf.html">
                Quick import prof/course
            </a>
        </div>';
    }
} else {
    echo '<div class="welcomeMessage">
                Logging out..
            </div>';
}
*/
?>

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
            <select class="custom-select">
                <option hidden disabled selected value> -- select an option -- </option>
                <option value="1" selected="selected"  >Student</option>

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
                            echo '<option value="5" selected="selected" >Sysop</option>';
                            break;
                          }
              
                          if ($row['MAX(userTypeId)'] == 4){
                            echo '<option value="2" selected="selected" >TA management </option>';
                            echo '<option value="4" selected="selected" >TA administration</option>';
                            break;}
                          
                          if ($row['MAX(userTypeId)'] == 3 || $row['MAX(userTypeId)'] ==2) {
                            echo '<option value="2" selected="selected" >TA management </option>';
                
                            break;

                    }
                    }
                }

                ?>
                <option hidden disabled selected value> -- select an option -- </option>
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
            href="#nav-profs"
            role="tab"
            >Professors</a
          >
          <a
            class="nav-item nav-link"
            data-toggle="tab"
            href="#nav-courses"
            role="tab"
            >Courses</a
          >
          <a
            class="nav-item nav-link"
            data-toggle="tab"
            href="#nav-users"
            role="tab"
            >Users</a
          >
        </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <br />
        <!-- Professors -->
        <div class="tab-pane fade show active" id="nav-profs" role="tabpanel">
          <div>
            <!-- Import Professors -->
            <button
              type="button"
              class="btn btn-outline-secondary"
              data-toggle="modal"
              data-target="#import-profs"
            >
              <i class="fa fa-download"></i>
              Import
            </button>
            <div
              class="modal fade"
              id="import-profs"
              tabindex="-1"
              role="dialog"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form
                    id="upload-prof-form"
                    action="javascript:saveMultipleProfAccounts()"
                    method="post"
                  >
                    <div class="modal-header">
                      <h3 class="modal-title">Import Professors</h3>
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
                      <input id="prof-upload-csv" type="file" />
                    </div>
                    <div class="modal-footer">
                      <input
                        type="button"
                        class="btn btn-light"
                        data-dismiss="modal"
                        value="Cancel"
                      />
                      <input type="submit" class="btn btn-light" value="Save" />
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Add Professors -->
            <br />
            <br />
            <div class="container d-flex flex-row">
              <div class="row">
                <div class="col-auto mr-auto">
                  <h2 id="title">All Professors</h2>
                </div>
              </div>
              <div class="col-auto align-self-center">
                <button
                  type="button"
                  class="btn btn-light"
                  data-toggle="modal"
                  data-target="#add-new-prof"
                >
                  <i class="fa fa-plus" style="font-size: 24px"></i>
                </button>
                <div
                  class="modal fade"
                  id="add-new-prof"
                  tabindex="-1"
                  role="dialog"
                >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form
                        id="add-profs-form"
                        action="javascript:saveProfAccount()"
                        method="post"
                      >
                        <div class="modal-header">
                          <h3 class="modal-title">Add a Professor</h3>
                          <button
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                          >
                            <i class="fa fa-close"></i>
                          </button>
                        </div>

                        <div class="modal-body">
                          <div id="prof-form-modal">
                            <input
                              class="form-control"
                              placeholder="Instructor Email"
                              type="text"
                              name="inst-email"
                            /><br />
                            <select class="form-control" name="faculty">
                              <option value="" selected disabled>
                                Select a Faculty...
                              </option>
                              <option value="Science">Science</option>
                              <option value="Engineering">Engineering</option>
                              <option value="Arts">Arts</option></select
                            ><br />
                            <select class="form-control" name="dept">
                              <option value="" selected disabled>
                                Select a Department...
                              </option>
                              <option value="Computer Science">
                                Computer Science
                              </option>
                              <option value="Mathematics">Mathematics</option>
                              <option value="Physics">Physics</option></select
                            ><br />
                            <input
                              class="form-control"
                              placeholder="Course Number"
                              type="text"
                              name="crn-num"
                            /><br />
                            <div id="prof-error-msg-cont"></div>
                          </div>
                        </div>

                        <div class="modal-footer">
                          <input
                            type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                            value="Cancel"
                          />
                          <input
                            type="submit"
                            class="btn btn-light"
                            data-dismiss="modal"
                            value="Save"
                          />
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br />

            <!-- Display Professors -->
            <div id="profs-table"></div>
          </div>
        </div>

        <!-- Courses -->
        <div class="tab-pane fade" id="nav-courses" role="tabpanel">
          <div>
            <!-- Import Courses -->
            <button
              type="button"
              class="btn btn-outline-secondary"
              data-toggle="modal"
              data-target="#import-courses"
            >
              <i class="fa fa-download"></i>
              Import
            </button>
            <div
              class="modal fade"
              id="import-courses"
              tabindex="-1"
              role="dialog"
            >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form
                    id="upload-course-form"
                    action="javascript:saveMultipleCourses()"
                    method="post"
                  >
                    <div class="modal-header">
                      <h3 class="modal-title">Import Courses</h3>
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
                      <input id="course-upload-csv" type="file" />
                    </div>
                    <div class="modal-footer">
                      <input
                        type="button"
                        class="btn btn-light"
                        data-dismiss="modal"
                        value="Cancel"
                      />
                      <input
                        type="submit"
                        class="btn btn-light"
                        data-dismiss="modal"
                        value="Save"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Add Courses -->
            <br />
            <br />
            <div class="container d-flex flex-row">
              <div class="row">
                <div class="col-auto mr-auto">
                  <h2 id="title">All Courses</h2>
                </div>
              </div>
              <div class="col-auto align-self-center">
                <button
                  type="button"
                  class="btn btn-light"
                  data-toggle="modal"
                  data-target="#add-new-course"
                >
                  <i class="fa fa-plus" style="font-size: 24px"></i>
                </button>
                <div
                  class="modal fade"
                  id="add-new-course"
                  tabindex="-1"
                  role="dialog"
                >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form
                        id="add-course-form"
                        action="javascript:saveCourse()"
                        method="post"
                      >
                        <div class="modal-header">
                          <h3 class="modal-title">Add a Course</h3>
                          <button
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                          >
                            <i class="fa fa-close"></i>
                          </button>
                        </div>

                        <div class="modal-body">
                          <div id="course-form-modal">
                            <input
                              class="form-control"
                              placeholder="Please enter the course number."
                              type="text"
                              name="crn-number"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Please enter the course name."
                              type="text"
                              name="crn-name"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Please enter the course description."
                              type="text"
                              name="crn-dscrpn"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Please enter the course term."
                              type="text"
                              name="crn-term"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Please enter the course year."
                              type="text"
                              name="crn-year"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Please enter the course instructor's email."
                              type="text"
                              name="crn-email"
                            /><br />
                            <div id="course-error-msg-cont"></div>
                          </div>
                        </div>

                        <div class="modal-footer">
                          <input
                            type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                            value="Cancel"
                          />
                          <input
                            type="submit"
                            class="btn btn-light"
                            data-dismiss="modal"
                            value="Save"
                          />
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <br />

            <!-- Display Courses -->
            <div id="course-table"></div>
          </div>
        </div>

        <!-- Users -->
        <div class="tab-pane fade" id="nav-users" role="tabpanel">
          <!-- Import Users -->
          <button
            type="button"
            class="btn btn-outline-secondary"
            data-toggle="modal"
            data-target="#import-users"
          >
            <i class="fa fa-download"></i>
            Import
          </button>
          <div class="modal fade" id="import-users" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <form
                  id="upload-user-form"
                  action="javascript:saveMultipleNewAccounts()"
                  method="post"
                >
                  <div class="modal-header">
                    <h3 class="modal-title">Import Users</h3>
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
                    <input id="user-upload-csv" type="file" />
                  </div>
                  <div class="modal-footer">
                    <input
                      type="button"
                      class="btn btn-light"
                      data-dismiss="modal"
                      value="Cancel"
                    />
                    <input type="submit" class="btn btn-light" value="Save" />
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Add Users -->
          <br />
          <br />
          <div class="container d-flex flex-row">
            <div class="row">
              <div class="col-auto mr-auto">
                <h2 id="title">All Users</h2>
              </div>
              <div class="col-auto align-self-center">
                <!-- Add Users -->
                <button
                  type="button"
                  class="btn btn-light"
                  data-toggle="modal"
                  data-target="#add-new-user"
                >
                  <i class="fa fa-plus" style="font-size: 24px"></i>
                </button>
                <div
                  class="modal fade"
                  id="add-new-user"
                  tabindex="-1"
                  role="dialog"
                >
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form
                        id="add-user-form"
                        action="javascript:saveNewAccount()"
                        method="post"
                      >
                        <div class="modal-header">
                          <h3 class="modal-title">Add a User</h3>
                          <button
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                          >
                            <i class="fa fa-close"></i>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div id="account-info">
                            <input
                              class="form-control"
                              placeholder="Enter the first name of the user"
                              type="text"
                              name="first-name"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Enter the last name of the user"
                              type="text"
                              name="last-name"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="abc@xyz.com"
                              type="email"
                              name="email"
                            /><br />
                            <input
                              class="form-control"
                              placeholder="Enter temporary password"
                              type="password"
                              name="pwd"
                            /><br />
                            <div class="container">
                              <div class="flex-row">
                                <div class="d-flex justify-content-between">
                                  <div>
                                    <input
                                      type="checkbox"
                                      class="form-check-input"
                                      name="student"
                                      value="student"
                                    />
                                    <label
                                      class="form-check-label"
                                      for="student"
                                      >Student</label
                                    >
                                  </div>
                                  <div>
                                    <input
                                      type="checkbox"
                                      name="professor"
                                      value="professor"
                                    />
                                    <label
                                      class="form-check-label"
                                      for="professor"
                                      >Professor</label
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="flex-row">
                                <div class="d-flex justify-content-between">
                                  <div>
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="admin"
                                      value="admin"
                                    />
                                    <label class="form-check-label" for="admin"
                                      >TA Administrator</label
                                    >
                                  </div>
                                  <div>
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="ta"
                                      value="ta"
                                    />
                                    <label class="form-check-label" for="ta"
                                      >Teaching Assistant</label
                                    >
                                  </div>
                                </div>
                              </div>
                              <div class="flex-row">
                                <div class="d-flex justify-content-between">
                                  <div>
                                    <input
                                      class="form-check-input"
                                      type="checkbox"
                                      name="sysop"
                                      value="sysop"
                                    />
                                    <label class="form-check-label" for="sysop"
                                      >System Operator</label
                                    >
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div id="error-msg-cont"></div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <input
                            type="button"
                            class="btn btn-light"
                            data-dismiss="modal"
                            value="Cancel"
                          />
                          <input
                            type="submit"
                            class="btn btn-light"
                            value="Save"
                          />
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br />

          <!-- Display Users -->
          <div id="user-table"></div>
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
  </body>
</html>
