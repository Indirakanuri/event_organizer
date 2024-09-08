<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $rating = $_POST["rating"];
  $review = $_POST["review"];

  $sql = "INSERT INTO reviews (name, rating, review) VALUES ('$name', '$rating', '$review')";

  if ($conn->query($sql) === TRUE) {
    echo "New review submitted successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>
