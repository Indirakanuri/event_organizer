<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "123456"; 
$dbname = "collaborations";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['name']) && isset($_POST['contact'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];

    
    if (isset($_FILES['pictures'])) {
        $files = $_FILES['pictures'];

        if (is_array($files['name'])) {
            foreach ($files['name'] as $key => $fileName) {
                if ($files['error'][$key] === UPLOAD_ERR_OK) {
                    $fileTmpName = $files['tmp_name'][$key];
                    $fileDestination = __DIR__ . '/uploads/' . $fileName;

                    // Ensure uploads directory exists and is writable
                    if (!is_dir(__DIR__ . '/uploads')) {
                        mkdir(__DIR__ . '/uploads', 0777, true);
                    }

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        echo "File $fileName uploaded successfully.<br>";
                    } else {
                        echo "Failed to upload file $fileName.<br>";
                    }
                } else {
                    echo "Error uploading file $fileName.<br>";
                }
            }
        } else {
            echo "Error: Files array is not structured correctly.<br>";
        }
    }

    
    $stmt = $conn->prepare("INSERT INTO collaborations (name, contact) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("ss", $name, $contact);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        die("Execute Error: " . $stmt->error);
    }

    $stmt->close();
} else {
    echo "Name and contact are required fields.";
}

$conn->close();
?>
