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
    
    $tableName = $_POST['username'];

    // Create a table named 'your_table'
    $sqlCreateTable = "CREATE TABLE $tableName (
        teacherName VARCHAR(1000) NOT NULL,
        teacherSub VARCHAR(1000) NOT NULL,
        email VARCHAR(1000) NOT NULL,
        passwords VARCHAR(255) NOT NULL
    )";



    if ($conn->query($sqlCreateTable) === TRUE) {

        $newTable = $tableName.'d';
        $sqlstudentTable = "CREATE TABLE $newTable (
            rollno INT(4) NOT NULL,
            studentName VARCHAR(1000) NOT NULL
        )";
        
        if ($conn->query($sqlstudentTable) === TRUE) {
            $teacherName = $_POST['teacherName'];
            $email = $_POST['email'];
            $passwords = $_POST['passwords'];
            $tearcherSub = $_POST['teacherSub'];
    
            // Insert a record with '1234' in the 'otp' column
            $sqlInsertData = "INSERT INTO $tableName (teacherName,teacherSub,email,passwords) VALUES ('$teacherName','$tearcherSub','$email','$passwords')";
    
            if ($conn->query($sqlInsertData) === TRUE) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        

      
    } 



$sqlteacherInsert = "INSERT INTO allTeacher (otp,teacherName,username) VALUES (765 ,'$teacherName','$tableName')";

if ($conn->query($sqlteacherInsert) === TRUE) {
    //$error_message = "Data Inserted Successful";
} else {
    
   
}




// Close the connection
$conn->close();
}
?>
