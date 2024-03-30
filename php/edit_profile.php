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
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);
    $postal = mysqli_real_escape_string($conn, $_POST["postalcode"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
    $gender = mysqli_real_escape_string($conn, $_POST["mySelect"]);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $emailToUpdate = $_SESSION['email'];

    // Update statement
    $updateQuery = "UPDATE users SET first_name = ?, last_name = ?, email = ?, phone = ?, password = ?, address = ?, postal_code = ?, dob = ?, gender = ?  WHERE email = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssssssssss", $firstname, $lastname, $email, $phone, $hashed_password, $address, $postal, $dob, $gender, $emailToUpdate);

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
