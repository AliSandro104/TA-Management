<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "ta-management";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['user'];

// delete the user from the user database
$sql = "DELETE FROM user WHERE email = $email";
mysqli_query($conn, $sql);
header("Location: ../dashboard/dashboard_sysop.php");  
?>