<?php
$servername = "localhost";
$username = "nxwilozu_pvgcoe";
$password = "College@123";
$dbname = "nxwilozu_pvgcoe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get roll no and password from the Android app
$rollNo = $_POST['rollNo'];
$password = $_POST['password'];

// Perform SQL query to check the credentials
$sql = "SELECT * FROM allStudent WHERE rollNo='$rollNo' AND passwords='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login successful
    echo "success";
} else {
    // Login failed
    echo "failure";
}

$conn->close();
?>
