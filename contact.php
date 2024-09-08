<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

// Database connection
$host = 'localhost';
$dbname = 'contact';  // Use your database name
$username = 'root';  // Replace with your MySQL username
$password = '';  // Replace with your MySQL password

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject'])); 
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    // Execute and check for success
    if ($stmt->execute()) {
        echo "Contact information stored successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Send the email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; 
        $mail->SMTPAuth   = true;
        $mail->Username   = 'indirakanuri1@gmail.com'; 
        $mail->Password   = 'juyo zqyq lhvc cktz'; // Use an App Password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
        $mail->Port       = 587;
        $mail->SMTPDebug  = 0;  // Disables verbose debug output

        // Recipients
        $mail->setFrom('indirakanuri1@gmail.com', 'Mailer');
        $mail->addAddress('indirakanuri1@gmail.com'); 

        // Content
        $mail->isHTML(false); 
        $mail->Subject = $subject;  
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();

        // Send a thank you email to the user
        $thankYouMail = new PHPMailer(true);
        $thankYouMail->isSMTP();
        $thankYouMail->Host       = 'smtp.gmail.com';
        $thankYouMail->SMTPAuth   = true;
        $thankYouMail->Username   = 'indirakanuri1@gmail.com'; 
        $thankYouMail->Password   = 'juyo zqyq lhvc cktz'; 
        $thankYouMail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $thankYouMail->Port       = 587;

        $thankYouMail->setFrom('indirakanuri1@gmail.com', 'KPSI');
        $thankYouMail->addAddress($email); // Send thank you email to the user's email address

        $thankYouMail->isHTML(true);
        $thankYouMail->Subject = 'Thank You for Connecting with Us!';
        $thankYouMail->Body    = "<p>Dear $name,</p><p>Thank you for reaching out to us. We have received your message and will get back to you shortly.</p><p>Best Regards,<br>KPSI</p>";

        $thankYouMail->send();

        echo "Message sent successfully. Thank you for contacting us!"; // Message displayed to the user

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
