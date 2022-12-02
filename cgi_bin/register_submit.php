<?php

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
                        
                        #$query2= "insert into professor (professor) values ('$email')";
                        #mysqli_query($con, $query2);

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

                //#add correspong term and year to user
                foreach($term as $chkval){
                    #split the string into array
                    $split = (explode(" ", $chkval));
                    #add to term_year table
                    $query7= "insert into term_year (email, term, year) values ('$email','$split[0]','$split[1]')";
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