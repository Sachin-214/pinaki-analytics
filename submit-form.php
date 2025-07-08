<?php
// 1. Get form values
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

// 2. Validate basic fields (optional)
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
}

// 3. DB config
$host = "localhost";
$username = "pinaki";
$password = "pinaki123";
$database = "pinaki";

// 4. Connect to DB
$conn = new mysqli($host, $username, $password, $database);

// 5. Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 6. Insert data
$stmt = $conn->prepare("INSERT INTO enquiries (name, email, message) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
    echo "Thank you! Your message has been received.";
} else {
    echo "Error: " . $stmt->error;
}

// 7. Close connection
$stmt->close();
$conn->close();
?>
