<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    // If logged in, destroy the session
    session_destroy();

    // Redirect the user to the login page or any other desired page
    header("Location: ../index.php");
    exit; // Ensure that script execution stops after redirection
} else {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit; // Ensure that script execution stops after redirection
}
