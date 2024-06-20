<?php
$servername = "localhost";
$username = "nxwilozu_pvgcoe";
$password = "College@123";
$databaseName = "nxwilozu_pvgcoe";

$conn = new mysqli($servername, $username, $password, $databaseName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rollno = $_POST['rollno'];
    $studName = $_POST['studentName'];
    $passwords = $_POST['password'];

    $sql = "INSERT INTO allStudent (rollno, studentName, passwords) VALUES ('$rollno', '$studName', '$passwords')";

    if ($conn->query($sql) === TRUE) {
        echo 'success';
    } else {
        echo 'error';
    }

    $conn->close();
}
?>
