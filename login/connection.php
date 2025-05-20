<?php 
$host = "localhost"; // Database host
$user = "root";
$password = "";
$db_name = "next_tech_database";

$con = mysqli_connect($host, $user, $password, $db_name); // Connect to the database

if (!$con){
    die("Connection failed: " . mysqli_connect_error());
}; // Connect to the database
