<?php
$servername = "localhost"; // Change accordingly
$username = "xampp_starter"; // Change accordingly
$password = "qV[eoVIhLYT/uYgr"; // Change accordingly
$db = "xampp_starter"; // Change accordingly

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// define all fields to add to the database
$instructor_email = $_POST['professor'];
$faculty = $_POST['faculty'];
$department = $_POST['department'];
$course_number = $_POST['course'];

$sql = $conn->prepare("SELECT * FROM Professor WHERE professor = ?");
$sql->bind_param('s', $email);
$sql->execute();
$result = $sql->get_result();
$user = $result->fetch_assoc();

if ($user) {
    echo "<div class='error'>The Professor already exists.</div>";
    $conn->close();
    die();
} else {
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
    $sql = $conn->prepare("INSERT INTO Professor (professor, faculty, department, course) VALUES (?, ?, ?, ?)");
    $sql->bind_param('ssss', $instructor_email, $faculty, $department, $course_number);
    $result = $sql->execute();
    $conn->close();
}

if ($result) {
    echo "<p>Account created successfully!</p>";
} else {
    echo "<p>Account creation failed...</p>";
} 
?>