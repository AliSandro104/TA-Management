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

error_log("here");
// Missing a lot of error checks
if(isset($_FILES['file'])){
    $file_content = file($_FILES['file']['tmp_name']);
    foreach($file_content as $row) {
        $items = explode(",", trim($row));
        $email = $items[0];
        $faculty = $items[1];
        $department = $items[2];
        $course_number = $items[3];

        $sql = $conn->prepare("INSERT INTO Professor (professor, faculty, department, course) VALUES (?, ?, ?, ?)");
        $sql->bind_param('ssss', $email, $faculty, $department, $course_number);
        $result = $sql->execute();
    }
}

/*
$result = $conn->query("SELECT * FROM ta_cohort WHERE (Email = '$email' AND TermYear='$course_term')");
$num = $result->num_rows;
// if TA for a semester is not already in the database, insert it
if ($result->num_rows==0) {
    $sql = $conn->prepare("INSERT INTO ta_cohort (TermYear, TAName, StudentID, 	LegalName, Email, GradUgrad, SupervisorName, Priority, NumberHours, DateApplied, TheLocation, Phone, Degree, CoursesApplied, OpenToOtherCourses, Notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $sql->bind_param('ssisssssississss', $course_term, $ta_name, $student_id, $legal_name, $email, $grad_ugrad, $supervisor_name, $priority, $hours, $date_applied, $location, $phone, $degree, $courses_applied, $open_to_other_courses, $notes);
    $result = $sql->execute();
} else {
// else, update the fields of that TA with the import
    $sql = "UPDATE ta_cohort SET TAName='$ta_name', StudentID='$student_id', LegalName='$legal_name', GradUgrad='$grad_ugrad', SupervisorName='$supervisor_name', Priority='$priority', NumberHours=$hours, DateApplied='$date_applied', TheLocation='$location', Phone='$phone', Degree='$degree', CoursesApplied='$courses_applied', OpenToOtherCourses='$open_to_other_courses', Notes='$notes' WHERE (Email='$email' AND TermYear='$course_term')";
    mysqli_query($conn, $sql);
}*/

$conn->close();

header("Location: ../dashboard/dashboard_sysop.php");
exit();
?>