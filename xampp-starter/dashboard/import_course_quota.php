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
        $course_number = $items[1];
        $course_name = $items[2];
        $course_type = $items[3];
        $instructor_name = $items[4];
        $enrollment_number = $items[5];
        $ta_quota = $items[6];
        
        $sql = $conn->prepare("INSERT INTO courses_quota (TermYear, CourseNumber, CourseName, CourseType, InstructorName, EnrollmentNumber, TAQuota) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $sql->bind_param('sssssii', $course_term, $course_number, $course_name, $course_type, $instructor_name, $enrollment_number, $ta_quota);
        $result = $sql->execute();
    }
}
$conn->close();
?>