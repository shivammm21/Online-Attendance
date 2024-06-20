<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 'On');

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
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to check if username and password match
        $sql = "SELECT * FROM $username WHERE passwords = '$password'";
        $result = $conn->query($sql);

        if ($result) {
            if ($result->num_rows > 0) {
                // Credentials are correct, set the session variable
                $_SESSION['username'] = $username;
                echo 'success';
            } else {
                // Incorrect credentials
                echo 'failure';
            }
        } else {
            // Query execution failed
            echo 'query_failure';
        }
    } else {
        // Invalid POST data
        echo 'invalid_post_data';
    }
} else {
    // If not a POST request, handle accordingly (e.g., redirect to login page)
    echo 'Invalid request method';
}

$conn->close();
?>
