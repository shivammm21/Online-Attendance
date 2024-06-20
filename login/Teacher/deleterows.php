<?php
// Connect to your MySQL database

$servername = "localhost";
$username = "nxwilozu_pvgcoe";
$password = "College@123";
$DatabaseName = "nxwilozu_pvgcoe";

$conn = new mysqli($servername, $username, $password, $DatabaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL to delete all rows in your table (replace 'your_table' with your actual table name)
$tableName = $dbUser.'d';

$sql = "DELETE FROM $tableName";

if ($conn->query($sql) === TRUE) {
   
} else {
    echo "Error deleting rows: " . $conn->error;
}

$conn->close();
?>
