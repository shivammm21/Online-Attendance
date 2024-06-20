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
            $tearcherSub1 = $_POST['teacherSub1'];
    
            // Insert a record with '1234' in the 'otp' column
            $sqlInsertData = "INSERT INTO $tableName (teacherName,teacherSub,email,passwords) VALUES ('$teacherName','$tearcherSub','$email','$passwords')";
            $sqlInsertData1 = "INSERT INTO $tableName (teacherName,teacherSub,email,passwords) VALUES ('','$tearcherSub1','','')";
    
            if ($conn->query($sqlInsertData) === TRUE && $conn->query($sqlInsertData1) === TRUE) {
                echo 'success';
            } else {
                echo 'error';
            }
        }
        

      
    } 



$sqlteacherInsert = "INSERT INTO allTeacher (otp,teacherName,username,teacherSub) VALUES (123,'$teacherName','$tableName','abc')";

if ($conn->query($sqlteacherInsert) === TRUE) {
    //$error_message = "Data Inserted Successful";
} else {
    
   
}




// Close the connection
$conn->close();
}
?>
