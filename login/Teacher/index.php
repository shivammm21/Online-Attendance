

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <title>Teacher | Login Page</title>
    <link rel="stylesheet" href="indexCSS.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
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
     $tearcherUser = $_GET['username'];

            $sql = "SELECT * FROM allTeacher WHERE username='$tearcherUser'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Login successful
                $row = $result->fetch_assoc();

                // Access the values
               
                $teacherName = $row['teacherName'];

               
              
            } else {
                // Login failed
                $error_message = "Invalid roll number or password. Please try again.";
            }


    ?>
        <div class="wrapper" style="text-align: center;">
            <header>Hello <?php echo $teacherName; ?></header><br>
           
           
            
           
            <?php
    // PHP variable for the database name
    $dbName = $_GET['username'];
    ?>
             

                <div style="margin-top: 50px;">

                <header style="color: green; font-size:300%;" id="generatedOtp"></header><br>
                <select id="subject" name="subject" style="border-radius: 8px; height:40px; width:200px;">
        <?php
            // Connect to your MySQL database
            $mysqli = new mysqli("localhost", "nxwilozu_pvgcoe", "College@123", "nxwilozu_pvgcoe");

            // Check connection
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Fetch data from the database
            $result = $mysqli->query("SELECT teacherSub FROM $dbName");

            // Loop through the result set and populate the combo box
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['teacherSub'] . "'>" . $row['teacherSub'] . "</option>";
            }

            // Close the connection
            $mysqli->close();
        ?>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the selected value from the combo box
        $selectedValue = $_POST["subject"];
    }
?>
    </select><br>
                <button onclick="generateAndSend('<?php echo $dbName; ?>'); startTimerAndPerformAction('<?php echo $dbName; ?>');" >Generate OTP</button>
                <script>
function generateAndSend(dbName) {
    // Generate a random 4-digit number
    var randomNo = Math.floor(1000 + Math.random() * 9000);

    // Get the selected value from the combo box
    var selectedOption = document.getElementById("subject").value;

    // Make a fetch request to the PHP script to update the number and subject
    fetch('update.php?dbName=' + dbName, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'randomNo=' + randomNo + '&subject=' + encodeURIComponent(selectedOption),
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        // Update the HTML content with the generated OTP
        document.getElementById('generatedOtp').innerText = randomNo;
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
                   
                    <div style="text-align: center;">
                        
                        <div ><h1 id="timer" style="color: red; font-size: 200%;">00:15</h1></div>

                          <?php
    // PHP variable for the database name
    $dbName = $_GET['username'];
    ?>
                        <script>
                          let timer;
        let timerDisplay = document.getElementById('timer');
        let timerValue;

        function startTimer(duration,dbName) {
            timerValue = duration;
            updateTimerDisplay();
            timer = setInterval(function() {
                timerValue--;
                updateTimerDisplay();
                if (timerValue <= 0) {
                    clearInterval(timer);
                    performAction(dbName); // Call your action function here
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

        function startTimerAndPerformAction(dbName) {
            timerValue = 15; // Set the timer duration in seconds
            startTimer(timerValue,dbName);
        }

        function performAction(dbName) {
    // Your action logic goes here
    var randomNo1 = 123;
    //var subject = "abc";  // Set your desired subject here

    // Make a fetch request to the PHP script to update the number and subject
    location.reload();
    var db = dbName;
    fetch('updateOTP.php?dbName=' + db, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'randomNo=' + randomNo1,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>
<h2 style="color:green">

            <?php

$servername = "localhost";
$username1 = "nxwilozu_pvgcoe";
$password = "College@123";
$databaseName = "nxwilozu_pvgcoe";



$conn = new mysqli($servername, $username1, $password,$databaseName);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
     $tearcherUser = $_GET['username'].'d';

                $sql3 = "SELECT COUNT(*) as total_rows FROM $tearcherUser";
                $result2 = $conn->query($sql3);
                
                if ($result2->num_rows > 0) {
                    // Fetch the result as an associative array
                    $row = $result2->fetch_assoc();

                    $totalStud = $row["total_rows"];
                    
                    // Print the total number of rows
                    echo "Present Student " . $row["total_rows"];
                } 
            ?>

          </h2>
                   

                    <?php 
                  error_reporting(E_ALL);
                  ini_set('display_errors', 1);
                  $dbUser = $_GET['username'];
                 
                  //$sub = $_POST["subject"];
                  include 'generatepdf/submit.php';

                  $pdfFilename = $dbUser . '.pdf';

                  include 'deleterows.php'; 
                ?>
                    <button type="submit" onclick="logout()" style="background-color: red;"">Log Out</button>
                        
                    <button
            class="btn btn-color-2" 
            onclick=" window.open('./generatepdf/PDF/<?php echo $pdfFilename; ?>'); deleteAllRows(<?php echo $dbName.'d';?>);">
            Download PDF
          </button>

         

          

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

        function deleteAllRows(dbName) {
    // Log the constructed URL for debugging
    
        
            window.location.href = 'deleterows.php?id=' + dbName;
    
    }

        </script>
        <script>
    console.log('<?php echo $dbName.'d';?>');
</script>


          </div>
          

          </div>
        
        
    </div>

    <script src="js/script.js"></script>
</body>

</html>