<?php
$conn = new mysqli("localhost", "root", "", "your_database");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Your insert query code here
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Your PHP code here
?>
