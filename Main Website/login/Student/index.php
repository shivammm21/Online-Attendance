<?php
session_start();



?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Student | Home Page</title>

    <style>


.combo {
    padding: 8px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 200px;
}

/* Style the dropdown arrow */
.combo:after {
    content: '\25BC'; /* Unicode character for down arrow */
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
}

/* Style the dropdown options */
.combo option {
    padding: 10px;
    font-size: 14px;
    background-color: #fff;
    color: #333;
}

/* Style the hover effect on options */
.combo option:hover {
    background-color: #f5f5f5;
}



.img-tick{
    height:100%;
    width:100%;
    border-radius: 300px 300px 300px 300px;
}
.green-tick-div{
    height: 35px;
    width: 35px;
    border-radius: 300px 300px 300px 300px;
   
    margin-top: 0px;
   
    
}


    </style>

</head>

<body>

    <div class="container" id="container">


    <?php 

    


$servername = "localhost";
$username1 = "nxwilozu_pvgcoe";
$password = "College@123";
$databaseName = "nxwilozu_pvgcoe";



$conn = new mysqli($servername, $username1, $password,$databaseName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
     $rollno = $_SESSION['username'];

            $sql = "SELECT * FROM allStudent WHERE rollno='$rollno'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Login successful
                $row = $result->fetch_assoc();

                // Access the values
                $rollno = $row['rollno'];
                $studentName = $row['studentName'];

               
              
            } else {
                // Login failed
                $error_message = "Invalid roll number or password. Please try again.";
            }


    ?>
        
            <form action="" method="POST">
                <h1>Hello <?php echo $studentName;?>  </h1>
                <br>
                
                <input type="text" name="otp" onClick="startTimerAndPerformAction()" placeholder="OTP" style="width: auto; height: auto;" >
                
                <div><h1 id="timer" style="color: red; font-size: 200%;">00:06</h1></div>

<script>
    let timer;
    let timerDisplay = document.getElementById('timer');
    let timerValue;

    function startTimer(duration) {
        timerValue = 6;
        updateTimerDisplay();
        timer = setInterval(function () {
            timerValue--;
            updateTimerDisplay();
            if (timerValue <= 0) {
                clearInterval(timer);
                // Perform any action or function when the timer reaches 0
                // For example, you can call a function like performAction(dbName);
                window.location.href = 'login.php';
            }
        }, 1000);
    }

    function updateTimerDisplay() {
        let minutes = Math.floor(timerValue / 60);
        let seconds = timerValue % 60;

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        timerDisplay.textContent = minutes + ":" + seconds;
    }

    function startTimerAndPerformAction() {
        timerValue = 6; // Set the timer duration in seconds
        startTimer(timerValue);
        
    }

    // Example function to perform an action when the timer reaches 0
    function performAction() {
        
    }
</script>
                
                
                
                <button onclick="logout()" type="submit" style="background-color: red;">Log Out</button>
                <script>
          function logout() {
            // Make a fetch request to the logout.php script
            fetch('logout.php', {
                    method: 'GET',
                })
                .then(response => response.text())
                .then(data => {
                    // Redirect to the login page or handle as needed
                    window.location.href = 'login.php';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
        </script>

               
                <button type="submit">Present</button>
                
                <h1><?php 
                

                $servername = "localhost";
                $username1 = "nxwilozu_pvgcoe";
                $password = "College@123";
                $databaseName = "nxwilozu_pvgcoe";
                
                
                
                $conn = new mysqli($servername, $username1, $password,$databaseName);
                
                
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                
                // Get the entered OTP and selected username from the POST data
                $enteredOTP = $_POST['otp'];
                $selectedUsername = $_POST['username'];
                
                // Fetch the stored OTP for the selected username from the database
                $sql = "SELECT * FROM allTeacher WHERE otp = '$enteredOTP'";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $storedOTP = $row['otp'];
                    $teach = $row['username'];
                    $teacherName = $row['username'].'d';
                    $storeDB = $row['username'];
   
                
                    // Check if the entered OTP matches the stored OTP
                    if ($enteredOTP == $storedOTP) {

                       

                        $insertPresnt = "INSERT INTO $teacherName (`rollno`, `studentName`) VALUES ('$rollno','$studentName')";

    if ($conn->query($insertPresnt) === TRUE) {
       
    } else {
        
    }

                        //echo "Valid OTP for teacher: $teacherName";
                        ?>
                       
                        <img class="img-tick green-tick-div" src="Tick-icon.jpg" alt="not found">
                        <h3 style="color: green"><?php
                            
                            //$teach = $_POST['username'];

                            $printsub = "SELECT teacherSub FROM allTeacher WHERE username = '$teach'";
                            $result1 = $conn->query($printsub);
                            if($result->num_rows>0){
                                $row1 = $result1->fetch_assoc();
                                //$sub = 
                                echo "You are Present in ".$row1['teacherSub']." Subject";
                            }
                        ?></h3>
                        
   
                    <?php



$servername = "localhost";
$username1 = "nxwilozu_pvgcoe";
$password = "College@123";
$databaseName = "nxwilozu_pvgcoe";



$conn = new mysqli($servername, $username1, $password,$databaseName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
                
                       
                            //teacher
                    //here what I Do??
                    $newTable = $selectedUsername.'d';
                    $insertPresent = "INSERT INTO $newTable (rollno, studentName) VALUES ('$rollno', '$studentName')";
                   
                    if ($conn->query($insertPresent) === TRUE) {

                       
                      
                    } else {
                        echo "Error inserting data: " . $conn->error;
                    }
                   
                
                
                    } else {
                        ?>
                        
                        <img class="img-tick green-tick-div" src="Wrong-tick.png" alt="not found">

                        <div ><h1 id="timer" style="color: red; font-size: 200%;"></h1></div>
                        <script>
                            var timer = 2;
                            setInterval(function() {
                            timer--;
                            document.getElementById('timer').innerText = timer;
                             if (timer === 0) {
                // Redirect or trigger an AJAX request to update the query
                             // Replace this with the actual value you want to pass
                            window.location.href = 'sign.php';
            }
        }, 1000);
    </script>
   

                    <?php
                    }
                } else {
                    //echo 'incorrect';
                }
                
                // Close the database connection
                $conn->close();
                
                
                
                ?></h1>


            </form>
      
    </div>
   
    <script src="js/script.js"></script>
</body>

</html>
