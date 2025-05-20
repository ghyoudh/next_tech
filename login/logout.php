<?php 

session_start(); // Start the session

if(isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']); // Unset the user ID session variable
}

header("Location: ../index.php"); // Redirect to login page
die; 