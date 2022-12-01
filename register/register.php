<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../media/favicon.ico" type="image/ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register Page</title>

    <style>
    .container .content .btn:hover{
        background: crimson;
     }
     
     .form-container{
        min-height: 20vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding:20px;
        padding-bottom: 60px;
        background: #eee;
     }
     
     .form-container form{
        padding:20px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0,0,0,.1);
        background: #fff;
        text-align: center;
        width: 500px;
     }
     
     .form-container form h3{
        font-size: 30px;
        text-transform: uppercase;
        margin-bottom: 10px;
        color:#333;
     }

     .form-container form input{
        padding:10px 15px;
        font-size: 17px;
        margin:8px 0;
        background: #eee;
     }
     
     .form-container form .form-btn{
        background: #fbd0d9;
        color:crimson;
        text-transform: capitalize;
        font-size: 20px;
        cursor: pointer;
     }
     
     .form-container form .form-btn:hover{
        background: crimson;
        color:#fff;
     }
     
     .form-container form p{
        margin-top: 10px;
        font-size: 20px;
        color:#333;
     }
     
     .form-container form p a{
        color:crimson;
     }

     .form-container form .error-msg{
        margin:10px 0;
        display: block;
        background: crimson;
        color:#fff;
        border-radius: 5px;
        font-size: 20px;
        padding:10px;
        }

    .logo {
    background: url(../media/mcgill_logo_white.jpg) no-repeat center left;
    width: 180px;
    height: 75px;
    margin: 18px 0 0 20px;
    display: inline-block;
    border-right: 1px solid #fff;
}

    .header-background {
    width: 100%;
    height: 108px;
    background: #DC241F url(../media/mcgill_background.jpg) no-repeat top right;
    padding: 0;
    margin: 0;
    }

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

    </style>


    <script>
        //to check if the student checkbox is checked
        function displayStudentID() {
            // Get the student checkbox
            var checkBox = document.getElementById("isStudent");
            // Get the student ID box field
            var field = document.getElementById("sID");

            // If the checkbox is checked, display the student ID field and make it required
            if (checkBox.checked == true){
                field.style.display = "initial";
                field.required = true;
                field.attr('maxlength','9');
                field.attr('minlength','9');

            } else {
                field.style.display = "none";
                field.required = false;
                field.attr('maxlength','9');
                field.attr('minlength','9');
            }
        }
    </script>

</head>

<body style="background-color:#eee;">


    <div class="header-background">
        <div class = "logo"> </div>
    </div>
    


    <div class="form-container" id="form1">

        <form action="register.php" method="post">
           <h3>register here</h3>

           <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>

           <input type="text" name="fname" required placeholder="first name">

           <input type="text" name="lname" required placeholder="last name">

           <input type="email" name="email" required placeholder="email (example@example.com)" multiple>

           <input type="password" name="password" required placeholder="password"> 

           <input type="password" name="cpassword" required placeholder="confirm password">

           <input type="text" name="sID" id = "sID" placeholder="student ID (999999999)" pattern="[0-9]{4}" maxlength="4" style ="display: none"> 

            <br>
            <br>
            
            <div style = "text-align:left"> 
            <h4> Select at least ONE user type:</h4>
            <input
               type="checkbox"
               name="BoxSelect[]"
               value="isStudent"
               id= "isStudent"
               onclick="displayStudentID()"/>
            <label for="isStudent">Student</label> <br>

            <input
            type="checkbox"
            name="BoxSelect[]"
            value="isProf"/>
            <label for="isProf">Professor</label><br>
      
            <input
            type="checkbox"
            name="BoxSelect[]"
            value="isTA"/>
            <label for="isTA">Teaching Assistant</label><br>

            <input
            type="checkbox"
            name="BoxSelect[]"
            value="isAdmin"/>
            <label for="isAdmin">TA Administrator</label><br><br>


            <h4> Select at least ONE term:</h4>

            
            <?php
            $con = mysqli_connect("localhost","root","","ta-management");

            $query = "SELECT * FROM course";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $courseNum)
                {
                    ?>
                    <input type="checkbox" name="term[]" value="<?= $courseNum['term'] . ' ' . $courseNum['year'] ; ?>" /> 
                    <?= $courseNum['term'] . ' ' . $courseNum['year'] ; ?> <br/>
                    <?php
                }
            }
            else
            {
                echo "No Record Found";
            }
            ?>



            <h4> Select at least ONE course:</h4>

            <?php
            $con = mysqli_connect("localhost","root","","ta-management");

            $query = "SELECT * FROM course";
            $query_run = mysqli_query($con, $query);

            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $courseNum)
                {
                    ?>
                    <input type="checkbox" name="courseNum[]" value="<?= $courseNum['courseNumber']; ?>" /> 
                    <?= $courseNum['courseNumber']; ?> <br/>
                    <?php
                }
            }
            else
            {
                echo "No Record Found";
            }
            ?>

            </div><br>  

            <input type="submit" name="submit" value="register now" class="form-btn">
            <p>already have an account? <a href="../login/login.html">login now</a></p>
            </form>
        
            <div class="footer"></div> 
     </div> 
     
     <div class="footer">.</div> 
    


