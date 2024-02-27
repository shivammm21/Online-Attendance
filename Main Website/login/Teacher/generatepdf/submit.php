<?php
require_once(__DIR__ . '/tcpdf/tcpdf.php');
require 'vendor/autoload.php';
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;


// Database connection
$servername = "localhost";
$username = "nxwilozu_pvgcoe";
$password = "College@123";
$DatabaseName = "nxwilozu_pvgcoe";

$conn = new mysqli($servername, $username, $password, $DatabaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all data from the database table
$newtable = $dbUser.'d';
$result = $conn->query("SELECT * FROM $newtable ORDER BY rollno ASC");

$sql = "SELECT * FROM allTeacher";

$result2 = $conn->query($sql);
                
if ($result2->num_rows > 0) {
                    // Fetch the result as an associative array
        $row = $result2->fetch_assoc();
                    
                    // Print the total number of rows
    $subjectName = $row['teacherSub'];
                } 

// Create PDF
$pdf = new TCPDF();
$pdf->AddPage();

// Add logo in the top middle
//$logoX = ($pdf->GetPageWidth() - 30) / 2;  // Centered
//$pdf->Image('logo.jpeg', $logoX, 12, 30, 30);
// Set the default time zone to Kolkata
date_default_timezone_set('Asia/Kolkata');

// Create a DateTime object for the current date and time
$currentDateTime = new DateTime();

// Format the date and time
$date = $currentDateTime->format('Y-m-d');
$time = $currentDateTime->format('h:i:s A');
// Add spacing between logo and heading
//pdf->Cell(0, 30, '', 0, 1);  // Add more height for additional spacing

// Add PVG COE heading
$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(0, 10, 'PUNE VIDYARTHI GRIHA\'S ATTENDANCE', 0, 1, 'C');
$pdf->SetFont('times', '',14);
$pdf->Cell(0, 10, 'Date : ' . $date, 0, 1, 'L');
$pdf->Cell(0, 10, 'Time : ' . $time, 0, 1, 'L');
$pdf->Cell(0, 10, 'Subject : ' . $subjectName, 0, 1, 'L');
$pdf->Cell(0, 10, 'Total Student Present : ' . $totalStud, 0, 1, 'L');
$pdf->Cell(0, 15, '', 0, 1);
// Add a table with headers
$pdf->SetFont('helvetica', 'B', 12);  // Use 'helvetica' instead of 'Arial'
$pdf->SetFillColor(200, 220, 255);
$pdf->Cell(30, 10, 'Roll No', 1, 0, 'C', 1);
$pdf->Cell(60, 10, 'Student Name', 1, 1, 'C', 1); // Add 1 to move to the next row

// Loop through the database results and add them to the table
$pdf->SetFont('helvetica', '', 10);
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['rollno'], 1, 0, 'C');
    $pdf->Cell(60, 10, $row['studentName'], 1, 1, 'C'); // Add 1 to move to the next row
}



// Define the PDF filename with the username
$pdfFilename = $dbUser . '.pdf';

// Construct the full path to the PDF
$pdfPath = __DIR__ . '/PDF/' . $pdfFilename;
if (!$pdf->Output($pdfPath, 'F')) {
    //echo 'PDF generated successfully!';

    //$tableName = $dbUser.'d';
    
    
/*
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'onlinepvg@gmail.com';
    $mail->Password = 'jrxslfnkypfvkfyk';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('onlinepvg@gmail.com');


    $mail->addAddress('shivamthorat00@gmail.com');
    $mail->isHTML(true);
    $mail->Subject = 'Take a mail';

    $mail->Body = 'Hello ';

    $mail->Send();


*/




} else {
    //echo 'Error generating PDF: ' . $pdf->getError();
}

// Send email with the PDF attachment

// Call the function to generate PDF and send email
$conn->close();
?>
