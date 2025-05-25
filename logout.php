<?php
// Include the database connection
require_once 'connection.php';

// Assuming you have the user_id from the session or elsewhere
session_start();
$user_id = $_SESSION['user_id']; // You must set the session with user data after login

// Get the current time (exit time)
$exit_time = date('Y-m-d H:i:s');

// Update the exit time for the latest attendance record
$stmt = $conn->prepare("UPDATE attendance SET exit_time = ? WHERE user_id = ? AND exit_time IS NULL ORDER BY entry_time DESC LIMIT 1");
$stmt->bind_param("si", $exit_time, $user_id);

if ($stmt->execute()) {
    echo "Exit time recorded successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Destroy session to log out the user
session_destroy();
?>
