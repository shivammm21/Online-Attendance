<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Connect to your MySQL database



$servername = "localhost";
$username = "nxwilozu_pvgcoe";
$password = "College@123";
$DatabaseName = "nxwilozu_pvgcoe";

// Retrieve the database name from the GET parameter


// Check if the database name is not empty

$conn = new mysqli($servername, $username, $password, $DatabaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the random number from the POST request
if (isset($_POST['randomNo'])) {
    $randomNo = $_POST['randomNo'];

    // Update the number in the database
    // Assuming 'testotp' has a column named 'otp'
    $tableName = $_GET['dbName'] ?? '';
    $sql = "UPDATE allTeacher SET otp = '$randomNo' WHERE username = '$tableName'";
   // UPDATE MyGuests SET lastname='Doe' WHERE id=2

    if ($conn->query($sql) === TRUE) {
        echo "Number updated successfully";
    } else {
        echo "Error updating number: " . $conn->error;
    }
} else {
    echo "No random number received.";
}

$conn->close();
?>
