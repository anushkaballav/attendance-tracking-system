<?php
$servername = "localhost"; // Replace with your server name, usually 'localhost'
$username = "root";        // Replace with your database username, default is 'root'
$password = "";            // Replace with your database password, default is empty for XAMPP
$dbname = "attendance_tracking"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}
?>