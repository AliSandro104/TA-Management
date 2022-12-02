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

        <form action="../cgi_bin/register_submit.php" method="post">
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

           <input type="text" name="sID" id = "sID" placeholder="student ID (999999999)" pattern="[0-9]{9}" maxlength="9" style ="display: none"> 

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

            <select id ="test">
            <?php
            $con = mysqli_connect("localhost","root","","ta-management");

            #distinct to avoid duplicates terms and year combinations
            $query = "SELECT DISTINCT term,year FROM course";
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

        </select>


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

