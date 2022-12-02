<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "ta-management";

    // Connect to database and check if successful
    $conn = mysqli_connect($servername, $username, $db_password, $dbname);


    if(isset($_POST['submit'])){

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $cpassword= $_POST['cpassword'];
        $studentID = $_POST['sID'] ?? false;
        $userType = $_POST['BoxSelect'] ?? false;
        $studentCourses = $_POST['StudentCourses'] ?? false;
        $profCourses = $_POST['profCourses'] ?? false;
        $taCourses = $_POST['taCourses'] ?? false;

        date_default_timezone_set('America/New_York');
        $time = date('y-m-d h:i:s');

        //check if account is duplicate
        $query = "SELECT email FROM user WHERE email = '$email'";
        $duplicate = mysqli_query($conn, $query);
        if(mysqli_num_rows($duplicate) > 0){
            $error[] = 'User already exists with this email!';
        }

        //check if passwords match
        elseif($password != $cpassword){
            $error[] = 'Input passwords do not match!';
        }

        else{
            //check if all required field are filled (without courses)
            if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)
                && (!empty($userType)))
                {   
                    //check if at least one course was chosen per usertype
                    foreach($userType as $chkval){
                        if ($chkval == 'isStudent'){
                            if(empty($studentCourses)){
                                $error[] = 'Please select at least 1 course per chosen usertype!';
                            }
                        }
            
                        if ($chkval == 'isTA'){
                            if(empty($taCourses)){
                                $error[] = 'Please select at least 1 course per chosen usertype!';
                            }
                        }
                    
                    //once all requirements are checked, add data to database

                    //save to general user database once all requirements are checked
                    $query = "insert into user (firstName,lastName,email,password,createdAt,updatedAt) values ('$fname','$lname','$email', '$password','$time','$time')";
                    mysqli_query($conn, $query);
                    
                    //fill corresponding tables for each usertype
                    foreach($userType as $chkval){

                        #add student info to corresponding tables
                        if ($chkval == 'isStudent'){
                            
                            //insert to user_usertype table
                            $query1= "insert into user_usertype (userId, userTypeId) values ('$email',1)";
                            mysqli_query($conn, $query1);

                            //insert to all_student table
                            foreach($studentCourses as $val){
                                //split string of info
                                $split = (explode(" ", $val));
                                $course = $split[0] . ' '  .$split[1];
                                $term = $split[2];
                                $year = $split[3];
                                $query1= "insert into all_students (email,studentID,courseNumber,term,year) values ('$email','$studentID','$course','$term','$year')";
                                mysqli_query($conn, $query1);
                            }
                        }
                        
                        //add prof info to corresponding table
                        if ($chkval == 'isProf'){
                            
                            //insert to user_usertype table
                            $query2= "insert into user_usertype (userId, userTypeId) values ('$email',2)";
                            mysqli_query($conn, $query2);
                        }
                        
                        #add TA info to corresponding tables
                        if ($chkval == 'isTA'){
                            
                            //insert to user_usertype table
                            $query3= "insert into user_usertype (userId, userTypeId) values ('$email',3)";
                            mysqli_query($conn, $query3);

                            //insert to all_student table
                            foreach($taCourses as $val){
                                //split string of info
                                $split = (explode(" ", $val));
                                $course = $split[0] . ' '  .$split[1];
                                $term = $split[2];
                                $year = $split[3];
                                $query3= "insert into all_ta (email,courseNumber,term,year) values ('$email','$course','$term','$year')";
                                mysqli_query($conn, $query3);
                            }
                        }
                        
                        #if TA admin info to corresponding tables
                        if ($chkval == 'isAdmin'){

                            $query4= "insert into user_usertype (userId, userTypeId) values ('$email',4)";
                            mysqli_query($conn, $query4);  
                        }
                    }
                    //redirect to login after successful register
                    header("Location: ../login/login.html");
                    die;}
                }else
                {
                    $error[] = 'Please fill all required fields!';
                }
        }
    }
?>