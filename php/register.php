<?php
session_start();

// Define database connection variables
$servername = "localhost";
$username = "web";
$password = "web";
$dbname = "example_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Get form data and sanitize it
  $firstname = mysqli_real_escape_string($conn, $_POST["first_name"]);
  $lastname = mysqli_real_escape_string($conn, $_POST["last_name"]);
  $email = mysqli_real_escape_string($conn, $_POST["email"]);
  $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
  $password = mysqli_real_escape_string($conn, $_POST["password"]);
  $address = mysqli_real_escape_string($conn, $_POST["address"]);
  $postal = mysqli_real_escape_string($conn, $_POST["postal_code"]);
  $dob = mysqli_real_escape_string($conn, $_POST["datepicker"]);
  $gender = mysqli_real_escape_string($conn, $_POST["mySelect"]);

  // Hash the password using bcrypt
  $hashed_password = password_hash($password, PASSWORD_BCRYPT);

  // Prepare the SQL query to insert the data into the database
  $sql = "INSERT INTO users (first_name, last_name, email, phone, password, address, postal_code, dob, gender)
          VALUES ('$firstname', '$lastname', '$email','$phone', '$hashed_password','$address','$postal','$dob','$gender')";

  // Execute the query and check for errors
  if (mysqli_query($conn, $sql)) {
    // Get the last insert ID
    $last_id = mysqli_insert_id($conn);
    $query = "SELECT first_name FROM users WHERE id = $last_id";
    // Query to fetch the lastly added row
    $result = mysqli_query($conn, $query);
    if ($result) {
      $row = mysqli_fetch_assoc($result);
      // Store the first name in session
      $_SESSION['username'] = $row['first_name'];
      $_SESSION['email'] = $email;

  


      header('Location: ../index.php');
    }
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
