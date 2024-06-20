<?php
// Replace these values with your database connection details
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
$rollNo = $_POST['rollNo'];
// Assuming the table name is "students" and the name column is "student_name"
$sql = "SELECT studentName FROM allStudent WHERE rollno = $rollNo"; // Adjust the query as needed

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of the first row (assuming you are fetching by a specific identifier)
    $row = $result->fetch_assoc();
    echo $row["studentName"];
} else {
    echo "Student not found";
}

$conn->close();
?>

