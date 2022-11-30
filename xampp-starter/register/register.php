

<?php

    $servername = "localhost";
    $username = "root";
    $db_password = "";
    $dbname = "users";
    echo "here"
    // Connect to database and check if successful
    $con = mysqli_connect($servername, $username, $password, $dbname) or die("unable to connect to host");


if(isset($_POST['submit'])){

    $fname = $_POST['fname']
    $lname = $_POST['lname']
    $email = $_POST['email']
    $password = $_POST['password']
    $studentID = check_input($_POST['sID'], "Optional");
    $student = $_POST['isStudent']
    $professor = $_POST['isProf']
    $ta = $_POST['isTA']
    $admin = $_POST['isAdmin']
    $courses = $_POST['courses'];
    $time = date_default_timezone_get();

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)
         && isset($student || $professor || $ta || $admin) !empty($courses))
		{
			//save to general user database
			$query1 = "insert into user (firstName,lastName,email,password,createdAt,updatedAt) 
                                values ('$fname','$lname','$email', '$password','$time','$time')";

			mysqli_query($con, $query1);

            #add to professor table if user is a professor and update index in user_usertype
            if (!empty ($professor))
                $query2= "insert into professor (professor) values ('$email')"
                mysqli_query($con, $query2);

                $query2= "insert into user_usertype (userId, userTypeId) values ('$email',2)"
                mysqli_query($con, $query2);
            
            #add to student table if user is a student and update index in user_usertype
            if (!empty ($student))
                $query3= "insert into students (email,studentID) values ('$email','$studentID')"
                mysqli_query($con, $query3);

                $query3= "insert into user_usertype (userId, userTypeId) values ('$email',1)"
                mysqli_query($con, $query3);
            
            #if user is a ta update index in user_usertype
            if (!empty ($ta))

                $query4= "insert into user_usertype (userId, userTypeId) values ('$email',3)"
                mysqli_query($con, $query4);
            
            #if user is admin update index in user_usertype
            if (!empty ($admin))

                $query5= "insert into user_usertype (userId, userTypeId) values ('$email',4)"
                mysqli_query($con, $query5);

            #add list of courses to user_courses table
            $query6= "insert into user_courses (email, courses) values ('$email',$courses)"
            mysqli_query($con, $query6);

            //redirect to login after successful register
			header("Location: ../login/login.html");
			die;

		}else
		{
			echo "Please enter some valid information!";
		}
    }
?>