<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Example: Save data to a file (you can modify this to save to a database, send an email, etc.)
    $file = 'form_data.txt'; // File to save form data
    $current = file_get_contents($file); // Get existing data from file
    $current .= "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nMessage: $message\n\n"; // Append new data
    file_put_contents($file, $current); // Save updated data to file

    // Redirect after processing (optional)
    header('Location: thank_you.html');
    exit();
}
?>