</body>
</html>




<?php
#################################################################################
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "ta-management";

    // Connect to database and check if successful
    $con = mysqli_connect($servername, $username, $db_password, $dbname);


    if(isset($_POST['submit'])){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword= $_POST['cpassword'];
        $studentID = $_POST['sID'] ?? false;
        $userType = $_POST['BoxSelect'] ?? false;
        $courses = $_POST['courseNum'] ?? false;
        $term = $_POST['term'] ?? false;

        date_default_timezone_set('America/New_York');
        $time = date('y-m-d h:i:s');

        if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)
            && (!empty($userType)) && !empty($courses))
            {
                if($password != $cpassword){
                    $error[] = 'passwords did not match!';
                }

                else{
                //save to general user database
                $query1 = "insert into user (firstName,lastName,email,password,createdAt,updatedAt) 
                                    values ('$fname','$lname','$email', '$password','$time','$time')";

                mysqli_query($con, $query1);

                foreach($userType as $chkval){

                    #add to professor table if user is a professor and update index in user_usertype
                    if ($chkval == 'isProf'){
                        
                        

                        $query2= "insert into user_usertype (userId, userTypeId) values ('$email',2)";
                        mysqli_query($con, $query2);
                    }
                    
                    #add to student table if user is a student and update index in user_usertype
                    if ($chkval == 'isStudent'){
                        $query3= "insert into students (email,studentID) values ('$email','$studentID')";
                        mysqli_query($con, $query3);

                        $query3= "insert into user_usertype (userId, userTypeId) values ('$email',1)";
                        mysqli_query($con, $query3);}
                    
                    #if user is a ta update index in user_usertype
                    if ($chkval == 'isTA'){

                        $query4= "insert into user_usertype (userId, userTypeId) values ('$email',3)";
                        mysqli_query($con, $query4);}
                    
                    #if user is admin update index in user_usertype
                    if ($chkval == 'isAdmin'){

                        $query5= "insert into user_usertype (userId, userTypeId) values ('$email',4)";
                        mysqli_query($con, $query5);}
                    
                    }
                
                //#add list of courses to user_courses table
                foreach($courses as $chkval){

                    #add each course and email
                    $query6= "insert into user_courses (email, courses) values ('$email','$chkval')";
                    mysqli_query($con, $query6);
                }

                //#add list of courses to user_courses table
                foreach($term as $chkval){

                    #add each course and email
                    $query7= "insert into semester_term (email, term/year) values ('$email','$chkval')";
                    mysqli_query($con, $query7);
                }

                //redirect to login after successful register
                header("Location: ../login/login.html");
                die;}

            }else
            {

                $error[] = 'Please fill all required fields!';
            }
        }
?>


