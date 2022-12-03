
<?php

$servername = "localhost";
$username = "root";
$db_password = "";
$dbname = "ta-management";

// Connect to database and check if successful
$conn = mysqli_connect($servername, $username, $db_password, $dbname);

$year =  'N/A';
$course = 'N/A';
$term = 'N/A';

if(isset($_POST['confirm'])){

    $year =  $_POST['year'];
    $course = $_POST['course'];
    $term = $_POST['term'];
    //no need to check if they contain values because i checked with javascript

}


//if(isset($_POST['submit'])){

?>