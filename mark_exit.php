<?php
require_once 'connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in.";
    exit;
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user id
$today_date = date('Y-m-d');      // Get today's date
$current_time = date('H:i:s');    // Get the current time (exit time)

// Check if the user has already marked an entry time for today
$stmt = $conn->prepare("SELECT * FROM attendance WHERE user_id = ? AND attendance_date = ?");
$stmt->bind_param("is", $user_id, $today_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Update the exit time if the user already has an entry time for today
    $stmt = $conn->prepare("UPDATE attendance SET exit_time = ? WHERE user_id = ? AND attendance_date = ?");
    $stmt->bind_param("sis", $current_time, $user_id, $today_date);
    $stmt->execute();
    echo "Exit time marked successfully!";
} else {
    echo "You haven't marked your entry time yet!";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
