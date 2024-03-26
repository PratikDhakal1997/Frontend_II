<?php
// Start the session at the beginning of the script
session_start();
$_SESSION['login'] = "true";

// Define database connection variables
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "example_db";

// Create a database connection
$conn = mysqli_connect($servername, $dbUsername, $dbPassword, $dbname);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process the form if it is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize form data
    $formEmail = mysqli_real_escape_string($conn, $_POST["Email"]);
    $formPassword = mysqli_real_escape_string($conn, $_POST["Password"]);

    // SQL query to retrieve user data
    $sql = "SELECT * FROM users WHERE email = ?";

    // Prepare and bind the statement
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $formEmail);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Flag to track user existence
    $_SESSION["userExist"] = false;

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $_SESSION["userExist"] = "true";

        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($formPassword, $row["password"])) {
            // Password is correct, set session variables
            $_SESSION["username"] = $row["first_name"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["loggedin"] = true;

            // Redirect to a secure page
            header("Location: ../index.php");
            exit();
        } else {
            // Password is incorrect
            $_SESSION["passwordExist"] = "false";
            header("Location: ../php/login_register.php");
            exit();
        }
    } else {
        // Username not registered
        $_SESSION["loggedin"] = false;
        header("Location: ../php/login_register.php");
        exit();
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
