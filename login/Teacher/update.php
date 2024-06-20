<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to your MySQL database
$servername = "localhost";
$username = "nxwilozu_pvgcoe";
$password = "College@123";
$DatabaseName = "nxwilozu_pvgcoe";

// Check if the database name is not empty
$conn = new mysqli($servername, $username, $password, $DatabaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the random number and subject from the POST request
if (isset($_POST['randomNo'], $_POST['subject'], $_GET['dbName'])) {
    $randomNo = $_POST['randomNo'];
    $subject = $_POST['subject'];
    $tableName = $_GET['dbName'];

    // Sanitize the inputs (you should do more extensive validation based on your requirements)
    $randomNo = $conn->real_escape_string($randomNo);
    $subject = $conn->real_escape_string($subject);

    // Update the record in the database
    $query = "UPDATE allTeacher SET teacherSub = '$subject', otp = '$randomNo' WHERE username = '$tableName'";

    // Execute the update
    if ($conn->query($query) === TRUE) {
        echo "Number and subject updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "No random number or subject received.";
}

$conn->close();
?>
