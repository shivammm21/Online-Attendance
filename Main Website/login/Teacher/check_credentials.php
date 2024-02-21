<?php
// Get username and password from the POST request

$servername = "localhost";
$username1 = "nxwilozu_pvgcoe";
$password1 = "College@123";
$databaseName = "nxwilozu_pvgcoe";

$conn = new mysqli($servername, $username1, $password1, $databaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize user input to prevent SQL injection
    $rollno1 = mysqli_real_escape_string($conn, $username);
    $passwords = mysqli_real_escape_string($conn, $password);

   

    // Query to check if roll number and password match
    $sql = "SELECT * FROM $username WHERE passwords = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        //$row = $result->fetch_assoc();
        //$studentName = $row['studentName'];

// Check the credentials (replace this with your actual logic)

    echo 'success';
} else {
    echo 'error';
}
}
?>
