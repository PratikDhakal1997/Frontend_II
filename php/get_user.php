<?php

// session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "example_db";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM USERS WHERE  email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['email']);

// Execute query
$stmt->execute();

// Get result
$result = $stmt->get_result();

// var_dump($_SESSION(''))

// Check if any rows were returned
$details = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while ($data = $result->fetch_assoc()) {
        $details['first_name'] = $data['first_name'];
        $details['last_name'] = $data['last_name'];
        $details['email'] = $data['email'];
        $details['phone'] = $data['phone'];
        $details['password'] = $data['password'];
        $details['address'] = $data['address'];
        $details['postal_code'] = $data['postal_code'];
        $details['dob'] = $data['dob'];
        $details['gender'] = $data['gender'];
        // Modify the echo statement according to your table columns
    }
} else {
    echo "0 results";
}