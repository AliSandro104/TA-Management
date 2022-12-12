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

// define all fields to add to the database
$course_number = $_POST['courseNumber'];
$course_name = $_POST['courseName'];
$course_description = $_POST['courseDescription'];
$course_term = $_POST['term'];
$course_year = $_POST['year'];
$course_instructor_email = $_POST['instrEmail'];

$sql = $conn->prepare("SELECT * FROM Course WHERE courseNumber = ?");
$sql->bind_param('s', $course_number);
$sql->execute();
$result = $sql->get_result();
$course = $result->fetch_assoc();

if ($course) {
    echo "<div class='error'>The course already exists.</div>";
    $conn->close();
    die();
} else {
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = $conn->prepare("INSERT INTO Course (courseName, courseDesc, term, year, courseNumber, courseInstructor) VALUES (?, ?, ?, ?, ?, ?)");
    $sql->bind_param('ssssss', $course_name, $course_description, $course_term, $course_year, $course_number, $course_instructor_email);
    $result = $sql->execute();
    $conn->close();
}

if ($result) {
    echo "<p>Account created successfully!</p>";
} else {
    echo "<p>Account creation failed...</p>";
} 
?>