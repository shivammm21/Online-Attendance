<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Assuming you have a database connection established
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
    $enteredOTP = $_POST['enteredOTP'];

    $sql = "SELECT * FROM allTeacher WHERE otp = '$enteredOTP'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    	$row = $result->fetch_assoc();
    	$teacherName = $row['username'].'d';
    	
    	 $sql1 = "SELECT * FROM allStudent WHERE rollno = '$rollNo'";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
    $row1 = $result1->fetch_assoc();
    	$studentName = $row1['studentName'];
    }
    
    $insertPresnt = "INSERT INTO $teacherName (`rollno`, `studentName`) VALUES ('$rollNo','$studentName')";

    if ($conn->query($insertPresnt) === TRUE) {
    
    echo "correct";
       
    } else {
        
    }
    
    
        
    } else {
        echo "incorrect";
    }

    $conn->close();
} else {
    echo "Invalid request method";
}
?>

