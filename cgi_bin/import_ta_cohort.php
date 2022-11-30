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

// Missing a lot of error checks
if(isset($_FILES['myfile'])){
    $file_content = file($_FILES['myfile']['tmp_name']);
    foreach($file_content as $row) {
        $items = explode(",", trim($row));
        $course_term = $items[0];
        $ta_name = $items[1];
        $student_id = $items[2];
        $legal_name = $items[3];
        $email = $items[4];
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
        
        $sql = $conn->prepare("INSERT INTO ta_cohort (TermYear, TAName, StudentID, 	LegalName, Email, GradUgrad, SupervisorName, Priority, NumberHours, DateApplied, TheLocation, Phone, Degree, CoursesApplied, OpenToOtherCourses, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('ssisssssississss', $course_term, $ta_name, $student_id, $legal_name, $email, $grad_ugrad, $supervisor_name, $priority, $hours, $date_applied, $location, $phone, $degree, $courses_applied, $open_to_other_courses, $notes);
        $result = $sql->execute();
    }
}
$conn->close();
header("Location: ../dashboard/dashboard_admin.php");
exit();

?>