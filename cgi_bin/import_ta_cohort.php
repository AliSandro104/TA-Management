<?php
$servername = "localhost"; // Change accordingly
$username = "root"; // Change accordingly
$password = ""; // Change accordingly
$db = "ta-management"; // Change accordingly

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_FILES['myfile'])){
    $file_content = file($_FILES['myfile']['tmp_name']);
    foreach($file_content as $row) {
        $items = explode(",", trim($row));
        $course_term = $items[0];
        $ta_name = $items[1];
        $student_id = $items[2];
        $legal_name = $items[3];
        $email = strtolower($items[4]);
        $grad_ugrad = $items[5];
        $supervisor_name = $items[6];
        $priority = $items[7];
        $hours = $items[8];
        $date_applied = $items[9];
        $location = $items[10];
        $phone = $items[11];
        $degree = $items[12];
        $courses_applied = $items[13];
        $open_to_other_courses = $items[14];
        $notes = $items[15];

        $result = $conn -> query("SELECT * FROM ta_cohort");
        while($row = mysqli_fetch_array($result)) {
            
            // if TA already in database, update the columns with the content of the file instead of inserting a new row
            if ($row['Email'] == $email) {
                $sql = "UPDATE ta_cohort SET TermYear='$course_term', TAName='$ta_name', StudentID='$student_id', LegalName='$legal_name', GradUgrad='$grad_ugrad', SupervisorName='$supervisor_name', Priority='$priority', NumberHours=$hours, DateApplied='$date_applied', TheLocation='$location', Phone='$phone', Degree='$degree', CoursesApplied='$courses_applied', OpenToOtherCourses='$open_to_other_courses', Notes='$notes' WHERE Email='$email'";
                mysqli_query($conn, $sql);
                
            } else {
                // else, insert a new row
                $sql = $conn->prepare("INSERT INTO ta_cohort (TermYear, TAName, StudentID, 	LegalName, Email, GradUgrad, SupervisorName, Priority, NumberHours, DateApplied, TheLocation, Phone, Degree, CoursesApplied, OpenToOtherCourses, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param('ssisssssississss', $course_term, $ta_name, $student_id, $legal_name, $email, $grad_ugrad, $supervisor_name, $priority, $hours, $date_applied, $location, $phone, $degree, $courses_applied, $open_to_other_courses, $notes);
                $result = $sql->execute();
            }
        }
    }
}
$conn->close();
header("Location: ../dashboard/dashboard_admin.php");
exit();

?>