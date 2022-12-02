<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../media/favicon.ico" type="image/ico">
    <link rel="stylesheet" href="register.css">

    <title>Register Page</title>

    </style>

    <script type="text/javascript" src="./register.js"></script>


</head>


<body style="background-color:#eee;">


    <div class="header-background">
        <div class = "logo"> </div>
    </div>
    


    <div class="form-container" id="form1">

        <form action="" method="post">
           <h3>register here</h3>

           
           <?php
           //print corresponding error message from register_submit.php
            
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                }
            }
            ?>

           <input type="text" name="fname" required placeholder="first name">

           <input type="text" name="lname" required placeholder="last name">

           <input type="email" name="email" required placeholder="email (you@example.com)" multiple>

           <input type="password" name="password" required placeholder="password"> 

           <input type="password" name="cpassword" required placeholder="confirm password">

           <input type="text" name="sID" id = "sID" placeholder="student ID (999999999)" pattern="[0-9]{9}" maxlength="9" style ="display: none"> 

            <br>
            <br>
            
            <!--  ############ START student section ############ -->

            <div style = "text-align:left"> 
            <h2> Select at least ONE user type:</h2>

            <h4><input
               type="checkbox"
               name="BoxSelect[]"
               value="isStudent"
               id= "isStudent"
               onclick="displayStudentID(), displayStudentCourses()"/>
            
            <label for="isStudent">Student</label></h4>
            
            <div class="multiselect" id="Student_courses" style="display:none">
                <div class="selectBox" onclick="showStudentCheckboxes()" >
                    <select>
                        <option>Select an option</option>
                    </select>
                    <div class="overSelect"></div>
                </div>

                <div id="Student_checkboxes">
                <?php
                    $con = mysqli_connect("localhost","root","","ta-management");

                    #distinct to avoid duplicates terms and year combinations
                    $query = "SELECT DISTINCT courseNumber,term,year FROM course";
                    $result = mysqli_query($con, $query);

                    

                    if(mysqli_num_rows($result) > 0){
                        foreach($result as $r){
                            $courseNum = $r['courseNumber'];
                            $term = $r['term'];
                            $year = $r['year'];
                                ?>
                                <input type="checkbox" name="studentCourses[]" value="<?= $courseNum . ' ' . $term . ' ' . $year ; ?>" /> 
                                <?= $courseNum . ' ' . $term . ' ' . $year ; ?> <br/>
                                <?php
                        }
                    }
                    else
                    {
                    echo "No Record Found";
                    }
                ?>

                </div>
            </div>

            <!--  ############ END student section ############ -->

            <!--  ############ START professor section ############ -->
            <h4><input
            type="checkbox"
            name="BoxSelect[]"
            value="isProf"
            id= "isProf"
            onclick="displayProfCourses()"/>

            <label for="isProf">Professor</label></h4>
            
            
            <!--  ############ END professor section ############ -->

            <!--  ############ START TA section ############ -->
            <h4><input
            type="checkbox"
            name="BoxSelect[]"
            value="isTA"
            id= "isTA"
            onclick="displayTaCourses()"/>

            <label for="isTA">Teacher Assistant</label></h4>
            

            <div class="multiselect" id="Ta_courses" style="display:none">
                <div class="selectBox" onclick="showTaCheckboxes()" >
                    <select>
                        <option>Select an option</option>
                    </select>
                    <div class="overSelect"></div>
                </div>

                <div id="Ta_checkboxes">
                <?php
                    $con = mysqli_connect("localhost","root","","ta-management");

                    #distinct to avoid duplicates terms and year combinations
                    $query = "SELECT DISTINCT courseNumber,term,year FROM course";
                    $result = mysqli_query($con, $query);

                    

                    if(mysqli_num_rows($result) > 0){
                        foreach($result as $r){
                            $courseNum = $r['courseNumber'];
                            $term = $r['term'];
                            $year = $r['year'];
                                ?>
                                <input type="checkbox" name="taCourses[]" value="<?= $courseNum . ' ' . $term . ' ' . $year ; ?>" /> 
                                <?= $courseNum . ' ' . $term . ' ' . $year ; ?> <br/>
                                <?php
                        }
                    }
                    else
                    {
                    echo "No Record Found";
                    }
                ?>

                </div>
            </div>

            <!--  ############ END TA section ############ -->

            <!--  ############ START TA admin section ############ -->

            <h4><input
            type="checkbox"
            name="BoxSelect[]"
            value="isAdmin"/>
            <label for="isAdmin">TA Administrator</label></h4><br>

            <!--  ############ END TA admin section ############ -->

                <div style="text-align:center">
                    <input type="submit" name="submit" value="register now" class="form-btn">
                    <p>already have an account? <a href="../login/login.html">login now</a></p>
                </div>
        </form>
    
    </div>
     
    <div class="footer">.</div> 
    


</body>
</html>


