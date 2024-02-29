<?php
session_start();
$dbservername = "localhost";
    $dbusername = "root";
    $dbpassword = ""; // Assuming empty password for the root user, update if necessary
    $dbname = "sa_ranks"; // Replace "your_database" with your actual database name

    // Create connection
    $conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>
