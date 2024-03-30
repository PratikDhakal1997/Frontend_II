<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "web";
$password = "web";
$dbname = "example_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and sanitize it
    $firstname = mysqli_real_escape_string($conn, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($conn, $_POST["lastname"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $emailToUpdate = $_SESSION['email'];

    // Update statement
    $updateQuery = "UPDATE users SET first_name = ?, last_name = ?, phone = ?, address = ?  WHERE email = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssss", $firstname, $lastname, $phone, $address, $emailToUpdate);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "Update successful.";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
